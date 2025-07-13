<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Redirect if accessed directly without form submission
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$board = $_POST['board'] ?? 1;
$space = $_POST['space'] ?? 1;

// Define space events for each board
$board_events = [
    1 => [ // Early Life Board
        1 => ['wealth' => 0, 'message' => '🏠 Starting your journey!'],
        2 => ['wealth' => 500, 'message' => '📚 Studied hard! +$500'],
        3 => ['wealth' => 1000, 'message' => '💼 Part-time job! +$1,000'],
        4 => ['wealth' => -500, 'message' => '🎉 Party expenses! -$500'],
        5 => ['wealth' => 800, 'message' => '💰 Saved money! +$800'],
        6 => ['wealth' => -1200, 'message' => '🚗 Bought first car! -$1,200'],
        7 => ['wealth' => -2000, 'message' => '🏠 Moved to apartment! -$2,000'],
        8 => ['wealth' => -800, 'message' => '📱 New technology! -$800'],
        9 => ['wealth' => 2000, 'message' => '🎓 Graduated! +$2,000 bonus'],
        10 => ['wealth' => -1000, 'message' => '💕 Dating expenses! -$1,000'],
        11 => ['wealth' => -1500, 'message' => '🌍 Travel adventure! -$1,500'],
        12 => ['wealth' => 3000, 'message' => '💼 Great job offer! +$3,000'],
        13 => ['wealth' => -300, 'message' => '🏋️ Gym membership! -$300'],
        14 => ['wealth' => 600, 'message' => '🎨 Side hobby income! +$600'],
        15 => ['wealth' => 1500, 'message' => '💰 Performance bonus! +$1,500'],
        16 => ['wealth' => -1800, 'message' => '🏠 Moving costs! -$1,800'],
        17 => ['wealth' => 2200, 'message' => '📈 Smart investment! +$2,200'],
        18 => ['wealth' => 1000, 'message' => '🎯 Achieved goal! +$1,000'],
        19 => ['wealth' => 2500, 'message' => '🚀 Career launch! +$2,500'],
        20 => ['wealth' => 3000, 'message' => '🎊 Early life success! +$3,000']
    ],
    2 => [ // Mid-Life Board
        1 => ['wealth' => 3000, 'message' => '💼 New career boost! +$3,000'],
        2 => ['wealth' => 1000, 'message' => '📊 Successful meeting! +$1,000'],
        3 => ['wealth' => 2500, 'message' => '💰 Salary raise! +$2,500'],
        4 => ['wealth' => -8000, 'message' => '🏠 Bought house! -$8,000 (investment)'],
        5 => ['wealth' => -3000, 'message' => '👶 Started family! -$3,000'],
        6 => ['wealth' => -1500, 'message' => '🚗 Car upgrade! -$1,500'],
        7 => ['wealth' => 'random', 'message' => '📈 Investment gamble!'],
        8 => ['wealth' => 1000, 'message' => '🎯 Career goals met! +$1,000'],
        9 => ['wealth' => 4000, 'message' => '💼 Big promotion! +$4,000'],
        10 => ['wealth' => 3500, 'message' => '🌟 Success bonus! +$3,500'],
        11 => ['wealth' => 2000, 'message' => '💰 Year-end bonus! +$2,000'],
        12 => ['wealth' => -1000, 'message' => '🏖️ Well-deserved vacation! -$1,000'],
        13 => ['wealth' => 1500, 'message' => '📚 Skills training! +$1,500'],
        14 => ['wealth' => 2000, 'message' => '🤝 Networking success! +$2,000'],
        15 => ['wealth' => 3000, 'message' => '💡 Great business idea! +$3,000'],
        16 => ['wealth' => 2500, 'message' => '🏆 Industry award! +$2,500'],
        17 => ['wealth' => 5000, 'message' => '💼 Leadership role! +$5,000'],
        18 => ['wealth' => 4000, 'message' => '📈 Business growth! +$4,000'],
        19 => ['wealth' => 6000, 'message' => '🎯 Peak performance! +$6,000'],
        20 => ['wealth' => 7500, 'message' => '🚀 Career mastery! +$7,500']
    ],
    3 => [ // Pre-Retirement Board
        1 => ['wealth' => 2000, 'message' => '🏖️ Retirement planning! +$2,000'],
        2 => ['wealth' => 5000, 'message' => '💰 Savings milestone! +$5,000'],
        3 => ['wealth' => 3000, 'message' => '📊 Portfolio review! +$3,000'],
        4 => ['wealth' => 1000, 'message' => '🏠 Downsized home! +$1,000'],
        5 => ['wealth' => 4000, 'message' => '👨‍👩‍👧‍👦 Legacy planning! +$4,000'],
        6 => ['wealth' => 'random', 'message' => '📈 Final investment!'],
        7 => ['wealth' => 2500, 'message' => '🎯 Financial goals! +$2,500'],
        8 => ['wealth' => 3500, 'message' => '💡 Wisdom pays off! +$3,500'],
        9 => ['wealth' => 4500, 'message' => '🤝 Mentoring income! +$4,500'],
        10 => ['wealth' => 6000, 'message' => '🌟 Peak earnings! +$6,000'],
        11 => ['wealth' => 5500, 'message' => '💰 Wealth accumulation! +$5,500'],
        12 => ['wealth' => 7000, 'message' => '🏆 Lifetime achievement! +$7,000'],
        13 => ['wealth' => 3000, 'message' => '📚 Knowledge sharing! +$3,000'],
        14 => ['wealth' => 2000, 'message' => '🎨 Retirement hobbies! +$2,000'],
        15 => ['wealth' => -2000, 'message' => '🌍 Dream vacation! -$2,000'],
        16 => ['wealth' => 4000, 'message' => '👴 Elder wisdom! +$4,000'],
        17 => ['wealth' => 5000, 'message' => '🎯 Final push! +$5,000'],
        18 => ['wealth' => 6000, 'message' => '🏖️ Almost ready! +$6,000'],
        19 => ['wealth' => 8000, 'message' => '🎊 So close! +$8,000'],
        20 => ['wealth' => 10000, 'message' => '🏁 Retirement ready! +$10,000']
    ]
];

// Get the event for current board and space
$event = $board_events[$board][$space] ?? ['wealth' => 0, 'message' => 'Nothing happened'];

// Apply the event
if ($event['wealth'] === 'random') {
    // Special random events
    if ($board == 2 && $space == 7) { // Investment
        $success = rand(0, 1);
        if ($success) {
            $_SESSION['wealth'] += 5000;
            $_SESSION['last_choice'] = '📈 Investment succeeded! +$5,000';
        } else {
            $_SESSION['wealth'] -= 2000;
            $_SESSION['last_choice'] = '📉 Investment failed! -$2,000';
        }
    } elseif ($board == 3 && $space == 6) { // Final investment
        $success = rand(1, 3) == 1; // 33% chance
        if ($success) {
            $_SESSION['wealth'] = (int)($_SESSION['wealth'] * 1.5);
            $_SESSION['last_choice'] = '🚀 Final investment paid off! +50% wealth';
        } else {
            $_SESSION['wealth'] -= 3000;
            $_SESSION['last_choice'] = '💥 Final investment failed! -$3,000';
        }
    }
} else {
    $_SESSION['wealth'] += $event['wealth'];
    $_SESSION['last_choice'] = $event['message'];
}

// Check for bankruptcy
if ($_SESSION['wealth'] <= 0) {
    header('Location: gameover.php');
    exit;
}

// Return to current board
header("Location: board{$board}.php");
exit;
?>
