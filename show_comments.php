<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "sport_news");
$title = $_GET['title'] ?? '';
$result = $conn->query("SELECT * FROM comments WHERE article_title='$title' ORDER BY created_at DESC");
$comments = [];
while ($row = $result->fetch_assoc()) {
    $comments[] = $row;}
echo json_encode($comments);?>
