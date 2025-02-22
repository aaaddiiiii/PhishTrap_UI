<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PhishTrap - Phishing Detection</title>
    <link rel="stylesheet" href="home_style.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav class = "navbar">
        <div class = "navdiv">
            <div class = "logo">Phishclub.org</div>
            <ul>
                <li><a href = "#">Reports</a></li>
                <li><a href = "HELP/help.php">Help</a></li>
                <li><a href = "ABOUT US/aboutus.php">About us</a></li>
            </ul>
        </div>
    </nav>
    <div class = "contents">
        <div class = "logoo">
        <span class="logoo"><span class="Phish">Phish</span><span class="Trap">Trap</span></span>
        </div>
        <h2 class = "desc" >PhishTrap is your first line of defense against phishing attacks, ensuring your online safety with real-time threat detection ⚠️</h2>
        <h3 class = "desc" >Whether it’s a suspicious email, a misleading QR code, or a deceptive link, PhishTrap analyzes and identifies potential risks instantly to keep you safe online and protect you from cyber threats 🔒</h3>
        <div class="buttons">
            <button class="hbutton" onclick="window.location.href='EMAIL/email.php';"> <span>Email</span> </button>
            <button class="hbutton" onclick="window.location.href='URL/url.php';"> <span>URL</span> </button>
            <button class="hbutton" onclick="window.location.href='QR/qr.php';"> <span>QR Code</span> </button>
            
            
    </div>
    </div>
    <footer class="footer">
        <p>&copy; 2025 PhishTrap. All rights reserved.</p>
    </footer>

</body>
</html>
