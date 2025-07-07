<?php
session_start();

// Roll dice and update position/age
$roll = rand(1, 6);
$_SESSION['position'] += $roll;
$_SESSION['age'] += 1;

// Win condition: Reached end of board3 (e.g., position >= 30)
if ($_SESSION['position'] >= 30) {
  header("Location: win.php");
  exit;
}

// Board transitions
if ($_SESSION['position'] < 10) {
  header("Location: board1.php");
} elseif ($_SESSION['position'] < 20) {
  header("Location: board2.php");
} else {
  header("Location: board3.php");
}
?>
