<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$id = $_GET['id'] ?? null;

if(!$id){
    header("Location: organizer_dashboard.php");
    exit();
}

$stmt = $conn->prepare("SELECT * FROM events WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$event = $result->fetch_assoc();

if(!$event){
    echo "Event not found!";
    exit();
}


if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $location = $_POST['location'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $stmt = $conn->prepare("UPDATE events 
                            SET event_name=?, location=?, event_date=?, event_time=? 
                            WHERE id=?");

    $stmt->bind_param("ssssi", $name, $location, $date, $time, $id);
    $stmt->execute();

    header("Location: organizer_dashboard.php");
    exit();
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Update Event</h2>

<form method="POST">
Event Name: <input type="text" name="name" value="<?= $event['event_name']; ?>" required><br>

Location: <input type="text" name="location" value="<?= $event['location']; ?>" required><br>

Date: <input type="date" name="date" value="<?= $event['event_date']; ?>" required><br>

Time: <input type="time" name="time" value="<?= $event['event_time']; ?>" required><br>

<button type="submit">Update Event</button>
</form>

<br>
<a href="organizer_dashboard.php">← Back</a>
</div>