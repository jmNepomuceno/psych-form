<?php 
    include('../session.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fagerström Test for Nicotine Dependence</title>
    <link rel="stylesheet" href="../assets/css/ftnd.css">
    <link rel="stylesheet" href="../assets/css/header.css">

    <?php require "../links/header_link.php"; ?>

</head>
<body>
    <?php
    $viewOnly = isset($_GET['view']) && $_GET['view'] == 1;
    ?>

    <?php if (!$viewOnly): ?>
        <?php include 'header.php'; ?>
    <?php endif; ?>
    
    <div class="form-container">
        <!-- HEADER -->
        <div class="header">
            <!-- Left Logos -->
            <div class="header-left">
                <div class="logo"><img src="../source/tcp_DOH.jpg" alt="DOH Logo" class="small-logo"></div>
                <div class="logo"><img src="../source/tcp_BGHMC.jpg" alt="BGHMC Logo" class="small-logo"></div>
            </div>

            <!-- Center Text -->
            <div class="header-center">
                <h1 class="hospital-title">BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h1>
                <p class="hospital-subtitle">Balanga City, Bataan<br>ISO-QMS 9001:2015 Certified</p>
            </div>

            <!-- Right Logos -->
            <div class="header-right">
                <div class="logo"><img src="../source/tcp_DOH.jpg" alt="PHU Logo" class="small-logo"></div>
                <div class="logo"><img src="../source/tcp_BP.jpg" alt="BP Logo" class="small-logo"></div>
            </div>
        </div>

        <!-- PATIENT INFO -->
        <div class="patient-info">
            <div>Name: <input type="text" name="patient_name" class="text-input" value="<?php echo $_SESSION['name']; ?>"></div>
            <div>Age/Sex: <input type="text" name="age_sex" class="text-input small"></div>
            <div>Date: <input type="date" name="exam_date" class="text-input small"></div>
        </div>

        <h2 class="form-title">Fagerström Test for Nicotine Dependence</h2>
        <p>Note: Circle the score corresponding to every item number</p>

        <!-- QUESTIONS TABLE -->
        <table class="ftnd-table">
            <thead>
                <tr>
                    <th class="question-col">Question</th>
                    <th>0</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. How soon after you wake up do you smoke your first cigarette?</td>
                    <td><input type="radio" name="q1" value="0">After 60 minutes</td>
                    <td><input type="radio" name="q1" value="1">31-60 minutes</td>
                    <td><input type="radio" name="q1" value="2">6-30 minutes</td>
                    <td><input type="radio" name="q1" value="3">Within 5 minutes</td>
                </tr>
                <tr>
                    <td>2. Do you find it difficult to refrain from smoking in places where it is forbidden?</td>
                    <td><input type="radio" name="q2" value="0">No</td>
                    <td><input type="radio" name="q2" value="1">Yes</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>3. Which cigarette would you hate most to give up?</td>
                    <td><input type="radio" name="q3" value="0">The First one in the morning</td>
                    <td><input type="radio" name="q3" value="1">Any other</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>4. How many cigarettes/day do you smoke?</td>
                    <td><input type="radio" name="q4" value="0">10 or less</td>
                    <td><input type="radio" name="q4" value="1">11-20</td>
                    <td><input type="radio" name="q4" value="2">21-30</td>
                    <td><input type="radio" name="q4" value="3">31 or more</td>
                </tr>
                <tr>
                    <td>5. Do you smoke more frequently during the first hours after waking than during the rest of the day?</td>
                    <td><input type="radio" name="q5" value="0">No</td>
                    <td><input type="radio" name="q5" value="1">Yes</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
                <tr>
                    <td>6. Do you smoke if you are so ill that you are in bed most of the day?</td>
                    <td><input type="radio" name="q6" value="0">No</td>
                    <td><input type="radio" name="q6" value="1">Yes</td>
                    <td>-</td>
                    <td>-</td>
                </tr>
            </tbody>
        </table>

        <!-- TOTAL SCORE -->
        <div class="total-section">
            <div class="score-box">TOTAL SCORE</div>
            <input type="text" id="totalScore" name="total_score" class="total-input" readonly>
        </div>

        <div class="footer">
            <!-- <span class="phu-form">PHU-F-33-00</span> -->
        </div>

        <div class="form-actions">
            <button type="button" id="submitForm">Submit Form</button>
        </div>
    </div>



    <!-- FTND RESULT MODAL -->
    <div id="ftndResultModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">

            <h2 class="modal-title">Fagerström Test Result</h2>

            <div class="result-summary">
                <div>
                    <span class="label">Total Score</span>
                    <span id="ftndResultScore" class="score-value"></span>
                </div>
                <div>
                    <span class="label">Dependence Level</span>
                    <span id="ftndResultSeverity" class="severity-badge"></span>
                </div>
            </div>

            <table class="severity-table">
                <thead>
                    <tr>
                        <th>Score Range</th>
                        <th>Nicotine Dependence</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-min="0" data-max="2"><td>0–2</td><td>Very Low</td></tr>
                    <tr data-min="3" data-max="4"><td>3–4</td><td>Low</td></tr>
                    <tr data-min="5" data-max="5"><td>5</td><td>Moderate</td></tr>
                    <tr data-min="6" data-max="7"><td>6–7</td><td>High</td></tr>
                    <tr data-min="8" data-max="10"><td>8–10</td><td>Very High</td></tr>
                </tbody>
            </table>

            <!-- CONSENT (High–Very High only) -->
            <div id="ftndConsentSection" class="consent-section" style="display:none;">
                <p class="alert-text">
                    This result indicates <strong>high nicotine dependence</strong>.
                </p>

                <p class="disclaimer-text">
                    You may optionally provide your mobile number so a health professional
                    can contact you for smoking cessation support.
                </p>

                <div class="consent-options">
                    <label>
                        <input type="radio" name="ftndConsentChoice" value="agree">
                        <span>I agree</span>
                    </label>
                    <label>
                        <input type="radio" name="ftndConsentChoice" value="decline">
                        <span>No thanks</span>
                    </label>
                </div>
            </div>

            <!-- OPTIONAL CONTACT -->
            <div id="ftndContactSection" class="contact-section" style="display:none;">
                <label for="ftndContactNumber">Mobile Number (Optional)</label>
                <input type="text" id="ftndContactNumber" placeholder="09XXXXXXXXX">
            </div>

            <div id="ftndContactSectionEmer" class="contact-section" style="display:none;">
                <label for="ftndContactNumberEmer">Emergency Contact Mobile Number (Optional)</label>
                <input type="text" id="ftndContactNumberEmer" placeholder="09XXXXXXXXX">
            </div>

            <button id="ftndConfirmSubmit" class="btn-primary" disabled>
                Confirm & Save
            </button>

        </div>
    </div>


    <script src="../assets/js/FTND.js"></script>
</body>
</html>