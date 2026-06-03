<?php
include "includes/db.php";

$id = $_GET['id'];

$conn->query("DELETE FROM diary WHERE id='$id'");

header("Location: dashboard.php");
exit;

?>