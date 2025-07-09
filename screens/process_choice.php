<?php
session_start();

// Redirect if accessed directly without form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

// Get current board
$current_board = $_SESSION['board'] ?? 1;

// Process choices based on the current board
switch ($current_board) {
    // --- BOARD 1: Early-Life Choices ---
    case 1:
        $action = $_POST['action'];
        switch ($action) {
            case 'college':
                $_SESSION['wealth'] -= 5000;
                $_SESSION['career_boost'] += 2000; // Future earning boost
                $_SESSION['education'] = 'college';
                $_SESSION['last_choice'] = '🎓 Went to college! Future earnings boosted.';
                break;
            case 'job':
                $_SESSION['wealth'] += 3000;
                $_SESSION['last_choice'] = '💼 Got an entry-level job! Immediate income.';
                break;
            case 'travel':
                $_SESSION['wealth'] -= 2000;
                $_SESSION['experience'] += 1;
                $_SESSION['last_choice'] = '🌍 Traveled the world! Gained life experience.';
                break;
            case 'save':
                $_SESSION['wealth'] += 1000;
                $_SESSION['last_choice'] = '🏦 Lived frugally and saved money!';
                break;
        }
        break;

    // --- BOARD 2: Mid-Life Choices ---
    case 2:
        $action = $_POST['action'];
        switch ($action) {
            case 'invest':
                $success = rand(0, 1); // 50% chance
                if ($success) {
                    $_SESSION['wealth'] += 7000;
                    $_SESSION['last_choice'] = '📈 Investment succeeded! +$7,000';
                } else {
                    $_SESSION['wealth'] -= 3000;
                    $_SESSION['last_choice'] = '📉 Investment failed! -$3,000';
                }
                break;
            case 'marry':
                $_SESSION['wealth'] -= 2000;
                $_SESSION['last_choice'] = '💒 Got married! Wedding costs -$2,000';
                break;
            case 'job':
                $bonus = $_SESSION['career_boost'] ?? 0;
                $_SESSION['wealth'] += 4000 + $bonus;
                $_SESSION['last_choice'] = '💼 Changed jobs! +$' . number_format(4000 + $bonus);
                break;
            case 'lottery':
                $win = rand(1, 10) <= 1; // 10% chance
                if ($win) {
                    $_SESSION['wealth'] += 10000;
                    $_SESSION['last_choice'] = '🎰 Won the lottery! +$10,000';
                } else {
                    $_SESSION['last_choice'] = '🎰 Lottery ticket was a dud!';
                }
                break;
        }
        break;

    // --- BOARD 3: Pre-Retirement Choices ---
    case 3:
        $action = $_POST['action'];
        switch ($action) {
            case 'retire_early':
                $_SESSION['wealth'] = (int)($_SESSION['wealth'] * 0.8); // 20% penalty
                $_SESSION['last_choice'] = '🏖️ Retired early! 20% wealth penalty';
                header("Location: win.php");
                exit;
            case 'big_investment':
                $success = rand(1, 10) <= 3; // 30% chance
                if ($success) {
                    $_SESSION['wealth'] = (int)($_SESSION['wealth'] * 2);
                    $_SESSION['last_choice'] = '🚀 Big investment paid off! Doubled wealth!';
                } else {
                    $_SESSION['wealth'] = (int)($_SESSION['wealth'] * 0.3);
                    $_SESSION['last_choice'] = '💥 Big investment failed! Lost 70% of wealth';
                }
                break;
            case 'safe_retirement':
                $_SESSION['wealth'] += 5000;
                $_SESSION['last_choice'] = '🛡️ Safe retirement plan! +$5,000';
                break;
            case 'work_longer':
                $_SESSION['wealth'] += 8000;
                $_SESSION['last_choice'] = '💪 Worked longer! +$8,000';
                break;
        }
        break;
}

// Bankruptcy check (applies to all boards)
if ($_SESSION['wealth'] <= 0) {
    header("Location: gameover.php");
    exit;
}

// Return to current board
header("Location: board{$current_board}.php");
exit;
?>
