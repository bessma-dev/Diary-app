<?php
include "includes/db.php";

$id = $_GET['id'];

$conn->query("DELETE FROM todoliste WHERE id='$id'");

header("Location: dashboard.php");
exit;
?>