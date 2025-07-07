<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $career = $_POST['career'];
  
  switch ($career) {
    case 'college':
      $_SESSION['wealth'] -= 5000;
      $_SESSION['education'] = 'college';
      break;
    case 'army':
      $_SESSION['wealth'] += 2000;
      $_SESSION['education'] = 'army';
      break;
  }

  // Check for bankruptcy
  if ($_SESSION['wealth'] <= 0) {
    header("Location: gameover.php");
    exit;
  }

  header("Location: roll.php"); // Proceed to dice roll
}
?>
