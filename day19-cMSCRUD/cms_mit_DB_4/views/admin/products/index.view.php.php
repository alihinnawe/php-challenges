<h2>All Products</h2>
<a href="index.php?route=admin/product/create">+ Add New Product</a>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th>Image</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['id']) ?></td>
            <td><?= htmlspecialchars($row['product_name']) ?></td>
            <td><?= htmlspecialchars($row['product_description']) ?></td>
            <td><img src="public/static/<?= htmlspecialchars($row['product_image']) ?>" width="80"></td>
            <td>
                <a href="index.php?route=admin/product/edit&id=<?= $row['id'] ?>">Edit</a> |
                <a href="index.php?route=admin/product/delete&id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endwhile; ?>
</table>
