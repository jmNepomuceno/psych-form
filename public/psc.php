<?php 
    include('../session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Perceived Stress Scale (PSS-10)</title>
    <link rel="stylesheet" href="../assets/css/psc.css">
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

        <h2 class="form-title">Perceived Stress Scale (PSS-10)</h2>
        <p>Note: For each question choose from the following alternatives:</p>
        <h5>
            0 - Never &nbsp;&nbsp;
            1 - Almost Never &nbsp;&nbsp;
            2 - Sometimes &nbsp;&nbsp;
            3 - Fairly Often &nbsp;&nbsp;
            4 - Very Often
        </h5>

        <!-- PSS QUESTIONS -->
        <table class="psc-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>0</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. In the last month, how often have you been upset because of something that happened unexpectedly?</td>
                    <td><input type="radio" name="q1" value="0"></td>
                    <td><input type="radio" name="q1" value="1"></td>
                    <td><input type="radio" name="q1" value="2"></td>
                    <td><input type="radio" name="q1" value="3"></td>
                    <td><input type="radio" name="q1" value="4"></td>
                </tr>

                <tr>
                    <td>2. In the last month, how often have you felt that you were unable to control the important things in your life?</td>
                    <td><input type="radio" name="q2" value="0"></td>
                    <td><input type="radio" name="q2" value="1"></td>
                    <td><input type="radio" name="q2" value="2"></td>
                    <td><input type="radio" name="q2" value="3"></td>
                    <td><input type="radio" name="q2" value="4"></td>
                </tr>

                <tr>
                    <td>3. In the last month, how often have you felt nervous and stressed?</td>
                    <td><input type="radio" name="q3" value="0"></td>
                    <td><input type="radio" name="q3" value="1"></td>
                    <td><input type="radio" name="q3" value="2"></td>
                    <td><input type="radio" name="q3" value="3"></td>
                    <td><input type="radio" name="q3" value="4"></td>
                </tr>

                <tr>
                    <td>4. In the last month, how often have you felt confident about your ability to handle your personal problems?</td>
                    <td><input type="radio" name="q4" value="0"></td>
                    <td><input type="radio" name="q4" value="1"></td>
                    <td><input type="radio" name="q4" value="2"></td>
                    <td><input type="radio" name="q4" value="3"></td>
                    <td><input type="radio" name="q4" value="4"></td>
                </tr>

                <tr>
                    <td>5. In the last month, how often have you felt that things were going your way?</td>
                    <td><input type="radio" name="q5" value="0"></td>
                    <td><input type="radio" name="q5" value="1"></td>
                    <td><input type="radio" name="q5" value="2"></td>
                    <td><input type="radio" name="q5" value="3"></td>
                    <td><input type="radio" name="q5" value="4"></td>
                </tr>

                <tr>
                    <td>6. In the last month, how often have you found that you could not cope with all the things that you had to do?</td>
                    <td><input type="radio" name="q6" value="0"></td>
                    <td><input type="radio" name="q6" value="1"></td>
                    <td><input type="radio" name="q6" value="2"></td>
                    <td><input type="radio" name="q6" value="3"></td>
                    <td><input type="radio" name="q6" value="4"></td>
                </tr>

                <tr>
                    <td>7. In the last month, how often have you been able to control irritations in your life?</td>
                    <td><input type="radio" name="q7" value="0"></td>
                    <td><input type="radio" name="q7" value="1"></td>
                    <td><input type="radio" name="q7" value="2"></td>
                    <td><input type="radio" name="q7" value="3"></td>
                    <td><input type="radio" name="q7" value="4"></td>
                </tr>

                <tr>
                    <td>8. In the last month, how often have you felt that you were on top of things?</td>
                    <td><input type="radio" name="q8" value="0"></td>
                    <td><input type="radio" name="q8" value="1"></td>
                    <td><input type="radio" name="q8" value="2"></td>
                    <td><input type="radio" name="q8" value="3"></td>
                    <td><input type="radio" name="q8" value="4"></td>
                </tr>

                <tr>
                    <td>9. In the last month, how often have you been angered because of things that were outside of your control?</td>
                    <td><input type="radio" name="q9" value="0"></td>
                    <td><input type="radio" name="q9" value="1"></td>
                    <td><input type="radio" name="q9" value="2"></td>
                    <td><input type="radio" name="q9" value="3"></td>
                    <td><input type="radio" name="q9" value="4"></td>
                </tr>

                <tr>
                    <td>10. In the last month, how often have you felt difficulties were piling up so high that you could not overcome them?</td>
                    <td><input type="radio" name="q10" value="0"></td>
                    <td><input type="radio" name="q10" value="1"></td>
                    <td><input type="radio" name="q10" value="2"></td>
                    <td><input type="radio" name="q10" value="3"></td>
                    <td><input type="radio" name="q10" value="4"></td>
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



    <!-- PSS RESULT MODAL -->
    <div id="pssResultModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">

            <h2 class="modal-title">Perceived Stress Scale Result</h2>

            <div class="result-summary">
                <div>
                    <span class="label">Total Score</span>
                    <span id="pssResultScore" class="score-value"></span>
                </div>
                <div>
                    <span class="label">Stress Level</span>
                    <span id="pssResultSeverity" class="severity-badge"></span>
                </div>
            </div>

            <table class="severity-table">
                <thead>
                    <tr>
                        <th>Score Range</th>
                        <th>Stress Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-min="0" data-max="13"><td>0–13</td><td>Low Stress</td></tr>
                    <tr data-min="14" data-max="26"><td>14–26</td><td>Moderate Stress</td></tr>
                    <tr data-min="27" data-max="40"><td>27–40</td><td>High Stress</td></tr>
                </tbody>
            </table>

            <!-- CONSENT (High Stress only) -->
            <div id="pssConsentSection" class="consent-section" style="display:none;">
                <p class="alert-text">
                    This result indicates <strong>high perceived stress</strong>.
                </p>

                <p class="disclaimer-text">
                    You may optionally provide your mobile number so a health professional
                    can contact you for stress management guidance.
                </p>

                <div class="consent-options">
                    <label>
                        <input type="radio" name="pssConsentChoice" value="agree">
                        <span>I agree</span>
                    </label>
                    <label>
                        <input type="radio" name="pssConsentChoice" value="decline">
                        <span>No thanks</span>
                    </label>
                </div>
            </div>

            <!-- OPTIONAL CONTACT -->
            <div id="pssContactSection" class="contact-section" style="display:none;">
                <label for="pssContactNumber">Mobile Number (Optional)</label>
                <input type="text" id="pssContactNumber" placeholder="09XXXXXXXXX">
            </div>

            <button id="pssConfirmSubmit" class="btn-primary" disabled>
                Confirm & Save
            </button>

        </div>
    </div>




    <script src="../assets/js/psc.js"></script>
</body>
</html>