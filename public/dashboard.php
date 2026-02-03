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
        <h1>PHU Health Assessment Dashboard</h1>

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

            <div class="modal-body" id="modalContent">
                <p>This is the modal content. You can add text, tables, forms, or other elements here.</p>
            </div>
        </div>
    </div>


    <script src="../assets/js/dashboard.js"></script>
</body>
</html>
