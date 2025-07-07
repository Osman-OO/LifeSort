<?php
session_start();

// Redirect if accessed directly without form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  header("Location: index.php");
  exit;
}

// Get current board based on player's position
$current_board = ceil($_SESSION['position'] / 10); // 1, 2, or 3

// Process choices based on the current board
switch ($current_board) {
  // --- BOARD 1: Early-Life Choices ---
  case 1:
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
    break;

  // --- BOARD 2: Mid-Life Choices ---
  case 2:
    $action = $_POST['action'];
    switch ($action) {
      case 'invest':
        $_SESSION['wealth'] += (rand(0, 1) ? 7000 : -3000; // 50% chance
        break;
      case 'marry':
        $_SESSION['wealth'] -= 2000;
        break;
      case 'job':
        $_SESSION['wealth'] += 4000;
        break;
    }
    break;

  // --- BOARD 3: Pre-Retirement Choices ---
  case 3:
    $retirement = $_POST['retirement'];
    switch ($retirement) {
      case 'early':
        $_SESSION['wealth'] *= 0.8; // 20% penalty
        break;
      case 'risk':
        $_SESSION['wealth'] *= (rand(0, 1) ? 2 : 0.5); // 50% chance
        break;
      // 'normal' does nothing
    }
    // Force retirement after choice
    header("Location: win.php");
    exit;
}

// Bankruptcy check (applies to all boards)
if ($_SESSION['wealth'] <= 0) {
  header("Location: gameover.php");
  exit;
}

// Proceed to dice roll after processing choices
header("Location: roll.php");
?>
