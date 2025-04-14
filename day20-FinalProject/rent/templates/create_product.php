<?php
require_once '../db/database.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_name'] ?? '';
    $description = $_POST['product_description'] ?? '';
    $image = $_FILES['product_image'] ?? null;

    if ($image && $image['error'] === UPLOAD_ERR_OK) {
        $imageName = basename($image['name']);
        $targetPath = "../static/" . $imageName;
        move_uploaded_file($image['tmp_name'], $targetPath);
    } else {
        $imageName = 'default.png'; // fallback
    }

    try {
        $stmt = $conn->prepare("INSERT INTO products (product_name, product_description, product_image) VALUES (?, ?, ?)");
        $stmt->execute([$name, $description, $imageName]);
        header('Location: ../index.php?created=1');
        exit;
    } catch (PDOException $e) {
        echo "Error: " . htmlspecialchars($e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Product</title>
</head>
<body>
<h2>Create New Product</h2>
<form method="post" enctype="multipart/form-data">
    <label>Product Name:<br>
        <input type="text" name="product_name" required>
    </label><br><br>

    <label>Description:<br>
        <textarea name="product_description" rows="5" cols="30"></textarea>
    </label><br><br>

    <label>Image:<br>
        <input type="file" name="product_image" accept="image/*">
    </label><br><br>

    <button type="submit">Create</button>
</form>

<p><a href="../index.php">Back to Product List</a></p>
</body>
</html>
