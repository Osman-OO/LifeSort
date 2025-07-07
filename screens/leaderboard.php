<?php include 'includes/db.php'; ?>
<?php include 'includes/header.php'; ?>

<div class="leaderboard">
  <h2>Top Players</h2>
  <table>
    <tr><th>Name</th><th>Age</th><th>Wealth</th></tr>
    <?php foreach (get_leaderboard() as $score): ?>
      <tr>
        <td><?php echo $score[0]; ?></td>
        <td><?php echo $score[1]; ?></td>
        <td>$<?php echo $score[2]; ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
  <a href="index.php" class="btn">Back to Menu</a>
</div>

<?php include 'includes/footer.php'; ?>
