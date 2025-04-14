<?php
require_once '../db/database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid product ID.";
    exit;
}

$productId = intval($_GET['id']);

try {
    $stmt = $conn->prepare("DELETE FROM products WHERE id = ?");
    $stmt->execute([$productId]);

    header("Location: ../index.php?deleted=1");
    exit;
} catch (PDOException $e) {
    echo "Error deleting product: " . htmlspecialchars($e->getMessage());
    exit;
}
?>
