<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=rentease', 'rentease', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    echo "Database connected successfully."; // Debug message
} catch (PDOException $e) {
    die('Database connection failed: ' . $e->getMessage());
}
?>
