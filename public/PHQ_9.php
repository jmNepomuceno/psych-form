<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHQ-9 Form</title>
    <link rel="stylesheet" href="../assets/css/PHQ_9.css">
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

        <h2 class="form-title">PATIENT HEALTH QUESTIONNAIRE (PHQ-9)</h2>

        <table class="gad-table">
            <thead>
                <tr>
                    <th class="question-col">
                        Over the last 2 weeks, how often have you been bothered by any of the following problems? (Please encircle to indicate your answer)
                    </th>
                    <th>Not at all</th>
                    <th>Several days</th>
                    <th>More than half the days</th>
                    <th>Nearly every day</th>
                </tr>
            </thead>
            <tbody>

                <!-- Q1 -->
                <tr>
                    <td>1. Little interest or pleasure in doing things</td>
                    <td><input type="radio" name="q1" value="0">0</td>
                    <td><input type="radio" name="q1" value="1">1</td>
                    <td><input type="radio" name="q1" value="2">2</td>
                    <td><input type="radio" name="q1" value="3">3</td>
                </tr>

                <!-- Q2 -->
                <tr>
                    <td>2. Feeling down, depressed, or hopeless</td>
                    <td><input type="radio" name="q2" value="0">0</td>
                    <td><input type="radio" name="q2" value="1">1</td>
                    <td><input type="radio" name="q2" value="2">2</td>
                    <td><input type="radio" name="q2" value="3">3</td>
                </tr>

                <!-- Q3 -->
                <tr>
                    <td>3. Trouble falling or staying asleep, or sleeping too much</td>
                    <td><input type="radio" name="q3" value="0">0</td>
                    <td><input type="radio" name="q3" value="1">1</td>
                    <td><input type="radio" name="q3" value="2">2</td>
                    <td><input type="radio" name="q3" value="3">3</td>
                </tr>

                <!-- Q4 -->
                <tr>
                    <td>4. Feeling tired or having little energy</td>
                    <td><input type="radio" name="q4" value="0">0</td>
                    <td><input type="radio" name="q4" value="1">1</td>
                    <td><input type="radio" name="q4" value="2">2</td>
                    <td><input type="radio" name="q4" value="3">3</td>
                </tr>

                <!-- Q5 -->
                <tr>
                    <td>5. Poor appetite or overeating</td>
                    <td><input type="radio" name="q5" value="0">0</td>
                    <td><input type="radio" name="q5" value="1">1</td>
                    <td><input type="radio" name="q5" value="2">2</td>
                    <td><input type="radio" name="q5" value="3">3</td>
                </tr>

                <!-- Q6 -->
                <tr>
                    <td>6. Feeling bad about yourself or that you are a failure or have let yourself or your family down</td>
                    <td><input type="radio" name="q6" value="0">0</td>
                    <td><input type="radio" name="q6" value="1">1</td>
                    <td><input type="radio" name="q6" value="2">2</td>
                    <td><input type="radio" name="q6" value="3">3</td>
                </tr>

                <!-- Q7 -->
                <tr>
                    <td>7. Trouble concentrating on things, such as reading the newspaper or watching television</td>
                    <td><input type="radio" name="q7" value="0">0</td>
                    <td><input type="radio" name="q7" value="1">1</td>
                    <td><input type="radio" name="q7" value="2">2</td>
                    <td><input type="radio" name="q7" value="3">3</td>
                </tr>

                <!-- Q8 -->
                <tr>
                    <td>8. Moving or speaking so slowly that other people could have noticed, or the opposite being so fidgety or restless that you have been moving around a lot more than usual</td>
                    <td><input type="radio" name="q8" value="0">0</td>
                    <td><input type="radio" name="q8" value="1">1</td>
                    <td><input type="radio" name="q8" value="2">2</td>
                    <td><input type="radio" name="q8" value="3">3</td>
                </tr>

                <!-- Q9 -->
                <tr>
                    <td>9. Thoughts that you would be better off dead, or of hurting yourself</td>
                    <td><input type="radio" name="q9" value="0">0</td>
                    <td><input type="radio" name="q9" value="1">1</td>
                    <td><input type="radio" name="q9" value="2">2</td>
                    <td><input type="radio" name="q9" value="3">3</td>
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

            <span class="phu-form">PHU-F-32-00</span>
        </div>

        <div class="form-actions">
            <button type="button" id="submitForm">Submit Form</button>
        </div>
    </div>

    <script src="../assets/js/PHQ_9.js"></script>
</body>
</html>
