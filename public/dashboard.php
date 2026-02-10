<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHU Dashboard</title>

    <link rel="stylesheet" href="../assets/css/dashboard.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <?php require "../links/header_link.php"; ?>
</head>
<body>
    <?php include 'header.php'; ?>

    <div class="dashboard-container">
        <!-- <div class="logo-row">
            <img src="../source/tcp_BGHMC_2.png" alt="BGHMC Logo">
            <img src="../source/tcp_DOH_2.png" alt="DOH Logo">
            <img src="../source/tcp_BP_2.png" alt="Bagong Pilipinas Logo">
            <img src="../source/phu_bg.jpg" alt="PHU Logo">
        </div> -->

        

         <!-- HEADER WITH LOGOS -->
        <div class="dashboard-header">
            <div class="logo-row">
                <img src="../source/tcp_DOH_2.png" alt="DOH Logo">
                <img src="../source/tcp_BGHMC_2.png" alt="BGHMC Logo">
            </div>

            <h1>PHU Health Assessment Dashboard</h1>

            <div class="logo-row">
                <img src="../source/phu_bg.jpg" alt="PHU Logo">
                <img src="../source/tcp_BP_2.png" alt="Bagong Pilipinas Logo">
            </div>
        </div>

        <!-- =========================
            SUMMARY CARDS
        ========================== -->
        <div class="summary-cards">
            <div class="summary-card">
                <h3>PHQ-9</h3>
                <p id="phqCount">0</p>
            </div>
            <div class="summary-card">
                <h3>GAD-7</h3>
                <p id="gadCount">0</p>
            </div>
            <div class="summary-card">
                <h3>AUDIT</h3>
                <p id="auditCount">0</p>
            </div>
            <div class="summary-card">
                <h3>PAR-Q+</h3>
                <p id="parqCount">0</p>
            </div>
            <div class="summary-card">
                <h3>PSQI</h3>
                <p id="psqiCount">0</p>
            </div>
            <div class="summary-card">
                <h3>Fagerstgrom Test</h3>
                <p id="fagerCount">0</p>
            </div>
            <div class="summary-card">
                <h3>PSS Test</h3>
                <p id="pssCount">0</p>
            </div>
        </div>

        <!-- =========================
            TABS
        ========================== -->
        <div class="dashboard-tabs">
            <button class="tab-btn active" data-target="phq9">PHQ-9</button>
            <button class="tab-btn" data-target="gad7">GAD-7</button>
            <button class="tab-btn" data-target="audit">AUDIT</button>
            <button class="tab-btn" data-target="parq">PAR-Q+</button>
            <button class="tab-btn" data-target="psqi">PSQI</button>
            <button class="tab-btn" data-target="fager">Fagerstgrom Test</button>
            <button class="tab-btn" data-target="pss">PSS Test</button>
        </div>

        <!-- =========================
            TABLE PANELS
        ========================== -->
        <div class="table-panel active" id="panel-phq9">
            <table id="table-phq9" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-panel" id="panel-gad7">
            <table id="table-gad7" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-panel" id="panel-audit">
            <table id="table-audit" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-panel" id="panel-parq">
            <table id="table-parq" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-panel" id="panel-psqi">
            <table id="table-psqi" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-panel" id="panel-fager">
            <table id="table-fager" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>

        <div class="table-panel" id="panel-pss">
            <table id="table-pss" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Full Name</th>
                        <th>Contact</th>
                        <th>Score</th>
                        <th>Severity</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <!-- =========================
        VIEW MODAL (UNCHANGED)
    ========================= -->
    <div id="viewModal" class="modal-overlay" style="display:none;">
        <div class="modal-box">
            <div class="modal-header">
                <div class="modal-title-wrapper">
                    <h3 id="modalTitle">Modal Title Here</h3>
                    <!-- <p class="modal-subtitle" id="modalSubtitle">Optional subtitle goes here</p> -->
                </div>
                <button class="modal-close">&times;</button>
            </div>

            <div class="modal-body">

                <!-- RESULT SUMMARY -->
                <div class="result-summary">
                    <div>
                        <span class="label">Total Score</span>
                        <span id="viewScore" class="score-value"></span>
                    </div>
                    <div>
                        <span class="label">Severity</span>
                        <span id="viewSeverity" class="severity-badge"></span>
                    </div>
                </div>

                <!-- SEVERITY TABLE (STATIC like home.php) -->
                <table class="severity-table">
                    <tbody>
                        <tr data-min="0" data-max="4"><td>0–4</td><td>Minimal</td></tr>
                        <tr data-min="5" data-max="9"><td>5–9</td><td>Mild</td></tr>
                        <tr data-min="10" data-max="14"><td>10–14</td><td>Moderate</td></tr>
                        <tr data-min="15" data-max="21"><td>15–21</td><td>Severe</td></tr>
                    </tbody>
                </table>

                <!-- FORM VIEW -->
                <div class="form-view">
                    <iframe id="assessmentFrame"
                            style="width:100%;height:80vh;border:none;"></iframe>
                </div>

            </div>

        </div>
    </div>


    <script src="../assets/js/dashboard.js"></script>
</body>
</html>
