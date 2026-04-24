<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$event_id = $_GET['id'];

$stmt = $conn->prepare("INSERT INTO registrations (user_id,event_id) VALUES (?,?)");
$stmt->bind_param("ii",$user_id,$event_id);
$stmt->execute();

echo "Registered Successfully!";
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Success</h2>

<p>Registered Successfully!</p>

<br>
<a href="events.php">← Back to Events</a>
</div>