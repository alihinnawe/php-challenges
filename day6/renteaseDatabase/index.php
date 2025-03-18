<?php
session_start();
// session_destroy(); // Uncomment if needed

include('parts/header.php');
include('db/database.php');

// Fetch categories
$categories = fetch_posts();

echo "<h1>Product Categories</h1>";

foreach ($categories as $category) {
    echo "<div>";
    echo "<label for='CategoryId'>CategoryId: </label>";
    echo "<input class='id' value='" . htmlspecialchars($category['id']) . "' name='CategoryId[]' type='text' placeholder='Category Id'>";
    echo "</div>";

    echo "<div>";
    echo "<label for='CategoryName'>Category Name: </label>";
    echo "<input class='cat' value='" . htmlspecialchars($category['name']) . "' name='CategoryName[]' type='text' placeholder='Product Category'>";
    echo "</div>";

    echo "<div>";
    echo "<label for='Description'>Description: </label>";
    echo "<input class='desc' value='" . htmlspecialchars($category['description']) . "' name='Description[]' type='text' placeholder='Category Description'>";
    echo "</div>";
}

include('parts/footer.php');
?>
