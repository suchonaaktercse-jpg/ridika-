<?php
session_start();
include "config.php";

$message = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

   
    $check = $conn->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s",$email);
    $check->execute();
    $result = $check->get_result();

    if($result->num_rows > 0){
        $message = "Email already exists!";
    } else {

        $stmt = $conn->prepare("INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)");
        $stmt->bind_param("ssss",$name,$email,$password,$role);

        if($stmt->execute()){
            header("Location: login.php");
            exit();
        } else {
            $message = "Registration failed!";
        }
    }
}
?>

<link rel="stylesheet" href="style.css">

<div class="container">
<h2>Register</h2>

<form method="POST">
Name: <input type="text" name="name" required><br>
Email: <input type="email" name="email" required><br>
Password: <input type="password" name="password" required><br>

<select name="role">
    <option value="organizer">Organizer</option>
    <option value="participant">Participant</option>
</select><br>

<button type="submit">Register</button>
</form>

<p class="message"><?php echo $message; ?></p>
</div>