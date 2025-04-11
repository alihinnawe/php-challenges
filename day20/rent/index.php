<?php
include('check_login.php');
require_once 'db/database.php';

try {
    $sql = "SELECT id, product_name, product_description, product_image FROM products";
    $statement = $conn->query($sql);
    $products = $statement->fetchAll(PDO::FETCH_ASSOC);

    if (!$products) {
        echo "No products found.";
        exit;
    }
} catch (PDOException $e) {
    echo "Database error: " . htmlspecialchars($e->getMessage());
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="top-right">
    <a href="logout.php">Logout</a>
</div>

<h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="static/<?php echo htmlspecialchars($product['product_image']); ?>"
                 alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
            <p><?php echo htmlspecialchars($product['product_description']); ?></p>
            <div class="buttons">
                <button class="edit-btn" onclick="editProduct(<?php echo $product['id']; ?>)">Edit</button>
                <button class="delete-btn" onclick="deleteProduct(<?php echo $product['id']; ?>)">Delete</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<button class="create-btn" onclick="window.location.href='templates/create_product.php'">+</button>

<script>
    function editProduct(id) {
        window.location.href = `templates/edit_product.php?id=${id}`;
    }

    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = `templates/delete_product.php?id=${id}`;
        }
    }
</script>

</body>
</html>
