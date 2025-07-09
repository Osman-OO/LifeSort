<?php
session_start();

// Initialize game if not started
if (!isset($_SESSION['wealth'])) {
    $_SESSION['wealth'] = rand(5000, 15000);
    $_SESSION['age'] = 18;
    $_SESSION['position'] = 1;
    $_SESSION['board'] = 1;
    $_SESSION['career_boost'] = 0;
    $_SESSION['experience'] = 0;
    $_SESSION['education'] = 'none';
}

include '../includes/header.php';
?>

<div class="board-container animate-slideIn">
    <div class="board-header">
        <h1 class="board-title">🌱 Early Life Board (Ages 18-30)</h1>
        <div class="player-stats">
            <div class="stat-item">💰 Wealth: $<?php echo number_format($_SESSION['wealth']); ?></div>
            <div class="stat-item">🎂 Age: <?php echo $_SESSION['age']; ?></div>
            <div class="stat-item">📍 Position: <?php echo $_SESSION['position']; ?>/20</div>
        </div>
    </div>

    <!-- Game Board Path -->
    <div class="game-board">
        <h3 style="text-align: center; margin-bottom: 1rem;">🎯 Life Path</h3>
        <div class="board-path">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="board-space <?php echo ($_SESSION['position'] == $i) ? 'current-position' : ''; ?>">
                    <div class="space-number"><?php echo $i; ?></div>
                    <div class="space-event">
                        <?php
                        $events = [
                            1 => "🏠 Start", 2 => "📚 Study", 3 => "💼 Job Fair", 4 => "🎉 Party", 5 => "💰 Savings",
                            6 => "🚗 Car", 7 => "🏠 Apartment", 8 => "📱 Tech", 9 => "🎓 Degree", 10 => "💕 Love",
                            11 => "🌍 Travel", 12 => "💼 Career", 13 => "🏋️ Gym", 14 => "🎨 Hobby", 15 => "💰 Bonus",
                            16 => "🏠 Move", 17 => "📈 Invest", 18 => "🎯 Goal", 19 => "🚀 Launch", 20 => "🎊 Success"
                        ];
                        echo $events[$i];
                        ?>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Dice Rolling Section -->
    <div class="dice-section">
        <h3>🎲 Roll the Dice to Move Forward!</h3>
        <div class="dice-display" id="diceDisplay">🎲</div>
        <form method="post" action="roll.php" style="display: inline;">
            <input type="hidden" name="board" value="1">
            <button type="submit" class="btn btn-roll">🎲 Roll Dice</button>
        </form>
    </div>

    <!-- Life Events -->
    <div class="life-events">
        <h3>🌟 Life Choices - Choose Your Path!</h3>
        <form method="post" action="process_choice.php" class="event-options">
            <input type="hidden" name="board" value="1">

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="college" required>
                    🎓 Go to College (-$5,000, +Career Boost for future earnings)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="job">
                    💼 Get Entry-Level Job (+$3,000 immediate income)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="travel">
                    🌍 Travel the World (-$2,000, +Life Experience)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="save">
                    🏦 Live Frugally & Save (+$1,000, safe choice)
                </label>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-submit">✅ Make Choice</button>
            </div>
        </form>
    </div>

    <!-- Navigation -->
    <div class="action-buttons">
        <a href="index.php" class="btn btn-secondary">🏠 Back to Menu</a>
        <?php if ($_SESSION['position'] >= 20): ?>
            <a href="board2.php" class="btn btn-primary">➡️ Next: Mid-Life Board</a>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
