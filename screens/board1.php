<?php
session_start();
if (!isset($_SESSION['wealth'])) {
  $_SESSION['wealth'] = rand(-5000, 20000); // Rich/poor start
  $_SESSION['age'] = 18;
  $_SESSION['position'] = 0;
}
?>

<?php include 'includes/header.php'; ?>

<div class="board">
  <h2>Choose Your Path</h2>
  <p>Wealth: $<?php echo $_SESSION['wealth']; ?></p>
  <p>Age: <?php echo $_SESSION['age']; ?></p>

  <form method="post" action="process_choice.php">
    <label><input type="radio" name="career" value="college"> College (-$5000)</label>
    <label><input type="radio" name="career" value="army"> Army (+$2000)</label>
    <button type="submit">Submit</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
