<?php include 'includes/header.php'; ?>

<div class="gameover">
  <h1>GAME OVER</h1>
  <p>You ran out of money at age <?php echo $_SESSION['age']; ?>!</p>
  <a href="index.php" class="btn">Try Again</a>
</div>

<?php include 'includes/footer.php'; ?>
