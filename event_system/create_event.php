<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $uid = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO events (event_name,location,event_date,event_time,created_by) VALUES (?,?,?,?,?)");
    $stmt->bind_param("ssssi",$name,$location,$date,$time,$uid);
    $stmt->execute();

    header("Location: organizer_dashboard.php");
    exit();
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Create Event</h2>

<form method="POST">
Event Name: <input name="name" required><br>
Location: <input name="location" required><br>
Date: <input type="date" name="date" required><br>
Time: <input type="time" name="time" required><br>
<button type="submit">Create</button>
</form>

<br>
<a href="organizer_dashboard.php">← Back</a>
</div>