<?php include 'includes/header.php'; ?>

<div class="board">
  <h2>Pre-Retirement</h2>
  <p>Wealth: $<?php echo $_SESSION['wealth']; ?></p>
  <p>Age: <?php echo $_SESSION['age']; ?></p>
  <p>Position: <?php echo $_SESSION['position']; ?></p>

  <form method="post" action="process_choice.php">
    <h3>Final Decisions:</h3>
    <label>
      <input type="radio" name="retirement" value="early" required> 
      Retire Early (Age <?php echo $_SESSION['age']; ?>, 80% Wealth)
    </label><br>
    <label>
      <input type="radio" name="retirement" value="normal"> 
      Retire at 65 (Keep Wealth)
    </label><br>
    <label>
      <input type="radio" name="retirement" value="risk"> 
      Gamble (50%: Double or Half Wealth)
    </label><br>
    <button type="submit" class="btn">Submit</button>
  </form>

  <!-- Auto-retire at age 65 -->
  <?php if ($_SESSION['age'] >= 65): ?>
    <script>window.location.href = 'win.php';</script>
  <?php endif; ?>
</div>

<?php include 'includes/footer.php'; ?>
