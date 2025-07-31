<?php

$title = "Products Page";

try {
    $pdo = new PDO('mysql:host=mysql;dbname=ijdb;charset=utf8mb4', 'hinnawe', '111111');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT `name` FROM product';
    $products = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC); // ✅ Important fix

    ob_start();
    include __DIR__ . '/../templates/products.html.php';
    $output = ob_get_clean();

} catch (PDOException $e) {
    $title = 'An error has occurred';
    $output = 'Database error: ' . $e->getMessage() . ' in ' .
              $e->getFile() . ':' . $e->getLine();
}

include __DIR__ . '/../templates/productmain.html.php';
$sql = 'SELECT id, name, date FROM product';
