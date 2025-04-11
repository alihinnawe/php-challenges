<?php
require_once 'db/database.php';
session_start();

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

// Basic validation
if (empty($email) || empty($password)) {
    $_SESSION['error_message'] = "Email and password are required.";
    header("Location: login.php");
    exit;
}

try {
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        $_SESSION['error_message'] = "No user found with that email.";
        header("Location: login.php");
        exit;
    }

    if (!password_verify($password, $user['password_hash'])) {
        $_SESSION['error_message'] = "Incorrect password.";
        header("Location: login.php");
        exit;
    }

    $_SESSION['username'] = $user['username'];
    $_SESSION['user_type'] = $user['user_type'];

    if ($user['user_type'] === 'admin') {
        header("Location: admin_view.php");
    } else {
        header("Location: index.php");
    }
    exit;

} catch (PDOException $e) {
    $_SESSION['error_message'] = "Database error: " . htmlspecialchars($e->getMessage());
    header("Location: login.php");
    exit;
}
