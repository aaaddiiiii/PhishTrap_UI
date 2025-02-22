<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhishTrap - Phishing Detection</title>
    <link rel="stylesheet" href="url_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav class = "navbar">
        <div class = "navdiv">
        <div class = "logo" onclick="window.location.href='../home.php';">Phishclub.org</div>
        <ul>
                <li><a href = "#">Reports</a></li>
                <li><a href = "../HELP/help.php">Help</a></li>
                <li><a href = "../ABOUT US/aboutus.php">About us</a></li>
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

    <div class = "contents">
        <div class = "logoo">
            <h1 class = "Phish">URL&nbsp;</h1>
            <h1 class = "Trap">Phishing Detection</h1>
        </div>
        <h2 class = "h2">Enter the URL to check for Phishing threats :</h1>
        <div class="input-container">
                <input placeholder="Enter the URL" type="text" />
        </div>
        <h3 class = "h3">RESULT :</h1>
    </div>
    <footer class="footer">
        <p>&copy; 2025 PhishTrap. All rights reserved.</p>
    </footer>

</body>
</html>
