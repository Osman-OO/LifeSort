<?php
session_start();
// Redirect if player hasn't reached this board yet
if ($_SESSION['position'] < 20) {
  header("Location: board2.php");
  exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="board">
  <h2>Pre-Retirement</h2>
  <p>Wealth: $<?php echo $_SESSION['wealth']; ?></p>
  <p>Age: <?php echo $_SESSION['age']; ?></p>
  <p>Position: <?php echo $_SESSION['position']; ?></p>

  <form method="post" action="process_retirement.php">
    <h3>Final Decisions:</h3>
    <label>
      <input type="radio" name="retirement" value="early"> 
      Retire Early (Age <?php echo $_SESSION['age']; ?>, Wealth x0.8)
    </label><br>
    <label>
      <input type="radio" name="retirement" value="normal"> 
      Retire Normally (Age 65, Keep Wealth)
    </label><br>
    <label>
      <input type="radio" name="retirement" value="risk"> 
      Gamble (50%: Double Wealth or Lose Half)
    </label><br>
    <button type="submit">Submit</button>
  </form>

  <!-- Force retirement if age >= 65 -->
  <?php if ($_SESSION['age'] >= 65): ?>
    <script>window.location.href = 'win.php';</script>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
