<?php
session_start();
include "config.php";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        if(password_verify($password,$user['password'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if($user['role']=="organizer"){
                header("Location: organizer_dashboard.php");
            } else {
                header("Location: participant_dashboard.php");
            }
            exit();
        }
    }
    echo "Invalid email or password";
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Login</h2>

<form method="POST">
Email: <input type="email" name="email"><br>
Password: <input type="password" name="password"><br>
<button type="submit">Login</button>
</form>
</div>

