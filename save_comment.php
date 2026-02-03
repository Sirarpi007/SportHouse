<?php
$conn = new mysqli("localhost", "root", "", "sport_news");
$title = $_POST['title'] ?? '';
$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$comment = $_POST['comment'] ?? '';
if ($title && $name && $email && $comment) {
    $stmt = $conn->prepare("INSERT INTO comments (article_title, name, email, comment, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $title, $name, $email, $comment);
    $stmt->execute();
    echo "✅ Մեկնաբանությունը հաստատվեց!";
} else {
    echo "⚠️ Խնդրում ենք լրացնել բոլոր դաշտերը";}
?>
 