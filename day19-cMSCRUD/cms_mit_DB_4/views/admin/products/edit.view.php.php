<h2>Edit Product</h2>
<form action="" method="post" enctype="multipart/form-data">
    <label>Name: <input type="text" name="product_name" value="<?= htmlspecialchars($product['product_name']) ?>" required></label><br><br>
    <label>Description: <textarea name="product_description" required><?= htmlspecialchars($product['product_description']) ?></textarea></label><br><br>
    <p>Current Image:</p>
    <img src="public/static/<?= htmlspecialchars($product['product_image']) ?>" width="120"><br><br>
    <label>Change Image: <input type="file" name="product_image"></label><br><br>
    <button type="submit">Update</button>
</form>
