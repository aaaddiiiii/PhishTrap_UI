<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhishTrap - Phishing Detection</title>
    <link rel="stylesheet" href="url_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav class="navbar">
        <div class="navdiv">
            <div class="logo" onclick="window.location.href='../home.php';">Phishclub.org</div>
            <ul>
                <li><a href="#">Reports</a></li>
                <li><a href="../HELP/help.php">Help</a></li>
                <li><a href="../ABOUT US/aboutus.php">About us</a></li>
            </ul>
        </div>
    </nav>

    <div class="side-panel">
        <button class="sidebutton email-button" onclick="window.location.href='../EMAIL/email.php';">
            <span>Email</span>
        </button>
        <button class="sidebutton" onclick="window.location.href='#';">
            <span>URL</span>
        </button>
        <button class="sidebutton" onclick="window.location.href='../QR/qr.php';">
            <span>QR Code</span>
        </button>
    </div>

    <div class="contents">
        <div class="logoo">
            <h1 class="Phish">URL&nbsp;</h1>
            <h1 class="Trap">Phishing Detection</h1>
        </div>
        <h2 class="h2">Enter the URL to check for Phishing threats :</h2>
        
        <!-- 🛠 URL Input Form (Submits to upload_url.php) -->
        <form action="upload_url.php" method="POST">
            <div class="input-container">
                <input name="url" placeholder="Enter the URL" type="text" required />
                <button type="submit">Check</button>
            </div>
        </form>

        <h3 class="h3">RESULT :</h3>
        <div id="result">
            <?php 
            if (isset($_GET['result'])) {
                echo "<p><strong>Prediction:</strong> <span style='color: " . 
                     ($_GET['result'] === "Phishing" ? "red" : "green") . ";'>" . 
                     htmlspecialchars($_GET['result']) . "</span></p>";
            }
            ?>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 PhishTrap. All rights reserved.</p>
    </footer>
</body>
</html>
