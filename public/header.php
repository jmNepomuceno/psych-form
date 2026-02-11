<header class="app-header">
    <div class="header-left">
        <!-- Back / Return Button -->
        <button class="btn-back" onclick="history.back()">
            ← Back
        </button>
    </div>

    <div class="header-right">
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
