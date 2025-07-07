<?php
session_start();
if (!isset($_SESSION['wealth'])) {
  $_SESSION['wealth'] = rand(-5000, 20000); // Rich/poor start
  $_SESSION['age'] = 18;
  $_SESSION['position'] = 0;
  $_SESSION['education'] = 'none';
}
?>

<?php include 'includes/header.php'; ?>

<div class="board" style="max-width: 600px; margin: 0 auto; padding: 20px; background: white; border-radius: 10px; box-shadow: 0 0 15px rgba(0,0,0,0.1);">
  <h2 style="color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px;">Choose Your Path</h2>
  
  <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-bottom: 20px;">
    <div>
      <p><strong>Wealth:</strong> $<?php echo number_format($_SESSION['wealth']); ?></p>
      <p><strong>Age:</strong> <?php echo $_SESSION['age']; ?></p>
    </div>
    <div>
      <p><strong>Position:</strong> <?php echo $_SESSION['position']; ?>/30</p>
      <p><strong>Education:</strong> <?php echo ucfirst($_SESSION['education']); ?></p>
    </div>
  </div>

  <form method="post" action="process_choice.php" style="margin-top: 20px;">
    <div style="background: #f8f9fa; padding: 15px; border-radius: 8px;">
      <h3 style="margin-top: 0; color: #3498db;">Select Your Career Path:</h3>
      
      <label style="display: block; padding: 10px; margin: 5px 0; background: #e9f7fe; border-radius: 5px; cursor: pointer; transition: all 0.3s;">
        <input type="radio" name="career" value="college" required style="margin-right: 10px;">
        <strong>College Degree</strong> (-$5,000)<br>
        <small style="color: #7f8c8d;">Higher earning potential</small>
      </label>
      
      <label style="display: block; padding: 10px; margin: 5px 0; background: #e9f7fe; border-radius: 5px; cursor: pointer; transition: all 0.3s;">
        <input type="radio" name="career" value="army" style="margin-right: 10px;">
        <strong>Military Service</strong> (+$2,000)<br>
        <small style="color: #7f8c8d;">Steady income, veterans benefits</small>
      </label>
      
      <label style="display: block; padding: 10px; margin: 5px 0; background: #e9f7fe; border-radius: 5px; cursor: pointer; transition: all 0.3s;">
        <input type="radio" name="career" value="trade" style="margin-right: 10px;">
        <strong>Trade School</strong> (-$3,000)<br>
        <small style="color: #7f8c8d;">Quick entry to workforce</small>
      </label>
    </div>

    <button type="submit" style="background: #3498db; color: white; border: none; padding: 12px 20px; margin-top: 15px; border-radius: 5px; cursor: pointer; font-size: 16px; width: 100%; transition: background 0.3s;" 
            onmouseover="this.style.background='#2980b9'" 
            onmouseout="this.style.background='#3498db'">
      Confirm Choice
    </button>
  </form>
</div>

<?php include 'includes/footer.php'; ?>
