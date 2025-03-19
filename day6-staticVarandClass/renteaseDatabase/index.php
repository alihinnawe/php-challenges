<?php
session_start();
// session_destroy(); // Uncomment if needed

include('parts/header.php');
include('db/database.php');

// Fetch categories (displaying existing ones)
$categories = fetch_posts();

echo "<h1>Product Categories</h1>";

// Display the existing categories
foreach ($categories as $category) {
    echo "<div>";
    echo "<label for='CategoryId'>CategoryId: </label>";
    echo "<input class='id' value='" . htmlspecialchars($category['id']) . "' name='CategoryId[]' type='text' placeholder='Category Id' readonly>";
    echo "</div>";

    echo "<div>";
    echo "<label for='CategoryName'>Category Name: </label>";
    echo "<input class='cat' value='" . htmlspecialchars($category['name']) . "' name='CategoryName[]' type='text' placeholder='Product Category' readonly>";
    echo "</div>";

    echo "<div>";
    echo "<label for='Description'>Description: </label>";
    echo "<input class='desc' value='" . htmlspecialchars($category['description']) . "' name='Description[]' type='text' placeholder='Category Description' readonly>";
    echo "</div>";
}

// Check if form to insert a new category is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
    // Get the form data for the new category
    $name = $_POST['name'];
    $description = $_POST['description'];

    // Insert the new category into the database
    if (fetch_insert_posts($name, $description)) {
        echo "<p>New category added successfully!</p>";
    } else {
        echo "<p>Failed to add new category.</p>";
    }
}
?>

<!-- Form to insert a new category -->
<h2>Insert New Category</h2>
<form method="POST" action="">
    <div>
        <label for="name">Category Name: </label>
        <input type="text" id="name" name="name" required placeholder="Category Name">
    </div>

    <div>
        <label for="description">Description: </label>
        <input type="text" id="description" name="description" required placeholder="Category Description">
    </div>

    <button type="submit" name="insert">Insert Category</button>
</form>

<?php include('parts/footer.php'); ?>
