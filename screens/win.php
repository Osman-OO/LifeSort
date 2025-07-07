<?php
session_start();
include 'includes/db.php';

// Save to leaderboard
save_score("Player", $_SESSION['age'], $_SESSION['wealth']);

// Reset session
session_destroy();
?>

<?php include 'includes/header.php'; ?>

<div class="win">
  <h1>CONGRATULATIONS!</h1>
  <p>You retired at age <?php echo $_SESSION['age']; ?> with $<?php echo $_SESSION['wealth']; ?>!</p>
  <a href="leaderboard.php" class="btn">View Leaderboard</a>
  <a href="index.php" class="btn">Play Again</a>
</div>

<?php include 'includes/footer.php'; ?>
