<?php
session_start();
include("db/database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"] ?? '';
    $email = $_POST["email"] ?? '';
    $password = $_POST["password"] ?? '';
    $full_name = $_POST["full_name"] ?? '';
    $phone_number = $_POST["phone_number"] ?? '';
    $address = $_POST["address"] ?? '';
    $user_type = $_POST["user_type"] ?? 'user'; // default to 'user'
    $profile_picture_url = $_POST["profile_picture_url"] ?? 'default.jpg';

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash, full_name, phone_number, address, user_type, profile_picture_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $username, $email, $password_hash, $full_name, $phone_number, $address, $user_type, $profile_picture_url);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login now</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
    exit();
}
?>

<h2>User Registration</h2>
<form method="POST" action="register.php">
    <label>Username: <input type="text" name="username" required></label><br>
    <label>Email: <input type="email" name="email" required></label><br>
    <label>Password: <input type="password" name="password" required></label><br>
    <label>Full Name: <input type="text" name="full_name" required></label><br>
    <label>Phone Number: <input type="text" name="phone_number"></label><br>
    <label>Address: <input type="text" name="address"></label><br>
    <label>User Type:
        <select name="user_type">
            <option value="user" selected>User</option>
            <option value="admin">Admin</option>
        </select>
    </label><br>
    <label>Profile Picture URL: <input type="text" name="profile_picture_url" value="default.jpg"></label><br>
    <button type="submit">Register</button>
</form>
