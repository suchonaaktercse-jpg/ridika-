<?php
session_start();
include "config.php";

$result = $conn->query("SELECT * FROM events");
?>


<link rel="stylesheet" href="style.css">

<div class="container">
<h2>All Events</h2>

<?php while($row=$result->fetch_assoc()){ ?>
    <p>
        <?= $row['event_name']; ?>
        <a href="register_event.php?id=<?= $row['id']; ?>">Register</a>
    </p>
<?php } ?>

<br>
<a href="participant_dashboard.php">← Back</a>
</div>