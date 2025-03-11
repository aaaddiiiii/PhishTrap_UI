<?php
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["url"])) {
    $url = $_POST["url"];

    $api_url = "http://127.0.0.1:5000/predict/url_qr";
    $data = json_encode(["url" => $url]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = $response ? json_decode($response, true)["prediction"] : "Error";
    header("Location: url.php?result=" . urlencode($result));
    exit();
}
?>
