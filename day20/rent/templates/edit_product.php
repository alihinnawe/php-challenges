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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['product_name'] ?? '';
    $description = $_POST['product_description'] ?? '';
    $image = $_FILES['product_image'] ?? null;

    try {
        if ($image && $image['error'] === UPLOAD_ERR_OK) {
            $imageName = basename($image['name']);
            $targetPath = "../static/" . $imageName;
            move_uploaded_file($image['tmp_name'], $targetPath);

            $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ?, product_image = ? WHERE id = ?");
            $stmt->execute([$name, $description, $imageName, $productId]);
        } else {
            $stmt = $conn->prepare("UPDATE products SET product_name = ?, product_description = ? WHERE id = ?");
            $stmt->execute([$name, $description, $productId]);
        }

        header("Location: ../index.php?updated=1");
        exit;
    } catch (PDOException $e) {
        echo "Error updating product: " . htmlspecialchars($e->getMessage());
    }
}

$stmt = $conn->prepare("SELECT * FROM products WHERE id = ?");
$stmt->execute([$productId]);
$product = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    echo "Product not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Product</title>
</head>
<body>
<h2>Edit Product</h2>
<form method="post" enctype="multipart/form-data">
    <label>Product Name:<br>
        <input type="text" name="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>
    </label><br><br>

    <label>Description:<br>
        <textarea name="product_description" rows="5" cols="30"><?php echo htmlspecialchars($product['product_description']); ?></textarea>
    </label><br><br>

    <label>Current Image:<br>
        <img src="../static/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" width="200">
    </label><br><br>

    <label>Change Image:<br>
        <input type="file" name="product_image" accept="image/*">
    </label><br><br>

    <button type="submit">Update</button>
</form>

<p><a href="../index.php">Back to products</a></p>
</body>
</html>
