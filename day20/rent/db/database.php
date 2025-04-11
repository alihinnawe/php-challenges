<?php
global $conn;

try {
    $conn = new PDO(
        "mysql:host=localhost;dbname=rentease;charset=utf8",
        "rentease", 
        "rentease2"
    );
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    echo "Connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}
?>