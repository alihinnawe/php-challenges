<?php
require_once '../db/database.php';

$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

try {
    $stmt = $conn->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        echo "Product not found.";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['product_name']); ?> - Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .product-details {
            display: flex;
            justify-content: space-around;
            margin-top: 30px;
        }

        .product-image {
            width: 400px;
            height: 400px;
            object-fit: cover;
            border-radius: 8px;
        }

        .product-description {
            max-width: 600px;
            margin-left: 20px;
        }

        a.back-link {
            display: inline-block;
            margin-bottom: 20px;
            color: #007BFF;
            text-decoration: none;
        }
    </style>
</head>
<body>

    <a href="../index.php" class="back-link">← Back to products</a>

    <!-- Product Details Section -->
    <div class="product-details">
        <img src="../static/<?php echo htmlspecialchars($product['product_image']); ?>"
             alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="product-image">

        <div class="product-description">
            <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
            <p><?php echo nl2br(htmlspecialchars($product['product_description'])); ?></p>
        </div>
    </div>

</body>
</html>
