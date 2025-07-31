<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['name'])) {
    try {
        $pdo = new PDO('mysql:host=mysql;dbname=ijdb;charset=utf8mb4', 'hinnawe', '111111');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Log the name value (for testing)
        file_put_contents('debug.log', "POST name: " . $_POST['name'] . PHP_EOL, FILE_APPEND);

        $sql = 'INSERT INTO product SET `name` = :name, `date` = CURDATE()';
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':name', $_POST['name'], PDO::PARAM_STR);
        $stmt->execute();

        // Redirect
        header('Location: products.php');
        exit;

    } catch (PDOException $e) {
        die('Database error: ' . $e->getMessage());
    }
} else {
    $title = 'Add a new product';
    ob_start();
    include __DIR__ . '/../templates/addproduct.html.php';
    $output = ob_get_clean();
}

include __DIR__ . '/../templates/productmain.html.php';
