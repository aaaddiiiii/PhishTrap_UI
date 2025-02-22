<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhishTrap - Phishing Detection</title>
    <link rel="stylesheet" href="qr_style.css?v=<?php echo time(); ?>">
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
    <button class="sidebutton" onclick="window.location.href='../URL/url.php';">
        <span>URL</span>
    </button>
    <button class="sidebutton" onclick="window.location.href='#';">
        <span>QR Code</span>
    </button>
</div>

    <div class = "contents">
        <div class = "logoo">
            <h1 class = "Phish">QR Code&nbsp;</h1>
            <h1 class = "Trap">Phishing Detection</h1>
        </div>
        <h2 class = "h2">Upload the QR file to check for threats :</h1>
        <div class="container">
            <div class="folder">
                <div class="front-side">
                    <div class="tip"></div>
                    <div class="cover"></div>
                </div>
                <div class="back-side cover"></div>
            </div>
            <label class="custom-file-upload">
                <input class="title" type="file" />Choose a file</label>
        </div>
        <h3 class = "h3">RESULT :</h1>
    </div>
    <footer class="footer">
        <p>&copy; 2025 PhishTrap. All rights reserved.</p>
    </footer>

</body>
</html>
