<?php
require_once 'db/database.php';
session_start();

if (!isset($_SESSION['username']) || $_SESSION['user_type'] !== 'admin') {
    header('Location: index.php');
    exit;
}

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
    <title>Admin Product View</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="top-right">
    <a href="logout.php">Logout</a>
</div>

<h2>Admin View – Product List</h2>

<div class="product-grid">
    <?php foreach ($products as $product): ?>
        <div class="product-card">
            <img src="static/<?php echo htmlspecialchars($product['product_image']); ?>"
                 alt="<?php echo htmlspecialchars($product['product_name']); ?>">
            <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
            <p><?php echo htmlspecialchars($product['product_description']); ?></p>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
