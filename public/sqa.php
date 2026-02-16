<?php 
    include('../session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sleep Quality Assessment (PSQI)</title>
    <link rel="stylesheet" href="../assets/css/sqa.css">
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
            <div class="header-left">
                <div class="logo"><img src="../source/tcp_DOH.jpg"></div>
                <div class="logo"><img src="../source/tcp_BGHMC.jpg"></div>
            </div>

            <div class="header-center">
                <h1>BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h1>
                <p>Balanga City, Bataan<br>ISO-QMS 9001:2015 Certified</p>
            </div>

            <div class="header-right">
                <div class="logo"><img src="../source/tcp_BP.jpg"></div>
            </div>
        </div>

        <!-- PATIENT INFO -->
        <div class="patient-info">
            <div>Name: <input type="text" name="patient_name" class="text-input" value="<?php echo $_SESSION['name']; ?>"></div>
            <div>Age/Sex: <input type="text" name="age_sex" class="text-input small" placeholder="24/M"></div>
            <div>Date: <input type="date" name="exam_date" class="text-input small"></div>
        </div>

        <h2 class="form-title">
            Sleep Quality Assessment<br>
            <small>(Pittsburgh Sleep Quality Index – PSQI)</small>
        </h2>

        <p>
            The following questions relate to your usual sleep habits during the past month only.
            Please answer all questions.
        </p>

        <!-- SECTION 1 -->
        <table class="sqa-table">
            <tbody>
                <tr>
                    <td class="question-col">1. When have you usually gone to bed?</td>
                    <td colspan="4"><input type="time" class="text-input" name="q1"></td>
                </tr>
                <tr>
                    <td>2. How long (in minutes) has it taken you to fall asleep each night?</td>
                    <td colspan="4"><input type="number" class="text-input small" name="q2"></td>
                </tr>
                <tr>
                    <td>3. What time have you usually gotten up in the morning?</td>
                    <td colspan="4"><input type="time" class="text-input" name="q3"></td>
                </tr>
                <tr>
                    <td>4. How many hours of actual sleep did you get at night?</td>
                    <td colspan="4"><input type="number" class="text-input small" name="q4"></td>
                </tr>
                <tr>
                    <td>5. How many hours were you in bed?</td>
                    <td colspan="4"><input type="number" class="text-input small" name="q5"></td>
                </tr>

            </tbody>
        </table>

        <br>

        <!-- SECTION 2 -->
        <table class="sqa-table">
            <thead>
                <tr>
                    <th class="question-col">During the past month, how often have you had trouble sleeping because you…</th>
                    <th>Not during<br>the past month (0)</th>
                    <th>Less than<br>once a week (1)</th>
                    <th>Once or twice<br>a week (2)</th>
                    <th>Three or more<br>times a week (3)</th>
                </tr>
            </thead>
            <tbody>
                <!-- Reusable row -->
                <tr>
                    <td>Cannot get to sleep within 30 minutes</td>
                    <td><input type="radio" name="q6a" value="0"></td>
                    <td><input type="radio" name="q6a" value="1"></td>
                    <td><input type="radio" name="q6a" value="2"></td>
                    <td><input type="radio" name="q6a" value="3"></td>
                </tr>

                <tr>
                    <td>Wake up in the middle of the night or early morning</td>
                    <td><input type="radio" name="q6b" value="0"></td>
                    <td><input type="radio" name="q6b" value="1"></td>
                    <td><input type="radio" name="q6b" value="2"></td>
                    <td><input type="radio" name="q6b" value="3"></td>
                </tr>

                <tr>
                    <td>Have to get up to use the bathroom</td>
                    <td><input type="radio" name="q6c" value="0"></td>
                    <td><input type="radio" name="q6c" value="1"></td>
                    <td><input type="radio" name="q6c" value="2"></td>
                    <td><input type="radio" name="q6c" value="3"></td>
                </tr>

                <tr>
                    <td>Cannot breathe comfortably</td>
                    <td><input type="radio" name="q6d" value="0"></td>
                    <td><input type="radio" name="q6d" value="1"></td>
                    <td><input type="radio" name="q6d" value="2"></td>
                    <td><input type="radio" name="q6d" value="3"></td>
                </tr>

                <tr>
                    <td>Cough or snore loudly</td>
                    <td><input type="radio" name="q6e" value="0"></td>
                    <td><input type="radio" name="q6e" value="1"></td>
                    <td><input type="radio" name="q6e" value="2"></td>
                    <td><input type="radio" name="q6e" value="3"></td>
                </tr>

                <tr>
                    <td>Feel too cold</td>
                    <td><input type="radio" name="q6f" value="0"></td>
                    <td><input type="radio" name="q6f" value="1"></td>
                    <td><input type="radio" name="q6f" value="2"></td>
                    <td><input type="radio" name="q6f" value="3"></td>
                </tr>

                <tr>
                    <td>Feel too hot</td>
                    <td><input type="radio" name="q6g" value="0"></td>
                    <td><input type="radio" name="q6g" value="1"></td>
                    <td><input type="radio" name="q6g" value="2"></td>
                    <td><input type="radio" name="q6g" value="3"></td>
                </tr>

                <tr>
                    <td>Have bad dreams</td>
                    <td><input type="radio" name="q6h" value="0"></td>
                    <td><input type="radio" name="q6h" value="1"></td>
                    <td><input type="radio" name="q6h" value="2"></td>
                    <td><input type="radio" name="q6h" value="3"></td>
                </tr>

                <tr>
                    <td>Have pain</td>
                    <td><input type="radio" name="q6i" value="0"></td>
                    <td><input type="radio" name="q6i" value="1"></td>
                    <td><input type="radio" name="q6i" value="2"></td>
                    <td><input type="radio" name="q6i" value="3"></td>
                </tr>

                <tr>
                    <td>Other reason(s): <input type="text" class="text-input"></td>
                    <td><input type="radio" name="q6j" value="0"></td>
                    <td><input type="radio" name="q6j" value="1"></td>
                    <td><input type="radio" name="q6j" value="2"></td>
                    <td><input type="radio" name="q6j" value="3"></td>
                </tr>
            </tbody>
        </table>

        <br>

        <!-- SECTION 3 -->
        <table class="sqa-table">
            <tbody>
                <tr>
                    <td class="question-col">7. During the past month, how often have you taken medicine to help you sleep?</td>
                    <td colspan="4">
                        <select class="text-input" name="q7">
                            <option value="0">Not during the past month</option>
                            <option value="1">Less than once a week</option>
                            <option value="2">Once or twice a week</option>
                            <option value="3">Three or more times a week</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>8. During the past month, how often have you had trouble staying awake?</td>
                    <td colspan="4">
                        <select class="text-input" name="q8">
                            <option value="0">Not during the past month</option>
                            <option value="1">Less than once a week</option>
                            <option value="2">Once or twice a week</option>
                            <option value="3">Three or more times a week</option>
                        </select>
                    </td>
                </tr>
            </tbody>
        </table>

        <br>

        <!-- SLEEP QUALITY -->
        <table class="sqa-table">
            <thead>
                <tr>
                    <th class="question-col">9. During the past month, how would you rate your sleep quality overall?</th>
                    <th>Very Good (0)</th>
                    <th>Fairly Good (1)</th>
                    <th>Fairly Bad (2)</th>
                    <th>Very Bad (3)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td><input type="radio" name="q9" value="0"></td>
                    <td><input type="radio" name="q9" value="1"></td>
                    <td><input type="radio" name="q9" value="2"></td>
                    <td><input type="radio" name="q9" value="3"></td>
                </tr>
            </tbody>
        </table>

        <!-- TOTAL SCORE -->
        <div class="total-section">
            <div class="score-box">TOTAL SCORE</div>
            <input type="text" class="total-input" readonly>
        </div>

        <div class="footer">
            <span class="phu-form">PHU-F-20-00</span>
        </div>

        <div class="form-actions">
            <button id="submitForm">Submit Form</button>
        </div>
    </div>

    <!-- PSQI RESULT MODAL -->
    <div id="psqiResultModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">

            <h2 class="modal-title">Pittsburgh Sleep Quality Index (PSQI) Result</h2>

            <div class="result-summary">
                <div>
                    <span class="label">Total Score</span>
                    <span id="psqiResultScore" class="score-value"></span>
                </div>
                <div>
                    <span class="label">Sleep Quality Level</span>
                    <span id="psqiResultSeverity" class="severity-badge"></span>
                </div>
            </div>

            <table class="severity-table">
                <thead>
                    <tr>
                        <th>Score Range</th>
                        <th>Sleep Quality</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-min="0" data-max="4"><td>0–4</td><td>Good</td></tr>
                    <tr data-min="5" data-max="10"><td>5–10</td><td>Poor</td></tr>
                    <tr data-min="11" data-max="21"><td>11–21</td><td>Very Poor</td></tr>
                </tbody>
            </table>

            <!-- OPTIONAL FOLLOW-UP (if Poor / Very Poor) -->
            <div id="psqiFollowUpSection" class="followup-section" style="display:none;">
                <p class="alert-text">
                    Your sleep quality is <strong>below optimal</strong>.
                </p>

                <p class="disclaimer-text">
                    You may optionally provide your mobile number so a health professional
                    can contact you for sleep improvement advice.
                </p>

                <div class="followup-options">
                    <label>
                        <input type="radio" name="psqiFollowUpChoice" value="agree">
                        <span>I agree</span>
                    </label>
                    <label>
                        <input type="radio" name="psqiFollowUpChoice" value="decline">
                        <span>No thanks</span>
                    </label>
                </div>
            </div>

            <!-- OPTIONAL CONTACT -->
            <div id="psqiContactSection" class="contact-section" style="display:none;">
                <label for="psqiContactNumber">Mobile Number (Optional)</label>
                <input type="text" id="psqiContactNumber" placeholder="09XXXXXXXXX">
            </div>

            <div id="psqiContactSectionEmer" class="contact-section" style="display:none;">
                <label for="psqiContactNumbeEmerr">Emergency Contact Mobile Number (Optional)</label>
                <input type="text" id="psqiContactNumberEmer" placeholder="09XXXXXXXXX">
            </div>

            <button id="psqiConfirmSubmit" class="btn-primary" disabled>
                Confirm & Save
            </button>

        </div>
    </div>


    <script src="../assets/js/sqa.js"></script>
</body>
</html>