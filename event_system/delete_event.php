<?php
include "config.php";

$id = $_GET['id'];

$conn->query("DELETE FROM events WHERE id='$id'");

header("Location: organizer_dashboard.php");
exit();
?>