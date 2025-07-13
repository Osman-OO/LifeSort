<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LifeRoll - Board Game</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/boards.css">
    <link rel="stylesheet" href="../assets/css/animations.css">
</head>
<body>
    <nav class="game-nav">
        <div class="nav-brand">🎲 LifeRoll</div>
        <div class="nav-center">
            <a href="index.php">🏠 Home</a>
            <a href="leaderboard.php">🏆 Leaderboard</a>
        </div>
        <div class="nav-account">
            <?php if (isset($_SESSION['username'])): ?>
                <div class="account-dropdown">
                    <button class="account-btn" onclick="toggleDropdown()">
                        👤 <?php echo htmlspecialchars($_SESSION['username']); ?> ▼
                    </button>
                    <div class="dropdown-content" id="accountDropdown">
                        <a href="account.php">👤 My Account</a>
                        <a href="logout.php">🚪 Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" class="login-link">🔑 Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <script>
    function toggleDropdown() {
        document.getElementById("accountDropdown").classList.toggle("show");
    }

    // Close dropdown when clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('.account-btn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
    </script>
