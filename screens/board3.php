<?php
session_start();
include '../includes/header.php';
?>

<div class="board-container animate-slideIn">
    <div class="board-header">
        <h1 class="board-title">🏖️ Pre-Retirement Board (Ages 50-65)</h1>
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
        <h3 style="text-align: center; margin-bottom: 1rem;">🎯 Road to Retirement</h3>
        <div class="board-path">
            <?php for ($i = 1; $i <= 20; $i++): ?>
                <div class="board-space <?php echo ($_SESSION['position'] == $i) ? 'current-position' : ''; ?>">
                    <div class="space-number"><?php echo $i; ?></div>
                    <div class="space-event">
                        <?php
                        $events = [
                            1 => "🏖️ Planning", 2 => "💰 Savings", 3 => "📊 Portfolio", 4 => "🏠 Downsize", 5 => "👨‍👩‍👧‍👦 Legacy",
                            6 => "📈 Invest", 7 => "🎯 Goals", 8 => "💡 Wisdom", 9 => "🤝 Mentor", 10 => "🌟 Peak",
                            11 => "💰 Wealth", 12 => "🏆 Success", 13 => "📚 Knowledge", 14 => "🎨 Hobbies", 15 => "🌍 Travel",
                            16 => "👴 Elder", 17 => "🎯 Final", 18 => "🏖️ Ready", 19 => "🎊 Almost", 20 => "🏁 Finish"
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
        <h3>🎲 Final Steps to Retirement!</h3>
        <div class="dice-display" id="diceDisplay">🎲</div>
        <?php if (isset($_SESSION['last_roll'])): ?>
            <div class="dice-result">You rolled: <?php echo $_SESSION['last_roll']; ?>!</div>
        <?php endif; ?>
        <form method="post" action="roll.php" style="display: inline;">
            <input type="hidden" name="board" value="3">
            <button type="submit" class="btn btn-roll">🎲 Roll Dice</button>
        </form>
    </div>

    <!-- Life Events -->
    <div class="life-events">
        <h3>🏖️ Retirement Decisions - Your Final Choices!</h3>
        <form method="post" action="process_choice.php" class="event-options">
            <input type="hidden" name="board" value="3">

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="retire_early" required>
                    🏖️ Retire Early (20% wealth penalty, but you're done!)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="big_investment">
                    🚀 One Big Investment (30% chance: double wealth or lose 70%)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="safe_retirement">
                    🛡️ Safe Retirement Plan (+$5,000, secure choice)
                </label>
            </div>

            <div class="event-option">
                <label>
                    <input type="radio" name="action" value="work_longer">
                    💪 Work a Few More Years (+$8,000, delayed retirement)
                </label>
            </div>

            <div class="action-buttons">
                <button type="submit" class="btn btn-submit">✅ Make Final Decision</button>
            </div>
        </form>
    </div>

    <!-- Navigation -->
    <div class="action-buttons">
        <a href="board2.php" class="btn btn-secondary">⬅️ Back to Mid-Life</a>
        <a href="index.php" class="btn btn-secondary">🏠 Main Menu</a>
        <?php if ($_SESSION['position'] >= 20): ?>
            <a href="win.php" class="btn btn-primary">🏆 Retire & See Results!</a>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
