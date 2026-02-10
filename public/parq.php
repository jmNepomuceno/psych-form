<?php 
    include('../session.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PAR-Q+ Form</title>
    <link rel="stylesheet" href="../assets/css/parq.css">
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

        <h2 class="form-title">Physical Activity Readiness Questionnaire (PAR-Q+)</h2>
        <p><strong>Instructions:</strong> Please read the 7 questions below carefully and answer each one honestly by checking YES or NO.</p>

        <!-- MAIN QUESTIONS -->
        <table class="parq-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>YES</th>
                    <th>NO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. Has your doctor ever said that you have a heart condition OR high blood pressure?</td>
                    <td><input type="radio" name="q1" value="yes"></td>
                    <td><input type="radio" name="q1" value="no"></td>
                </tr>
                <tr>
                    <td>2. Do you feel pain in your chest at rest, during daily activities, OR when you do physical activity?</td>
                    <td><input type="radio" name="q2" value="yes"></td>
                    <td><input type="radio" name="q2" value="no"></td>
                </tr>
                <tr>
                    <td>3. Do you lose balance due to dizziness OR have you lost consciousness in the last 12 months?</td>
                    <td><input type="radio" name="q3" value="yes"></td>
                    <td><input type="radio" name="q3" value="no"></td>
                </tr>
                <tr>
                    <td>4. Have you ever been diagnosed with another chronic medical condition (other than heart disease or high blood pressure)?<br>PLEASE LIST CONDITION(S) HERE: <input type="text" name="q4_condition" class="text-input"></td>
                    <td><input type="radio" name="q4" value="yes"></td>
                    <td><input type="radio" name="q4" value="no"></td>
                </tr>
                <tr>
                    <td>5. Are you currently taking prescribed medications for a chronic medical condition?<br>PLEASE LIST CONDITION(S) AND MEDICATIONS HERE: <input type="text" name="q5_medications" class="text-input"></td>
                    <td><input type="radio" name="q5" value="yes"></td>
                    <td><input type="radio" name="q5" value="no"></td>
                </tr>
                <tr>
                    <td>6. Do you currently have (or had in the past 12 months) a bone, joint, or soft tissue problem that could be made worse by becoming more physically active?<br>PLEASE LIST CONDITION(S) HERE: <input type="text" name="q6_condition" class="text-input"></td>
                    <td><input type="radio" name="q6" value="yes"></td>
                    <td><input type="radio" name="q6" value="no"></td>
                </tr>
                <tr>
                    <td>7. Has your doctor ever said that you should only do medically supervised physical activity?</td>
                    <td><input type="radio" name="q7" value="yes"></td>
                    <td><input type="radio" name="q7" value="no"></td>
                </tr>
            </tbody>
        </table>

        <h3 class="form-subtitle">Follow-Up Questions (If YES to any above)</h3>
        <table class="parq-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>YES</th>
                    <th>NO</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1. Do you have Arthritis, Osteoporosis, or Back Problems? 
                        <br>
                        <i>If the above condition(s) is/are present, answer questions 1a-1c If NO go to question 2</i>
                    </td>
                    <td><input type="radio" name="q1_" value="yes"></td>
                    <td><input type="radio" name="q1_" value="no"></td>
                </tr>
                <!-- ---------------------------------------------------------- -->

                <tr>
                    <td>1a. Do you have difficulty controlling Arthritis, Osteoporosis, or Back Problems with medications or other therapies?</td>
                    <td><input type="radio" name="q1a" value="yes"></td>
                    <td><input type="radio" name="q1a" value="no"></td>
                </tr>
                <tr>
                    <td>1b. Do you have joint problems causing pain, recent fracture, or other serious musculoskeletal conditions?</td>
                    <td><input type="radio" name="q1b" value="yes"></td>
                    <td><input type="radio" name="q1b" value="no"></td>
                </tr>
                <tr>
                    <td>1c. Have you had steroid injections or tablets regularly for more than 3 months?</td>
                    <td><input type="radio" name="q1c" value="yes"></td>
                    <td><input type="radio" name="q1c" value="no"></td>
                </tr>
                
                <tr>
                    <td>2. Do you currently have Cancer of any kind?
                        <br>
                        <i>If the above condition(s) is/are present, answer questions 2a-2b. If NO go to question 3</i>
                    </td>
                    <td><input type="radio" name="q2_" value="yes"></td>
                    <td><input type="radio" name="q2_" value="no"></td>
                </tr>

                <tr>
                    <td>2a. Does your cancer diagnosis include any of the following types: lung/bronchogenic, multiple myeloma (cancer of plasma cells), head, and/or neck?	</td>
                    <td><input type="radio" name="q2a" value="yes"></td>
                    <td><input type="radio" name="q2a" value="no"></td>
                </tr>

                <tr>
                    <td>2b. Are you currently receiving cancer therapy (such as chemotheraphy or radiotherapy)?</td>
                    <td><input type="radio" name="q2b" value="yes"></td>
                    <td><input type="radio" name="q2b" value="no"></td>
                </tr>

                <!-- ================= QUESTION 3 ================= -->
                <tr>
                    <td>
                        3. Do you have a Heart or Cardiovascular Condition? This includes Coronary Artery Disease, Heart Failure,
                        or Diagnosed Abnormality of Heart Rhythm.
                        <br>
                        <i>If YES, answer questions 3a–3d. If NO go to question 4</i>
                    </td>
                    <td><input type="radio" name="q3_" value="yes"></td>
                    <td><input type="radio" name="q3_" value="no"></td>
                </tr>

                <tr>
                    <td>3a. Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?</td>
                    <td><input type="radio" name="q3a" value="yes"></td>
                    <td><input type="radio" name="q3a" value="no"></td>
                </tr>

                <tr>
                    <td>3b. Do you have an irregular heart beat that requires medical management?</td>
                    <td><input type="radio" name="q3b" value="yes"></td>
                    <td><input type="radio" name="q3b" value="no"></td>
                </tr>

                <tr>
                    <td>3c. Do you have chronic heart failure?</td>
                    <td><input type="radio" name="q3c" value="yes"></td>
                    <td><input type="radio" name="q3c" value="no"></td>
                </tr>

                <tr>
                    <td>3d. Do you have diagnosed coronary artery disease and have not participated in regular physical activity in the last 2 months?</td>
                    <td><input type="radio" name="q3d" value="yes"></td>
                    <td><input type="radio" name="q3d" value="no"></td>
                </tr>

                <!-- ================= QUESTION 4 ================= -->
                <tr>
                    <td>
                        4. Do you currently have High Blood Pressure?
                        <br>
                        <i>If YES, answer questions 4a–4b. If NO go to question 5</i>
                    </td>
                    <td><input type="radio" name="q4_" value="yes"></td>
                    <td><input type="radio" name="q4_" value="no"></td>
                </tr>

                <tr>
                    <td>4a. Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?</td>
                    <td><input type="radio" name="q4a" value="yes"></td>
                    <td><input type="radio" name="q4a" value="no"></td>
                </tr>

                <tr>
                    <td>4b. Do you have a resting blood pressure equal to or greater than 160/90 mmHg?</td>
                    <td><input type="radio" name="q4b" value="yes"></td>
                    <td><input type="radio" name="q4b" value="no"></td>
                </tr>

                <!-- ================= QUESTION 5 ================= -->
                <tr>
                    <td>
                        5. Do you have any Metabolic Conditions? (Type 1 Diabetes, Type 2 Diabetes, Pre-Diabetes)
                        <br>
                        <i>If YES, answer questions 5a–5e. If NO go to question 6</i>
                    </td>
                    <td><input type="radio" name="q5_" value="yes"></td>
                    <td><input type="radio" name="q5_" value="no"></td>
                </tr>

                <tr>
                    <td>5a. Do you have difficulty controlling your blood sugar levels?</td>
                    <td><input type="radio" name="q5a" value="yes"></td>
                    <td><input type="radio" name="q5a" value="no"></td>
                </tr>

                <tr>
                    <td>5b. Do you often experience symptoms of low blood sugar (hypoglycemia)?</td>
                    <td><input type="radio" name="q5b" value="yes"></td>
                    <td><input type="radio" name="q5b" value="no"></td>
                </tr>

                <tr>
                    <td>5c. Do you have complications affecting your heart, eyes, kidneys, or feet?</td>
                    <td><input type="radio" name="q5c" value="yes"></td>
                    <td><input type="radio" name="q5c" value="no"></td>
                </tr>

                <tr>
                    <td>5d. Do you have other metabolic conditions (e.g., kidney disease, liver problems)?</td>
                    <td><input type="radio" name="q5d" value="yes"></td>
                    <td><input type="radio" name="q5d" value="no"></td>
                </tr>

                <tr>
                    <td>5e. Are you planning unusually high or vigorous intensity exercise soon?</td>
                    <td><input type="radio" name="q5e" value="yes"></td>
                    <td><input type="radio" name="q5e" value="no"></td>
                </tr>

                <!-- ================= QUESTION 6 ================= -->
                <tr>
                    <td>
                        6. Do you have any Mental Health Problems or Learning Difficulties?
                        <br>
                        <i>If YES, answer questions 6a–6b. If NO go to question 7</i>
                    </td>
                    <td><input type="radio" name="q6_" value="yes"></td>
                    <td><input type="radio" name="q6_" value="no"></td>
                </tr>

                <tr>
                    <td>6a. Do you have difficulty controlling your condition with medications or other therapies?</td>
                    <td><input type="radio" name="q6a" value="yes"></td>
                    <td><input type="radio" name="q6a" value="no"></td>
                </tr>

                <tr>
                    <td>6b. Do you have Down Syndrome with back problems affecting nerves or muscles?</td>
                    <td><input type="radio" name="q6b" value="yes"></td>
                    <td><input type="radio" name="q6b" value="no"></td>
                </tr>

                <!-- ---------------------------------------------------------- -->
                <tr>
                    <td>
                        7. Do you have a Respiratory Disease?
                        <br>
                        <i>
                            This includes Chronic Obstructive Pulmonary Disease (COPD), Asthma,
                            Pulmonary High Blood Pressure.
                            <br>
                            If YES, answer questions 7a–7d. If NO, go to question 8.
                        </i>
                    </td>
                    <td><input type="radio" name="q7_" value="yes"></td>
                    <td><input type="radio" name="q7_" value="no"></td>
                </tr>

                <tr>
                    <td>7a. Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?</td>
                    <td><input type="radio" name="q7a" value="yes"></td>
                    <td><input type="radio" name="q7a" value="no"></td>
                </tr>

                <tr>
                    <td>7b. Has your doctor ever said your blood oxygen level is low at rest or during exercise and/or that you require supplemental oxygen therapy?</td>
                    <td><input type="radio" name="q7b" value="yes"></td>
                    <td><input type="radio" name="q7b" value="no"></td>
                </tr>

                <tr>
                    <td>
                        7c. If asthmatic, do you currently have symptoms of chest tightness, wheezing,
                        laboured breathing, consistent cough (more than 2 days/week), or have you used
                        your rescue medication more than twice in the last week?
                    </td>
                    <td><input type="radio" name="q7c" value="yes"></td>
                    <td><input type="radio" name="q7c" value="no"></td>
                </tr>

                <tr>
                    <td>7d. Has your doctor ever said you have high blood pressure in the blood vessels of your lungs?</td>
                    <td><input type="radio" name="q7d" value="yes"></td>
                    <td><input type="radio" name="q7d" value="no"></td>
                </tr>

                <!-- ---------------------------------------------------------- -->
                <tr>
                    <td>
                        8. Do you have a Spinal Cord Injury?
                        <br>
                        <i>
                            This includes Tetraplegia and Paraplegia.
                            <br>
                            If YES, answer questions 8a–8c. If NO, go to question 9.
                        </i>
                    </td>
                    <td><input type="radio" name="q8_" value="yes"></td>
                    <td><input type="radio" name="q8_" value="no"></td>
                </tr>

                <tr>
                    <td>8a. Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?</td>
                    <td><input type="radio" name="q8a" value="yes"></td>
                    <td><input type="radio" name="q8a" value="no"></td>
                </tr>

                <tr>
                    <td>8b. Do you commonly exhibit low resting blood pressure significant enough to cause dizziness, light-headedness, and/or fainting?</td>
                    <td><input type="radio" name="q8b" value="yes"></td>
                    <td><input type="radio" name="q8b" value="no"></td>
                </tr>

                <tr>
                    <td>8c. Has your physician indicated that you exhibit sudden bouts of high blood pressure (known as Autonomic Dysreflexia)?</td>
                    <td><input type="radio" name="q8c" value="yes"></td>
                    <td><input type="radio" name="q8c" value="no"></td>
                </tr>

                <!-- ---------------------------------------------------------- -->
                <tr>
                    <td>
                        9. Have you had a Stroke?
                        <br>
                        <i>
                            This includes Transient Ischemic Attack (TIA) or Cerebrovascular Event.
                            <br>
                            If YES, answer questions 9a–9c. If NO, go to question 10.
                        </i>
                    </td>
                    <td><input type="radio" name="q9_" value="yes"></td>
                    <td><input type="radio" name="q9_" value="no"></td>
                </tr>

                <tr>
                    <td>9a. Do you have difficulty controlling your condition with medications or other physician-prescribed therapies?</td>
                    <td><input type="radio" name="q9a" value="yes"></td>
                    <td><input type="radio" name="q9a" value="no"></td>
                </tr>

                <tr>
                    <td>9b. Do you have any impairment in walking or mobility?</td>
                    <td><input type="radio" name="q9b" value="yes"></td>
                    <td><input type="radio" name="q9b" value="no"></td>
                </tr>

                <tr>
                    <td>9c. Have you experienced a stroke or impairment in nerves or muscles in the past 6 months?</td>
                    <td><input type="radio" name="q9c" value="yes"></td>
                    <td><input type="radio" name="q9c" value="no"></td>
                </tr>

                <!-- ---------------------------------------------------------- -->
                <tr>
                    <td>
                        10. Do you have any other medical condition not listed above OR do you have two or more medical conditions?
                        <br>
                        <i>
                            If YES, answer questions 10a–10c.
                            <br>
                            If NO, proceed to the recommendations.
                        </i>
                    </td>
                    <td><input type="radio" name="q10_" value="yes"></td>
                    <td><input type="radio" name="q10_" value="no"></td>
                </tr>

                <tr>
                    <td>
                        10a. Have you experienced a blackout, fainted, or lost consciousness as a result
                        of a head injury within the last 12 months OR have you had a diagnosed concussion
                        within the last 12 months?
                    </td>
                    <td><input type="radio" name="q10a" value="yes"></td>
                    <td><input type="radio" name="q10a" value="no"></td>
                </tr>

                <tr>
                    <td>10b. Do you have a medical condition that is not listed (such as epilepsy, neurological conditions, kidney problems)?</td>
                    <td><input type="radio" name="q10b" value="yes"></td>
                    <td><input type="radio" name="q10b" value="no"></td>
                </tr>

                <tr>
                    <td>10c. Do you currently live with two or more medical conditions?</td>
                    <td><input type="radio" name="q10c" value="yes"></td>
                    <td><input type="radio" name="q10c" value="no"></td>
                </tr>


            </tbody>
        </table>

        <!-- FORM ACTIONS -->
        <div class="form-actions">
            <button type="button" id="submitForm">Submit Form</button>
        </div>

    </div>

    <div id="parqResultModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">

            <h2 class="modal-title">Physical Activity Readiness Questionnaire (PAR-Q+) Result</h2>

            <!-- RESULT SUMMARY -->
            <div class="result-summary">
                <div>
                    <span class="label">Completion Status</span>
                    <span id="parqResultStatus" class="score-value"></span>
                </div>
                <div>
                    <span class="label">Recommendation</span>
                    <span id="parqResultRecommendation" class="severity-badge"></span>
                </div>
            </div>

            <!-- ADVICE TABLE -->
            <table class="severity-table">
                <thead>
                    <tr>
                        <th>Response Type</th>
                        <th>Recommendation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr data-type="all-no"><td>All NO answers</td><td>Cleared for physical activity</td></tr>
                    <tr data-type="one-or-more-yes"><td>One or more YES answers</td><td>Consult your doctor before becoming more active</td></tr>
                </tbody>
            </table>

            <!-- CONSENT (If medical risk present) -->
            <div id="parqConsentSection" class="consent-section" style="display:none;">
                <p class="alert-text">
                    You answered YES to one or more questions indicating a potential medical risk.
                </p>
                <p class="disclaimer-text">
                    You may optionally provide your mobile number so a health professional
                    can contact you for guidance on safe physical activity.
                </p>
                <div class="consent-options">
                    <label>
                        <input type="radio" name="parqConsentChoice" value="agree">
                        <span>I agree</span>
                    </label>
                    <label>
                        <input type="radio" name="parqConsentChoice" value="decline">
                        <span>No thanks</span>
                    </label>
                </div>
            </div>

            <!-- OPTIONAL CONTACT NUMBER -->
            <div id="parqContactSection" class="contact-section" style="display:none;">
                <label for="parqContactNumber">Mobile Number (Optional)</label>
                <input type="text" id="parqContactNumber" placeholder="09XXXXXXXXX">
            </div>

            <!-- CONFIRM BUTTON -->
            <button id="parqConfirmSubmit" class="btn-primary" disabled>
                Confirm & Save
            </button>

        </div>
    </div>



    <script src="../assets/js/parq.js"></script>
</body>
</html>