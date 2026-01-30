<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHU Dashboard</title>

    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <!-- <link rel="stylesheet" href="../assets/css/sidebar.css"> -->
    <?php require "../links/header_link.php"; ?>
</head>
<body>

    <div class="dashboard-container">

        <h1>PHU Mental Health Dashboard</h1>

        <!-- PHQ-9 TABLE -->
        <div class="table-card">
            <h2>PHQ-9 Submissions</h2>
            <table id="phqTable" class="display" style="width:100%">
                 <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact Number</th>
                        <th>Total Score</th>
                        <th>Severity</th>
                        <th>Date Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <!-- GAD-7 TABLE -->
        <div class="table-card">
            <h2>GAD-7 Submissions</h2>
            <table id="gadTable" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact Number</th>
                        <th>Total Score</th>
                        <th>Severity</th>
                        <th>Date Submitted</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </div>

    <!-- VIEW FORM MODAL -->
    <div id="viewModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <div class="modal-header">
                <h3 id="modalTitle">View Form</h3>
                <button class="modal-close">&times;</button>
            </div>

            <div class="modal-body" id="modalContent">
                <!-- AJAX-loaded content here -->
            </div>
        </div>
    </div>

    <div id="gad7FormTemplate" style="display:none;">
        <div class="form-container">
            <h3>Patient Info</h3>
            <input type="text" name="patient_name" placeholder="Patient Name">
            <input type="text" name="age_sex" placeholder="Age/Sex">
            <input type="date" name="exam_date">

            <h3>GAD-7 Questions</h3>
            <table>
                <tbody>
                    <tr>
                        <td>1. Feeling nervous...</td>
                        <td><input type="radio" name="q1" value="0"></td>
                        <td><input type="radio" name="q1" value="1"></td>
                        <td><input type="radio" name="q1" value="2"></td>
                        <td><input type="radio" name="q1" value="3"></td>
                    </tr>
                    <!-- Repeat for q2-q7 -->
                </tbody>
            </table>

            <h3>Functional Difficulty</h3>
            <input type="radio" name="difficulty" value="0"> Not difficult
            <input type="radio" name="difficulty" value="1"> Somewhat difficult
            <input type="radio" name="difficulty" value="2"> Very difficult

            <h3>Physician</h3>
            <input type="text" name="physician" placeholder="Physician">
            <input type="text" name="license_no" placeholder="License No.">
            <input type="date" name="physician_date">

            <input type="text" id="totalScore" placeholder="Total Score">
            <button id="submitForm">Submit</button>
        </div>
    </div>



    <script src="../assets/js/dashboard.js"></script>
</body>
</html>
