<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhishTrap - Phishing Detection</title>
    <link rel="stylesheet" href="email_style.css?v=<?php echo time(); ?>">
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
        <button class="sidebutton email-button" onclick="window.location.href='#';">
            <span>Email</span>
        </button>
        <button class="sidebutton" onclick="window.location.href='../URL/url.php';">
            <span>URL</span>
        </button>
        <button class="sidebutton" onclick="window.location.href='../QR/qr.php';">
            <span>QR Code</span>
        </button>
    </div>

    <div class="contents">
        <div class="logoo">
            <h1 class="Phish">Email&nbsp;</h1>
            <h1 class="Trap">Phishing Detection</h1>
        </div>
        <h2 class="h2">Enter the text to check for Phishing threats :</h2>

        <!-- 🛠 Email Input Form -->
        <form action="upload_email.php" method="POST">
            <div class="input-container">
                <textarea name="email_text" id="email_text" placeholder="Enter your text here" required></textarea>
                <button type="submit">Check</button>
            </div>
        </form>

        <!-- 🛠 Text Box to Display Result -->
        <h3 class="h3">RESULT :</h3>
        <div class="result-container">
            <input type="text" id="resultBox" value="<?php echo isset($_GET['result']) ? htmlspecialchars($_GET['result']) : ''; ?>" readonly>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2025 PhishTrap. All rights reserved.</p>
    </footer>
</body>
</html>
