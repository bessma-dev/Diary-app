<?php
session_start();
include "includes/db.php";

$user_id = $_SESSION['user_id'];
$title = $_POST['title'];
$content = $_POST['content'];

$stmt = $conn->prepare("INSERT INTO diary (user_id, title, content) VALUES (?, ?, ?)");
$stmt->bind_param("iss", $user_id, $title, $content);

$stmt->execute();

header("Location: dashboard.php");
exit;
?>