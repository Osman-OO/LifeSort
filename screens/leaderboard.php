<?php
session_start();
include '../includes/header.php';
?>

<div class="leaderboard animate-slideIn">
    <h1 style="text-align: center; color: #2d3748; margin-bottom: 2rem;">🏆 LifeRoll Leaderboard 🏆</h1>

    <div style="text-align: center; margin-bottom: 2rem;">
        <p>See how you stack up against other players who've completed their life journey!</p>
    </div>

    <div id="leaderboard-content">
        <div style="text-align: center; padding: 2rem;">
            <p>🎮 Play the game to see your scores here!</p>
            <p>Scores are saved locally in your browser.</p>
        </div>
    </div>

    <div style="text-align: center; margin-top: 2rem;">
        <a href="index.php" class="btn btn-primary">🎮 Play Game</a>
        <button onclick="clearLeaderboard()" class="btn btn-secondary">🗑️ Clear Scores</button>
    </div>
</div>

<script>
function loadLeaderboard() {
    if (typeof(Storage) !== "undefined") {
        let leaderboard = JSON.parse(localStorage.getItem('liferoll_leaderboard') || '[]');
        let content = document.getElementById('leaderboard-content');

        if (leaderboard.length === 0) {
            content.innerHTML = `
                <div style="text-align: center; padding: 2rem;">
                    <p>🎮 No scores yet! Play the game to see your results here!</p>
                </div>
            `;
            return;
        }

        let tableHTML = `
            <table class="leaderboard-table">
                <thead>
                    <tr>
                        <th>🏆 Rank</th>
                        <th>💰 Wealth</th>
                        <th>🎂 Age</th>
                        <th>🎓 Education</th>
                        <th>📅 Date</th>
                    </tr>
                </thead>
                <tbody>
        `;

        leaderboard.forEach((score, index) => {
            let rankIcon = '';
            if (index === 0) rankIcon = '🥇';
            else if (index === 1) rankIcon = '🥈';
            else if (index === 2) rankIcon = '🥉';
            else rankIcon = `${index + 1}.`;

            tableHTML += `
                <tr>
                    <td>${rankIcon}</td>
                    <td>$${score.wealth.toLocaleString()}</td>
                    <td>${score.age}</td>
                    <td>${score.education.charAt(0).toUpperCase() + score.education.slice(1)}</td>
                    <td>${score.date}</td>
                </tr>
            `;
        });

        tableHTML += `
                </tbody>
            </table>
        `;

        content.innerHTML = tableHTML;
    } else {
        document.getElementById('leaderboard-content').innerHTML = `
            <div style="text-align: center; padding: 2rem;">
                <p>❌ Local storage not supported. Scores cannot be saved.</p>
            </div>
        `;
    }
}

function clearLeaderboard() {
    if (confirm('Are you sure you want to clear all scores?')) {
        localStorage.removeItem('liferoll_leaderboard');
        loadLeaderboard();
    }
}

// Load leaderboard when page loads
document.addEventListener('DOMContentLoaded', loadLeaderboard);
</script>

<?php include '../includes/footer.php'; ?>
