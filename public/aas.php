<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GAD-7 Form</title>
    <link rel="stylesheet" href="../assets/css/aas.css">
    <!-- <link rel="stylesheet" href="../assets/css/sidebar.css"> -->
    <?php require "../links/header_link.php"; ?>

</head>
<body>
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
            <div>Name: <input type="text" name="patient_name" class="text-input"></div>
            <div>Age/Sex: <input type="text" name="age_sex" class="text-input small"></div>
            <div>Date: <input type="date" name="exam_date" class="text-input small"></div>
        </div>

        <h2 class="form-title">AUDIT Alcohol Screening Tool</h2>
        <p><strong>Instructions:</strong></p>
        <ol>
            <li>Answer the following questions about your alcohol use during the past 12 months.</li>
            <li>‘Circle’ one box that best describes your answer to each question. Answer as accurately as you can.</li>
        </ol>

        <!-- AUDIT TABLE -->
        <table class="audit-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>0</th>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. How often do you have a drink containing alcohol?</td>
                    <td><input type="radio" name="q1" value="0"></td>
                    <td><input type="radio" name="q1" value="1"></td>
                    <td><input type="radio" name="q1" value="2"></td>
                    <td><input type="radio" name="q1" value="3"></td>
                    <td><input type="radio" name="q1" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>2. How many drinks containing alcohol do you have on a typical day when you are drinking?</td>
                    <td><input type="radio" name="q2" value="0"></td>
                    <td><input type="radio" name="q2" value="1"></td>
                    <td><input type="radio" name="q2" value="2"></td>
                    <td><input type="radio" name="q2" value="3"></td>
                    <td><input type="radio" name="q2" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>3. How often do you have six or more drinks on one occasion?</td>
                    <td><input type="radio" name="q3" value="0"></td>
                    <td><input type="radio" name="q3" value="1"></td>
                    <td><input type="radio" name="q3" value="2"></td>
                    <td><input type="radio" name="q3" value="3"></td>
                    <td><input type="radio" name="q3" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>4. How often during the last year have you found that you were not able to stop drinking once you had started?</td>
                    <td><input type="radio" name="q4" value="0"></td>
                    <td><input type="radio" name="q4" value="1"></td>
                    <td><input type="radio" name="q4" value="2"></td>
                    <td><input type="radio" name="q4" value="3"></td>
                    <td><input type="radio" name="q4" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>5. How often during the last year have you failed to do what was normally expected of you because of drinking?</td>
                    <td><input type="radio" name="q5" value="0"></td>
                    <td><input type="radio" name="q5" value="1"></td>
                    <td><input type="radio" name="q5" value="2"></td>
                    <td><input type="radio" name="q5" value="3"></td>
                    <td><input type="radio" name="q5" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>6. How often during the last year have you needed a drink first thing in the morning to get yourself going after a heavy drinking session?</td>
                    <td><input type="radio" name="q6" value="0"></td>
                    <td><input type="radio" name="q6" value="1"></td>
                    <td><input type="radio" name="q6" value="2"></td>
                    <td><input type="radio" name="q6" value="3"></td>
                    <td><input type="radio" name="q6" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>7. How often during the last year have you had a feeling of guilt or remorse after drinking?</td>
                    <td><input type="radio" name="q7" value="0"></td>
                    <td><input type="radio" name="q7" value="1"></td>
                    <td><input type="radio" name="q7" value="2"></td>
                    <td><input type="radio" name="q7" value="3"></td>
                    <td><input type="radio" name="q7" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>8. How often during the last year have you been unable to remember what happened the night before because of your drinking?</td>
                    <td><input type="radio" name="q8" value="0"></td>
                    <td><input type="radio" name="q8" value="1"></td>
                    <td><input type="radio" name="q8" value="2"></td>
                    <td><input type="radio" name="q8" value="3"></td>
                    <td><input type="radio" name="q8" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>9. Have you or someone else been injured because of your drinking?</td>
                    <td><input type="radio" name="q9" value="0"></td>
                    <td><input type="radio" name="q9" value="1"></td>
                    <td><input type="radio" name="q9" value="2"></td>
                    <td><input type="radio" name="q9" value="3"></td>
                    <td><input type="radio" name="q9" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
                <tr>
                    <td>10. Has a relative, friend, doctor or other healthcare worker been concerned about your drinking or suggested you cut down?</td>
                    <td><input type="radio" name="q10" value="0"></td>
                    <td><input type="radio" name="q10" value="1"></td>
                    <td><input type="radio" name="q10" value="2"></td>
                    <td><input type="radio" name="q10" value="3"></td>
                    <td><input type="radio" name="q10" value="4"></td>
                    <td class="score-cell"></td>
                </tr>
            </tbody>
        </table>

        <!-- TOTAL SCORE -->
        <div class="total-section">
            <div class="score-box">TOTAL SCORE</div>
            <input type="text" id="totalScore" name="total_score" class="total-input" readonly>
        </div>

        <div class="footer"></div>

        <div class="form-actions">
            <button type="button" id="submitForm">Submit Form</button>
        </div>

    </div>




   <!-- AUDIT RESULT MODAL -->
    <div id="auditResultModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">

            <h2 class="modal-title">AUDIT Alcohol Screening Result</h2>

            <div class="result-summary">
                <div>
                    <span class="label">Total Score</span>
                    <span id="auditResultScore" class="score-value"></span>
                </div>
                <div>
                    <span class="label">Risk Level</span>
                    <span id="auditResultSeverity" class="severity-badge"></span>
                </div>
            </div>

            <!-- AUDIT Severity Table -->
            <table class="severity-table">
                <thead>
                    <tr>
                        <th>Score Range</th>
                        <th>Risk Level</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-min="0" data-max="7"><td>0–7</td><td>Low Risk</td></tr>
                    <tr data-min="8" data-max="15"><td>8–15</td><td>Moderate Risk</td></tr>
                    <tr data-min="16" data-max="19"><td>16–19</td><td>High Risk</td></tr>
                    <tr data-min="20" data-max="40"><td>20–40</td><td>Possible Dependence</td></tr>
                </tbody>
            </table>

            <!-- CONSENT (Moderate Risk & above only) -->
            <div id="auditConsentSection" class="consent-section" style="display:none;">
                <p class="alert-text">
                    This result indicates <strong>alcohol-related risk</strong>.
                </p>

                <p class="disclaimer-text">
                    You may optionally provide your mobile number so a health professional
                    can contact you for guidance on alcohol use management.
                </p>

                <div class="consent-options">
                    <label>
                        <input type="radio" name="auditConsentChoice" value="agree">
                        <span>I agree</span>
                    </label>
                    <label>
                        <input type="radio" name="auditConsentChoice" value="decline">
                        <span>No thanks</span>
                    </label>
                </div>
            </div>

            <!-- OPTIONAL CONTACT -->
            <div id="auditContactSection" class="contact-section" style="display:none;">
                <label for="auditContactNumber">Mobile Number (Optional)</label>
                <input type="text" id="auditContactNumber" placeholder="09XXXXXXXXX">
            </div>

            <button id="auditConfirmSubmit" class="btn-primary" disabled>
                Confirm & Save
            </button>

        </div>
    </div>

    <script src="../assets/js/aas.js"></script>
</body>
</html>