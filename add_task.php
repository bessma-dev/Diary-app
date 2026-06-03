<?php
session_start();
include "includes/db.php";

$user_id = $_SESSION['user_id'];
$task = $_POST['task'];

$conn->query("INSERT INTO todoliste (user_id, task)
VALUES ('$user_id', '$task')");

header("Location: dashboard.php");
?>