<?php
session_start();
// Redirect if player hasn't reached this board yet
if ($_SESSION['position'] < 10) {
  header("Location: board1.php");
  exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="board">
  <h2>Mid-Life Career</h2>
  <p>Wealth: $<?php echo $_SESSION['wealth']; ?></p>
  <p>Age: <?php echo $_SESSION['age']; ?></p>
  <p>Position: <?php echo $_SESSION['position']; ?></p>

  <form method="post" action="process_midlife.php">
    <h3>Choose an Action:</h3>
    <label>
      <input type="radio" name="action" value="invest"> 
      Invest in Stocks (Risk: Lose $3000 or Gain $7000)
    </label><br>
    <label>
      <input type="radio" name="action" value="marry"> 
      Get Married (Cost: $2000)
    </label><br>
    <label>
      <input type="radio" name="action" value="job"> 
      Change Jobs (+$4000/year)
    </label><br>
    <button type="submit">Submit</button>
  </form>

  <a href="roll.php" class="btn">Roll Dice to Move</a>
</div>

<?php include 'includes/footer.php'; ?>
