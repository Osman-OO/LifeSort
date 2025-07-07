<?php
session_start();
include 'includes/db.php';

// Save score to leaderboard
save_score("Player", $_SESSION['age'], $_SESSION['wealth']);

// Reset game (optional)
session_destroy();
?>

<?php include 'includes/header.php'; ?>
<div class="win-screen">
  <h1>You Won!</h1>
  <p>Retired at age <?php echo $_SESSION['age']; ?> with $<?php echo $_SESSION['wealth']; ?>.</p>
  <a href="leaderboard.php" class="btn">Leaderboard</a>
</div>
<?php include 'includes/footer.php'; ?>
