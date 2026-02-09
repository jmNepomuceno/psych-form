
<?php 
    include('./session.php');
    include('./assets/connection/connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHU Assessment System | Sign Up</title>
    <link rel="stylesheet" href="index.css">

    <?php require "./links/header_link.php" ?>
</head>
<body>

    <div class="container">
        <!-- Left illustration -->
        <div class="illustration">
            <h1>Health & Wellness Clinic 
                <span>Public Health Unit</span>
                <span>Digital Assessment Forms System</span>
            </h1>
            <p class="description">
                A secure digital platform for psychological and health screening assessments in support of patient care and well-being.
            </p>

            <!-- 3D Platform Circle -->
            <div class="platform-circle">
                <img src="../source/doctor.png" alt="Brain Icon" class="center-icon">
            </div>
        </div>


        <!-- Right login form -->
        <div class="form-container">
            <!-- Accent bar -->
            <div class="accent-bar"></div>
            
            <!-- GOVERNMENT LOGOS -->
            <div class="gov-logos">
                <img src="./source/tcp_DOH_2.png" alt="DOH">
                <img src="./source/tcp_BGHMC_2.png" alt="Bagong Pilipinas">
                <img src="./source/tcp_BP_2.png" alt="BGHMC">
                <img src="./source/phu_bg.jpg" alt="PHU Logo">
            </div>

            

            <div class="symbol-divider"><span></span></div>

            <form id="loginForm">
                <input type="text" placeholder="Username" id="username" required autocomplete="off">
                <input type="password" placeholder="Password" id="password" required autocomplete="off">
                <button type="submit" id="login-btn">Login</button>
                <p class="login-link">Use your portal account to log in.</p>
                <p class="login-link">Don't have an account? <a href="#">Sign up</a></p>
            </form>

            <div class="context-icons">
                <span title="Psychological Assessment">🧠</span>
                <span title="Health Screening">🩺</span>
                <span title="Secure Records">📋</span>
            </div>

            <div class="system-strip">
                PHU • Department of Health • Government of the Philippines
            </div>

            <div class="footer-note">
                Authorized PHU personnel only
            </div>
        </div>
    </div>

    <!-- Login Notification Modal -->
    <div id="login-modal" class="custom-modal">
        <div class="custom-modal-content">
            <span class="close-btn">&times;</span>
            <div class="modal-icon">⚠️</div>
            <h3 class="modal-title">Notification</h3>
            <p class="modal-message">Message goes here</p>
            <button class="modal-ok-btn">OK</button>
        </div>
    </div>


    <script type="text/javascript" src="./index.js?v=<?php echo time(); ?>"></script>
</body>
</html>
