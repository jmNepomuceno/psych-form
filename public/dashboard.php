<?php 
    include('../session.php');
    include('../assets/connection/connection.php');
?>
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
                        <th>Emergency Contact</th>
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
                        <th>Emergency Contact</th>
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
                        <th>Emergency Contact</th>
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
                        <th>Emergency Contact</th>
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
                        <th>Emergency Contact</th>
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
                        <th>Emergency Contact</th>
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
                            style="width:100%;height:150vh;border:none;"></iframe>
                </div>

            </div>

        </div>
    </div>

    <!-- ADMIN ANNOUNCEMENT MODAL -->
    <div class="modal fade admin-announcement-modal" 
        id="adminAnnouncementModal" 
        tabindex="-1" 
        aria-hidden="true">

        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content admin-announcement-content">

                <div class="modal-header admin-announcement-header">
                    <h5 class="modal-title">
                        System Dashboard Announcement
                    </h5>
                    <button type="button" 
                            class="btn-close btn-close-white" 
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body admin-announcement-body">

                    <p class="announcement-greeting">
                        Good Day,
                    </p>

                    <p>
                        This is the viewing of Dashboards for the <strong>Administrators</strong>.
                    </p>

                    <div class="admin-list-wrapper">
                        <p class="admin-list-title">Current System Administrators:</p>
                        <ol class="admin-list">
                            <li>Dra. Charines Reyes – PHU Head</li>
                            <li>Ms. Fritzie Jane Wandas – Psychologist</li>
                            <li>Dra. Maria Fatima Martinez – Psychiatrist</li>
                            <li>John Marvin Nepomuceno – System Admin Developer</li>
                        </ol>
                    </div>

                    <div class="announcement-divider"></div>

                    <p>
                        As of <strong>February 13, 2026</strong>, the initial system
                        requirements have been successfully completed and launched.
                    </p>

                    <p>
                        The system is continuously evolving. We welcome your
                        <strong>suggestions, comments, and reports of visual concerns</strong>
                        within this system.
                    </p>

                    <p class="announcement-highlight">
                        Kindly use the dashboard icons to submit your feedback. (Still under development. Thank you)
                    </p>

                </div>

                <div class="modal-footer admin-announcement-footer">
                    <button type="button" 
                            class="btn btn-primary announcement-close-btn" 
                            data-bs-dismiss="modal">
                        Understood
                    </button>
                </div>

            </div>
        </div>
    </div>

    <!-- SUGGESTION MODAL -->
    <div class="modal fade suggestion-modal" 
        id="suggestionModal" 
        tabindex="-1" 
        aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content suggestion-modal-content">

                <div class="modal-header suggestion-modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-lightbulb-fill me-2"></i>
                        Submit a Suggestion
                    </h5>
                    <button type="button" 
                            class="btn-close btn-close-white" 
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body suggestion-modal-body">
                    <!-- ==================== SUBMIT SUGGESTION FORM ==================== -->
                    <form id="suggestionForm">

                        <!-- Hidden Fields -->
                        <input type="hidden" name="bioID" 
                            value="<?php echo $_SESSION['user'] ?? 0; ?>">

                        <input type="hidden" name="fullName" 
                            value="<?php echo $_SESSION['name'] ?? 'Guest'; ?>">

                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" 
                                name="subject" 
                                class="form-control suggestion-input" 
                                placeholder="Enter subject"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Your Suggestion</label>
                            <textarea name="message" 
                                    class="form-control suggestion-textarea" 
                                    rows="4"
                                    placeholder="Type your suggestion here..."
                                    required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" 
                                    class="btn btn-primary suggestion-submit-btn">
                                Submit Suggestion
                            </button>
                        </div>

                    </form>

                    <!-- Response Message -->
                    <div id="suggestionResponse" class="mt-3"></div>

                    <hr>

                    <!-- ==================== SUGGESTIONS TABLE ==================== -->
                    <h6 class="mt-3">All Suggestions</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="suggestionsTableModal">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Submitted By</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Admin Response</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loaded dynamically via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <!-- ==================== ADMIN RESPONSE MODAL ==================== -->
                    <div class="modal fade" id="respondModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title">Respond to Suggestion</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="respondForm">
                                        <input type="hidden" name="concernID" id="respondConcernID">
                                        <div class="mb-3">
                                            <label id="respondModalSubject" class="form-label fw-bold"></label>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="adminResponse" class="form-control" rows="4" placeholder="Type your response..." required></textarea>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Send Response</button>
                                        </div>
                                    </form>
                                    <div id="responseMessage" class="mt-2"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>

    <!-- CONCERN MODAL -->
    <div class="modal fade concern-modal" 
        id="concernModal" 
        tabindex="-1" 
        aria-hidden="true">

        <div class="modal-dialog modal-md modal-dialog-centered">
            <div class="modal-content concern-modal-content">

                <div class="modal-header concern-modal-header">
                    <h5 class="modal-title">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        Submit a Concern
                    </h5>
                    <button type="button" 
                            class="btn-close btn-close-white" 
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body concern-modal-body">

                    <!-- ==================== SUBMIT CONCERN FORM ==================== -->
                    <form id="concernForm">

                        <!-- Hidden Fields -->
                        <input type="hidden" name="bioID" 
                            value="<?php echo $_SESSION['user'] ?? 0; ?>">

                        <input type="hidden" name="fullName" 
                            value="<?php echo $_SESSION['name'] ?? 'Guest'; ?>">

                        <div class="mb-3">
                            <label class="form-label">Subject</label>
                            <input type="text" 
                                name="subject" 
                                class="form-control concern-input" 
                                placeholder="Enter subject"
                                required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Your Concern</label>
                            <textarea name="message" 
                                    class="form-control concern-textarea" 
                                    rows="4"
                                    placeholder="Type your concern here..."
                                    required></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" 
                                    class="btn btn-danger concern-submit-btn">
                                Submit Concern
                            </button>
                        </div>

                    </form>

                    <!-- Response Message -->
                    <div id="concernResponse" class="mt-3"></div>

                    <hr>

                    <!-- ==================== CONCERNS TABLE ==================== -->
                    <h6 class="mt-3">All Concerns</h6>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="concernsTableModal">
                            <thead class="table-light">
                                <tr>
                                    <th>#</th>
                                    <th>Submitted By</th>
                                    <th>Subject</th>
                                    <th>Message</th>
                                    <th>Status</th>
                                    <th>Admin Response</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Loaded via AJAX -->
                            </tbody>
                        </table>
                    </div>

                    <!-- ==================== ADMIN RESPONSE MODAL ==================== -->
                    <div class="modal fade" id="respondConcernModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-md modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header bg-danger text-white">
                                    <h5 class="modal-title">Respond to Concern</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>

                                <div class="modal-body">
                                    <form id="respondConcernForm">
                                        <input type="hidden" name="concernID" id="respondBugConcernID">
                                        <div class="mb-3">
                                            <label id="respondConcernModalSubject" class="form-label fw-bold"></label>
                                        </div>
                                        <div class="mb-3">
                                            <textarea name="adminResponse" class="form-control" rows="4" placeholder="Type your response..." required></textarea>
                                        </div>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-success">Send Response</button>
                                        </div>
                                    </form>
                                    <div id="respondConcernMessage" class="mt-2"></div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <script src="../assets/js/dashboard.js"></script>
</body>
</html>
