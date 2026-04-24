<?php
session_start();
include "config.php";

$id = $_GET['id'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];

    $conn->query("UPDATE events SET event_name='$name' WHERE id='$id'");

    header("Location: organizer_dashboard.php");
    exit();
}

$result = $conn->query("SELECT * FROM events WHERE id='$id'");
$row = $result->fetch_assoc();
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Edit Event</h2>

<form method="POST">
Event Name: <input name="name" value="<?= $row['event_name']; ?>"><br>
<button type="submit">Update</button>
</form>

<br>
<a href="organizer_dashboard.php">← Back</a>
</div>