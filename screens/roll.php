<?php
session_start();

// Roll dice (1-6)
$roll = rand(1, 6);
$_SESSION['last_roll'] = $roll;

// Move player
$_SESSION['position'] += $roll;
$_SESSION['age'] += 1; // Age 1 year per move

// Random events based on dice roll
$random_events = [
    1 => ['message' => '😔 Bad luck! Lost $500', 'wealth' => -500],
    2 => ['message' => '💰 Found money! +$300', 'wealth' => 300],
    3 => ['message' => '🎯 Normal move', 'wealth' => 0],
    4 => ['message' => '🎯 Normal move', 'wealth' => 0],
    5 => ['message' => '🎉 Lucky day! +$200', 'wealth' => 200],
    6 => ['message' => '🚀 Excellent! +$500', 'wealth' => 500]
];

$event = $random_events[$roll];
$_SESSION['wealth'] += $event['wealth'];
$_SESSION['last_event'] = $event['message'];

// Check for game over (bankruptcy)
if ($_SESSION['wealth'] <= 0) {
    header('Location: gameover.php');
    exit;
}

// Check if completed board
$current_board = $_SESSION['board'] ?? 1;
if ($_SESSION['position'] >= 20) {
    if ($current_board == 1) {
        $_SESSION['board'] = 2;
        $_SESSION['position'] = 1;
        header('Location: board2.php');
        exit;
    } elseif ($current_board == 2) {
        $_SESSION['board'] = 3;
        $_SESSION['position'] = 1;
        header('Location: board3.php');
        exit;
    } elseif ($current_board == 3) {
        header('Location: win.php');
        exit;
    }
}

// Return to current board
header("Location: board{$current_board}.php");
exit;
?>
