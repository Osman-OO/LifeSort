<?php
session_start();

// Get final stats before destroying session
$final_wealth = $_SESSION['wealth'] ?? 0;
$final_age = $_SESSION['age'] ?? 18;
$education = $_SESSION['education'] ?? 'none';
$board_completed = $_SESSION['board'] ?? 1;

include '../includes/header.php';

// Determine success level
if ($final_wealth >= 50000) {
    $success_level = "🏆 Millionaire Lifestyle";
    $success_message = "Congratulations! You've achieved financial freedom and can retire in luxury!";
    $success_class = "win";
    $icon = "🏆";
} elseif ($final_wealth >= 25000) {
    $success_level = "🌟 Comfortable Retirement";
    $success_message = "Well done! You have enough for a comfortable retirement.";
    $success_class = "win";
    $icon = "🌟";
} elseif ($final_wealth >= 10000) {
    $success_level = "😊 Modest Success";
    $success_message = "You made it! A modest but secure retirement awaits.";
    $success_class = "win";
    $icon = "😊";
} else {
    $success_level = "😅 Barely Made It";
    $success_message = "You survived, but retirement will be tight. Every penny counts!";
    $success_class = "win";
    $icon = "😅";
}
?>

<div class="game-result <?php echo $success_class; ?> animate-slideIn">
    <div class="result-icon"><?php echo $icon; ?></div>
    <h1 class="result-title">🎉 Congratulations! 🎉</h1>
    <h2><?php echo $success_level; ?></h2>
    <p class="result-message"><?php echo $success_message; ?></p>

    <div style="background: rgba(255,255,255,0.2); border-radius: 15px; padding: 2rem; margin: 2rem 0;">
        <h3>📊 Your Life Summary</h3>
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; text-align: left;">
            <div>
                <p><strong>💰 Final Wealth:</strong> $<?php echo number_format($final_wealth); ?></p>
                <p><strong>🎂 Retirement Age:</strong> <?php echo $final_age; ?></p>
            </div>
            <div>
                <p><strong>🎓 Education:</strong> <?php echo ucfirst($education); ?></p>
                <p><strong>🎯 Boards Completed:</strong> <?php echo $board_completed; ?>/3</p>
            </div>
        </div>
    </div>

    <div style="background: rgba(255,255,255,0.2); border-radius: 15px; padding: 1.5rem; margin: 1rem 0;">
        <h3>🏆 Achievement Unlocked!</h3>
        <p>You've successfully navigated through life's challenges and reached retirement!</p>
        <?php if ($final_wealth >= 50000): ?>
            <p>🌟 <strong>Luxury Bonus:</strong> You can travel the world in style!</p>
        <?php elseif ($final_wealth >= 25000): ?>
            <p>🏠 <strong>Comfort Bonus:</strong> You own your house outright!</p>
        <?php elseif ($final_wealth >= 10000): ?>
            <p>🛡️ <strong>Security Bonus:</strong> You have a safety net for emergencies!</p>
        <?php else: ?>
            <p>💪 <strong>Survivor Bonus:</strong> You made it through all the challenges!</p>
        <?php endif; ?>
    </div>

    <div class="action-buttons">
        <a href="index.php" class="btn btn-primary">🎮 Play Again</a>
        <a href="leaderboard.php" class="btn btn-secondary">🏆 View Leaderboard</a>
    </div>
</div>

<?php
// Clear session for new game
session_destroy();
include '../includes/footer.php';
?>
