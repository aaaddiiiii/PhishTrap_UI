from flask import Flask, request, jsonify
import joblib
import pandas as pd
import os
import cv2
from pyzbar.pyzbar import decode
import re
from urllib.parse import urlparse
from sklearn.feature_extraction.text import TfidfVectorizer

app = Flask(__name__)

UPLOAD_FOLDER = "IMAGES"
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

# Load models
email_model = joblib.load(r"MODELS/phishing_logistic_regression.pkl")
url_qr_model = joblib.load(r"MODELS/phishing_model_url.pkl")
vectorizer = joblib.load(r"MODELS/tfidf_vectorizer.pkl")

def extract_url_from_qr(image_path):
    """Extracts URL from a QR code image."""
    image = cv2.imread(image_path)
    decoded_objects = decode(image)
    
    for obj in decoded_objects:
        return obj.data.decode("utf-8")  # Extract the URL
    
    return None  # No QR code found

def extract_url_features(url):
    """Extracts features from URL for model prediction."""
    parsed_url = urlparse(url)
    
    return pd.DataFrame([{
        'url_length': len(url),
        'num_special_chars': len(re.findall(r'[@%&\*\$#\?\+\!]', url)),
        'has_https': 1 if parsed_url.scheme == "https" else 0,
        'num_digits': sum(c.isdigit() for c in url),
        'num_subdomains': parsed_url.netloc.count('.')
    }])

@app.route('/predict/email', methods=['POST'])
def predict_email():
    data = request.json
    email_text = data.get("email_text", "")
    
    if not email_text.strip():
        return jsonify({"error": "Empty email text"}), 400
    
    email_features = vectorizer.transform([email_text])
    prediction = email_model.predict(email_features)[0]
    
    return jsonify({"prediction": "Phishing" if prediction == 1 else "Safe"})

@app.route('/predict/url_qr', methods=['POST'])
def predict_url_qr():
    """Predict phishing for a direct URL (not QR)."""
    data = request.json
    url = data.get("url", "")
    
    if not url.strip():
        return jsonify({"error": "Empty URL"}), 400
    
    url_features = extract_url_features(url)
    prediction = url_qr_model.predict(url_features)[0]
    
    return jsonify({"prediction": "Phishing" if prediction == 1 else "Safe"})

@app.route('/upload_qr', methods=['POST'])
def upload_qr():
    """Handles QR code uploads and predicts phishing."""
    if 'file' not in request.files:
        return jsonify({"error": "No file uploaded"}), 400

    file = request.files['file']
    filename = os.path.join(UPLOAD_FOLDER, file.filename)
    file.save(filename)

    # Extract URL from QR code
    extracted_url = extract_url_from_qr(filename)
    
    if not extracted_url:
        return jsonify({"error": "No URL found in QR code"}), 400
    
    # Predict phishing
    url_features = extract_url_features(extracted_url)
    prediction = url_qr_model.predict(url_features)[0]
    
    return jsonify({"url": extracted_url, "prediction": "Phishing" if prediction == 1 else "Safe"})

if __name__ == '__main__':
    app.run(debug=True)
