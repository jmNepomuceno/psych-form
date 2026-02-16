<header class="app-header">
    <div class="header-left">
        <button class="btn-back" onclick="history.back()">
            ← Back
        </button>
    </div>

    <div class="header-right">

        <!-- HEADER ACTION ICONS -->
        <?php if($_SESSION['user'] == 2078 || $_SESSION['user'] == 3858 || $_SESSION['user'] == 5057 || $_SESSION['user'] == 3671){ ?>
        <div class="header-actions">

            <button class="header-icon-btn icon-announcement" 
                    id="btnAnnouncement" 
                    title="System Announcement">
                <i class="bi bi-megaphone-fill"></i>
            </button>

            <button class="header-icon-btn icon-suggestion" 
                    id="btnSuggestion" 
                    title="Send Suggestion">
                <i class="bi bi-lightbulb-fill"></i>
            </button>

            <button class="header-icon-btn icon-concern" 
                    id="btnConcern" 
                    title="Report Concern">
                <i class="bi bi-exclamation-triangle-fill"></i>
            </button>

        </div>
        <?php } ?>
        <!-- Account Info -->
        <div class="account-info">
            <span class="account-name">
                <?php echo $_SESSION['name'] ?? 'Guest'; ?>
            </span>
        </div>

        <!-- Logout Button -->
        <form action="../assets/php/logout.php" method="POST" class="logout-form">
            <button type="submit" class="btn-logout">
                Logout
            </button>
        </form>

    </div>
</header>

<?php include 'modal_notif.php'; ?>
<script src="../assets/js/modal_notif.js"></script>
