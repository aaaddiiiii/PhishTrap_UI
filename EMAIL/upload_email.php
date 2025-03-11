<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email_text"])) {
    $email_text = $_POST["email_text"];

    $api_url = "http://127.0.0.1:5000/predict/email";
    $data = json_encode(["email_text" => $email_text]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = $response ? json_decode($response, true)["prediction"] : "Error";
    header("Location: email.php?result=" . urlencode($result));
    exit();
}
?>
