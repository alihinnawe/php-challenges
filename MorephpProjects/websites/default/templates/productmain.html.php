<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title><?= htmlspecialchars($title ?? 'Products') ?></title>
  <link rel="stylesheet" href="products.css">
</head>
<body>
  <main>
<?php if (basename($_SERVER['PHP_SELF']) !== 'addproduct.php'): ?>
  <a href="addproduct.php">add a new product</a>
<?php endif; ?>
    <?= $output ?>
  </main>
	
  <footer>
    &copy; IJDB 2025
  </footer>
</body>
</html>
