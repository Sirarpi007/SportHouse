<?php
$conn = new mysqli("localhost", "root", "", "sport_news");
if (isset($_GET['delete'])) {
  $id = $_GET['delete'];
  $conn->query("DELETE FROM comments WHERE id=$id");
  header("Location: admin.php");
}
$result = $conn->query("SELECT * FROM comments ORDER BY created_at DESC");?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin - Manage Comments</title>
  <style>
    body { background: #0d1b2a; color: white; font-family: sans-serif; padding: 20px; }
    table { width: 100%; border-collapse: collapse; margin-top: 20px; }
    th, td { border: 1px solid #334; padding: 10px; }
    th { background: #00b4d8; }
    a { color: #ff4d4d; text-decoration: none; }
  </style>
</head>
<body>
  <h2>🛠 Ադմին։ Մեկն․ կառավարում</h2>
  <table>
    <tr>
      <th>Վերնագիր</th><th>Անուն</th><th>Էլ․ Հասցե</th><th>Մեկն․</th><th>Ամսաթ․</th><th>Գործ․</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?= htmlspecialchars($row['article_title']) ?></td>
        <td><?= htmlspecialchars($row['name']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
        <td><?= htmlspecialchars($row['comment']) ?></td>
        <td><?= $row['created_at'] ?></td>
        <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Ջնջել մեկնաբանությունը?')">Ջնջել</a></td>
      </tr>
    <?php endwhile; ?>
  </table>
</body>
</html>
