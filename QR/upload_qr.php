<?php
$uploadDir = __DIR__ . "/IMAGES/";  

// Create directory if it doesn't exist
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"])) {
    $file = $_FILES["file"];
    $fileName = basename($file["name"]);
    $targetFile = $uploadDir . $fileName;

    // Move uploaded file to IMAGES folder
    if (move_uploaded_file($file["tmp_name"], $targetFile)) {
        // Prepare request to Flask API
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "http://127.0.0.1:5000/upload_qr",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                "Content-Type: multipart/form-data"
            ],
            CURLOPT_POSTFIELDS => [
                "file" => new CURLFile($targetFile)
            ]
        ]);

        $response = curl_exec($curl);
        $error = curl_error($curl);
        curl_close($curl);

        if ($error) {
            header("Location: qr.php?error=Failed to connect to Flask server: " . urlencode($error));
            exit();
        }

        if ($response) {
            $data = json_decode($response, true);
            $extractedUrl = $data["url"] ?? "No URL detected";
            $prediction = $data["prediction"] ?? "Error";

            // Redirect to qr.php with extracted URL and prediction
            header("Location: qr.php?url=" . urlencode($extractedUrl) . "&result=" . urlencode($prediction));
            exit();
        } else {
            header("Location: qr.php?error=Invalid response from Flask server.");
            exit();
        }
    } else {
        header("Location: qr.php?error=Failed to upload file.");
        exit();
    }
} else {
    header("Location: qr.php?error=Invalid request.");
    exit();
}
?>
