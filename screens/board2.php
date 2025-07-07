<?php include 'includes/header.php'; ?>

<div class="board">
  <h2>Mid-Life Career</h2>
  <p>Wealth: $<?php echo $_SESSION['wealth']; ?></p>
  <p>Age: <?php echo $_SESSION['age']; ?></p>
  <p>Position: <?php echo $_SESSION['position']; ?></p>

  <form method="post" action="process_choice.php">
    <h3>Life Events:</h3>
    <label>
      <input type="radio" name="action" value="invest" required> 
      Invest in Stocks (50%: +$7,000 or -$3,000)
    </label><br>
    <label>
      <input type="radio" name="action" value="marry"> 
      Get Married (-$2,000)
    </label><br>
    <label>
      <input type="radio" name="action" value="job"> 
      Change Jobs (+$4,000)
    </label><br>
    <label>
      <input type="radio" name="action" value="lottery"> 
      Play Lottery (10%: +$10,000)
    </label><br>
    <button type="submit" class="btn">Submit</button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
