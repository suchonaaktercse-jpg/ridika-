<?php
session_start();
include "config.php";

if(!isset($_SESSION['user_id']) || $_SESSION['role']!='organizer'){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM events WHERE created_by='$user_id'");
?>


<link rel="stylesheet" href="style.css">

<div class="container">
<h2>My Events</h2>

<div class="navbar">
    <a href="create_event.php">Create Event</a>
    <a href="logout.php">Logout</a>
</div>

<br>

<?php while($row = $result->fetch_assoc()){ ?>
    <p>
        <?= $row['event_name']; ?>
        <a href="edit_event.php?id=<?= $row['id']; ?>">Edit</a>
        <a href="delete_event.php?id=<?= $row['id']; ?>">Delete</a>
    </p>
<?php } ?>

</div>
