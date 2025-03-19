<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhishTrap - QR Phishing Detection</title>
    <link rel="stylesheet" href="qr_style.css?v=<?php echo time(); ?>">
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
        <button class="sidebutton" onclick="window.location.href='../EMAIL/email.php';">Email</button>
        <button class="sidebutton" onclick="window.location.href='../URL/url.php';">URL</button>
        <button class="sidebutton" onclick="window.location.href='#';">QR Code</button>
    </div>

    <div class="contents">
        <div class="logoo">
            <h1 class="Phish">QR&nbsp;</h1>
            <h1 class="Trap">Phishing Detection</h1>
        </div>
        <h2 class="h2">Upload a QR Code Image to check for Phishing threats :</h2>
        
<!-- 🛠 QR Code Upload Form with Animation -->
<form action="upload_qr.php" method="POST" enctype="multipart/form-data">
    <div class="container">
        <div class="folder">
            <div class="front-side">
                <div class="tip"></div>
                <div class="cover"></div>
            </div>
            <div class="back-side cover"></div>
        </div>
        <label class="custom-file-upload">
            <input type="file" name="file" accept="image/*" required />
            Choose a file
        </label>
        <button type="submit">Check</button>
    </div>
</form>


        <h3 class="h3">RESULT :</h3>
        <div id="result">
            <?php 
            if (isset($_GET['error'])) {
                echo "<p style='color: red;'><strong>Error:</strong> " . htmlspecialchars($_GET['error']) . "</p>";
            } elseif (isset($_GET['url']) && isset($_GET['result'])) {
                echo "<p><strong>Extracted URL:</strong> " . htmlspecialchars($_GET['url']) . "<br>";
                echo "<strong>Prediction:</strong> <span style='color: " . 
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