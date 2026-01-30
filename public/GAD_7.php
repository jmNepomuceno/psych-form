<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAD-7 Form</title>
    <link rel="stylesheet" href="../assets/css/GAD_7.css">
    <!-- <link rel="stylesheet" href="../assets/css/sidebar.css"> -->
    <?php require "../links/header_link.php"; ?>

</head>
<body>
    <div class="form-container">
        <!-- HEADER -->
        <div class="header">
            <div class="header-left">
                <div class="logo doh-logo">
                    <img src="../source/tcp_DOH.jpg" alt="DOH Logo">
                </div>
                <div class="logo bghmc-logo">
                    <img src="../source/tcp_BGHMC.jpg" alt="BGHMC Logo">
                </div>
            </div>

            <div class="header-center">
                <h1>BATAAN GENERAL HOSPITAL AND MEDICAL CENTER</h1>
                <p>Balanga City, Bataan<br>ISO-QMS 9001:2015 Certified</p>
            </div>

            <div class="header-right">
                <div class="logo phu-logo">
                    <img src="../source/tcp_DOH.jpg" alt="DOH Logo">
                </div>
                <div class="logo bp-logo">
                    <img src="../source/tcp_BP.jpg" alt="BP Logo">
                </div>
            </div>
        </div>


        <!-- PATIENT INFO -->
        <div class="patient-info">
            <div>
                Name:
                <input type="text" name="patient_name" class="text-input">
            </div>
            <div>
                Age/Sex:
                <input type="text" name="age_sex" class="text-input small">
            </div>
            <div>
                Date:
                <input type="date" name="exam_date" class="text-input small">
            </div>
        </div>


        <h2 class="form-title">GAD-7: GENERALIZED ANXIETY DISORDER</h2>

        <table class="gad-table">
            <thead>
                <tr>
                    <th class="question-col">
                        Over the last two weeks, how often have you been bothered by the following problems?
                    </th>
                    <th>Not at All</th>
                    <th>Several Days</th>
                    <th>More than Half the Days</th>
                    <th>Nearly Every Day</th>
                </tr>
            </thead>
            <tbody>

                <!-- Q1 -->
                <tr>
                    <td>1. Feeling nervous, anxious, or on edge</td>
                    <td><input type="radio" name="q1" value="0">0</td>
                    <td><input type="radio" name="q1" value="1">1</td>
                    <td><input type="radio" name="q1" value="2">2</td>
                    <td><input type="radio" name="q1" value="3">3</td>
                </tr>

                <!-- Q2 -->
                <tr>
                    <td>2. Not being able to stop or control worrying</td>
                    <td><input type="radio" name="q2" value="0">0</td>
                    <td><input type="radio" name="q2" value="1">1</td>
                    <td><input type="radio" name="q2" value="2">2</td>
                    <td><input type="radio" name="q2" value="3">3</td>
                </tr>

                <!-- Q3 -->
                <tr>
                    <td>3. Worrying too much about different things</td>
                    <td><input type="radio" name="q3" value="0">0</td>
                    <td><input type="radio" name="q3" value="1">1</td>
                    <td><input type="radio" name="q3" value="2">2</td>
                    <td><input type="radio" name="q3" value="3">3</td>
                </tr>

                <!-- Q4 -->
                <tr>
                    <td>4. Trouble relaxing</td>
                    <td><input type="radio" name="q4" value="0">0</td>
                    <td><input type="radio" name="q4" value="1">1</td>
                    <td><input type="radio" name="q4" value="2">2</td>
                    <td><input type="radio" name="q4" value="3">3</td>
                </tr>

                <!-- Q5 -->
                <tr>
                    <td>5. Being so restless that it is hard to sit still</td>
                    <td><input type="radio" name="q5" value="0">0</td>
                    <td><input type="radio" name="q5" value="1">1</td>
                    <td><input type="radio" name="q5" value="2">2</td>
                    <td><input type="radio" name="q5" value="3">3</td>
                </tr>

                <!-- Q6 -->
                <tr>
                    <td>6. Becoming easily annoyed or irritable</td>
                    <td><input type="radio" name="q6" value="0">0</td>
                    <td><input type="radio" name="q6" value="1">1</td>
                    <td><input type="radio" name="q6" value="2">2</td>
                    <td><input type="radio" name="q6" value="3">3</td>
                </tr>

                <!-- Q7 -->
                <tr>
                    <td>7. Feeling afraid, as if something awful might happen</td>
                    <td><input type="radio" name="q7" value="0">0</td>
                    <td><input type="radio" name="q7" value="1">1</td>
                    <td><input type="radio" name="q7" value="2">2</td>
                    <td><input type="radio" name="q7" value="3">3</td>
                </tr>

            </tbody>
        </table>
    

        <!-- SCORE -->
        <div class="score-section">
            <div class="score-box">COLUMN</div>
            <div class="score-input" data-score="0"></div>
            <div class="score-input" data-score="1"></div>
            <div class="score-input" data-score="2"></div>
            <div class="score-input" data-score="3"></div>
        </div>



        <div class="total-section">
            <div class="score-box">TOTAL SCORE</div>
            <input type="text" id="totalScore" name="total_score" class="total-input" readonly>
        </div>

        <!-- FUNCTIONAL DIFFICULTY -->
        <table class="difficulty-table">
            <tr>
                <td class="difficulty-question">
                    If you checked any problems, how difficult have they made it for you to do your work,
                    take care of things at home, or get along with other people?
                </td>
                <td><input type="radio" name="difficulty" value="0"> Not Difficult</td>
                <td><input type="radio" name="difficulty" value="1"> Somewhat</td>
                <td><input type="radio" name="difficulty" value="2"> Very</td>
                <td><input type="radio" name="difficulty" value="3"> Extremely</td>
            </tr>
        </table>

        <!-- SIGNATURE -->
        <div class="footer">
            <div>
                Attending Physician:
                <input type="text" name="physician" class="text-input">
            </div>
            <div>
                License No:
                <input type="text" name="license_no" class="text-input">
            </div>
            <div>
                Date:
                <input type="date" name="physician_date" class="text-input small">
            </div>

            <span class="phu-form">PHU-F-33-00</span>
        </div>

        <div class="form-actions">
            <button type="button" id="submitForm">Submit Form</button>
        </div>
    </div>


    <div id="resultModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">

            <h2 class="modal-title">GAD-7 Assessment Result</h2>

            <div class="result-summary">
                <div>
                    <span class="label">Total Score</span>
                    <span id="resultScore" class="score-value"></span>
                </div>
                <div>
                    <span class="label">Severity</span>
                    <span id="resultSeverity" class="severity-badge"></span>
                </div>
            </div>

            <table class="severity-table">
                <thead>
                    <tr>
                        <th>Score Range</th>
                        <th>Anxiety Severity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-min="0" data-max="4"><td>0–4</td><td>Minimal</td></tr>
                    <tr data-min="5" data-max="9"><td>5–9</td><td>Mild</td></tr>
                    <tr data-min="10" data-max="14"><td>10–14</td><td>Moderate</td></tr>
                    <tr data-min="15" data-max="21"><td>15–21</td><td>Severe</td></tr>
                </tbody>
            </table>

            <!-- CONSENT (only for Moderate–Severe) -->
            <div id="consentSection" class="consent-section" style="display:none;">
                <p class="alert-text">
                    This result indicates <strong>moderate to severe anxiety</strong>.
                </p>

                <p class="disclaimer-text">
                    Your data is confidential. You may optionally provide your mobile number
                    so a health professional can contact you for support.
                </p>

                <div class="consent-options">
                    <label>
                        <input type="radio" name="consentChoice" value="agree">
                        <span>I agree</span>
                    </label>
                    <label>
                        <input type="radio" name="consentChoice" value="decline">
                        <span>No thanks</span>
                    </label>
                </div>
            </div>

            <!-- OPTIONAL CONTACT INPUT -->
            <div id="contactSection" class="contact-section" style="display:none;">
                <label for="contactNumber">Mobile Number (Optional)</label>
                <input type="text" id="contactNumber" placeholder="09XXXXXXXXX">
            </div>

            <button id="confirmSubmit" class="btn-primary" disabled>
                Confirm & Save
            </button>

        </div>
    </div>




    <script src="../assets/js/GAD_7.js"></script>
</body>
</html>