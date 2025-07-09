<?php
session_start();
include '../includes/header.php';
?>

<div class="board-container animate-slideIn">
    <div class="board-header">
        <h1 class="board-title">💼 Mid-Life Board (Ages 30-50)</h1>
        <div class="player-stats">
            <div class="stat-item">💰 Wealth: $<?php echo number_format($_SESSION['wealth']); ?></div>
            <div class="stat-item">🎂 Age: <?php echo $_SESSION['age']; ?></div>
            <div class="stat-item">📍 Position: <?php echo $_SESSION['position']; ?>/20</div>
        </div>

        <?php if (isset($_SESSION['last_choice'])): ?>
            <div style="background: #e6fffa; border: 2px solid #38b2ac; border-radius: 10px; padding: 1rem; margin: 1rem 0; text-align: center;">
                <strong>Last Action:</strong> <?php echo $_SESSION['last_choice']; unset($_SESSION['last_choice']); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_SESSION['last_event'])): ?>
            <div style="background: #fff5f5; border: 2px solid #fc8181; border-radius: 10px; padding: 1rem; margin: 1rem 0; text-align: center;">
                <strong>Dice Event:</strong> <?php echo $_SESSION['last_event']; unset($_SESSION['last_event']); ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Game Board Path -->
    <div class="game-board">
        <h3 style="text-align: center; margin-bottom: 1rem;">🎯 Career Path</h3>
        <div class="board-path">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="board-space <?php echo ($_SESSION['position'] == $i) ? 'current-position' : ''; ?>">
                    <div class="space-number"><?php echo $i; ?></div>
                    <div class="space-event">
                        <?php
                        $events = [
                            1 => "💼 Career", 2 => "📊 Meeting", 3 => "💰 Raise", 4 => "🏠 House", 5 => "👶 Family",
                            6 => "🚗 Upgrade", 7 => "📈 Invest", 8 => "🎯 Goals", 9 => "💼 Promotion", 10 => "🌟 Success",
                            11 => "💰 Bonus", 12 => "🏖️ Vacation", 13 => "📚 Skills", 14 => "🤝 Network", 15 => "💡 Ideas",
                            16 => "🏆 Award", 17 => "💼 Leadership", 18 => "📈 Growth", 19 => "🎯 Peak", 20 => "🚀 Mastery"
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
        <h3>🎲 Roll the Dice to Advance Your Career!</h3>
        <div class="dice-display" id="diceDisplay">🎲</div>
        <?php if (isset($_SESSION['last_roll'])): ?>
            <div class="dice-result">You rolled: <?php echo $_SESSION['last_roll']; ?>!</div>
        <?php endif; ?>
        <form method="post" action="roll.php" style="display: inline;">
            <input type="hidden" name="board" value="2">
            <button type="submit" class="btn btn-roll">🎲 Roll Dice</button>
        </form>
    </div>

    <!-- Life Events -->
    <div class="life-events">
        <h3>💼 Mid-Life Decisions - Shape Your Future!</h3>
        <form method="post" action="process_choice.php" class="event-options">
            <input type="hidden" name="board" value="2">

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="invest" required>
                    📈 Invest in Stocks (50% chance: +$7,000 or -$3,000)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="marry">
                    💒 Get Married (-$2,000 for wedding costs)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="job">
                    💼 Change Jobs (+$4,000 + education bonus)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="lottery">
                    🎰 Play Lottery (10% chance: +$10,000)
                </label>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-submit">✅ Make Decision</button>
            </div>
        </form>
    </div>

    <!-- Navigation -->
    <div class="action-buttons">
        <a href="board1.php" class="btn btn-secondary">⬅️ Back to Early Life</a>
        <a href="index.php" class="btn btn-secondary">🏠 Main Menu</a>
        <?php if ($_SESSION['position'] >= 20): ?>
            <a href="board3.php" class="btn btn-primary">➡️ Next: Pre-Retirement</a>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
