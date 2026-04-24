<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='participant'){
    header("Location: login.php");
    exit();
}
?>


<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Participant Dashboard</h2>

<div class="navbar">
    <a href="events.php">View Events</a>
    <a href="logout.php">Logout</a>
</div>

</div>