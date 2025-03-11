from flask import Flask, request, jsonify
import joblib
import pandas as pd
import os
import cv2
from pyzbar.pyzbar import decode
import re
from urllib.parse import urlparse
from scipy.sparse import hstack  

app = Flask(__name__)

UPLOAD_FOLDER = "IMAGES"
os.makedirs(UPLOAD_FOLDER, exist_ok=True)

# Load models
email_model = joblib.load(r"MODELS/phishing_logistic_regression.pkl")
url_qr_model = joblib.load(r"MODELS/phishing_model_url.pkl")  
vectorizer = joblib.load(r"MODELS/vectorizer.pkl")  
scaler = joblib.load(r"MODELS/scaler.pkl") 

def extract_features(url):
    """Extracts numerical features from a URL."""
    parsed_url = urlparse(url)
    
    return [
        len(url),
        url.count('.'),
        url.count('-'),
        url.count('@'),
        url.count('?'),
        url.count('='),
        url.count('&'),
        sum(c.isdigit() for c in url) / len(url) if len(url) > 0 else 0, 
        len(parsed_url.netloc.split('.')) - 2 if parsed_url.netloc else 0,
        1 if parsed_url.scheme == 'https' else 0
    ]

def process_url(url):
    """Processes URL by extracting features and vectorizing."""  
    features = extract_features(url)
    features_df = pd.DataFrame([features])
    
    url_vectorized = vectorizer.transform([url])  
    combined_features = hstack((features_df.to_numpy(), url_vectorized))  
    
    return scaler.transform(combined_features)  

def extract_url_from_qr(image_path):
    """Extracts URL from a QR code image."""
    image = cv2.imread(image_path)
    decoded_objects = decode(image)
    
    for obj in decoded_objects:
        return obj.data.decode("utf-8")  
    
    return None

@app.route('/predict/email', methods=['POST'])
def predict_email():
    """Predicts if an email is phishing."""
    data = request.json
    email_text = data.get("email_text", "")
    
    if not email_text.strip():
        return jsonify({"error": "Empty email text"}), 400
    
    email_features = vectorizer.transform([email_text])
    prediction = email_model.predict(email_features)[0]
    
    return jsonify({"prediction": "Phishing" if prediction == 1 else "Safe"})

@app.route('/predict/url_qr', methods=['POST'])
def predict_url_qr():
    """Predicts phishing status of a direct URL."""
    data = request.json
    url = data.get("url", "")
    
    if not url.strip():
        return jsonify({"error": "Empty URL"}), 400
    
    url_features = process_url(url)  
    prediction = url_qr_model.predict(url_features)[0]
    
    return jsonify({"prediction": "Phishing" if prediction == 1 else "Safe"})

@app.route('/upload_qr', methods=['POST'])
def upload_qr():
    """Handles QR code uploads and predicts phishing status of extracted URL."""
    if 'file' not in request.files:
        return jsonify({"error": "No file uploaded"}), 400

    file = request.files['file']
    filename = os.path.join(UPLOAD_FOLDER, file.filename)
    file.save(filename)

    extracted_url = extract_url_from_qr(filename)
    
    if not extracted_url:
        return jsonify({"error": "No URL found in QR code"}), 400
    
    url_features = process_url(extracted_url)  
    prediction = url_qr_model.predict(url_features)[0]
    
    return jsonify({"url": extracted_url, "prediction": "Phishing" if prediction == 1 else "Safe"})

if __name__ == '__main__':
    app.run(debug=True)
