<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="styles/gallery.css" type="text/css"/>
    <title>Image Gallery</title>
</head>
<body>

<h1>Image Gallery</h1>

<?php if (!empty($images)) : ?> 
    <div class="image-gallery">
        <?php foreach ($images as $image) : ?>
            <figure>
                <img src="images/<?php echo htmlspecialchars($image->src); ?>" 
                     alt="<?php echo htmlspecialchars($image->title); ?>" 
                     title="<?php echo htmlspecialchars($image->title); ?>">
                <figcaption><?php echo htmlspecialchars($image->title); ?></figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
<?php else : ?>
    <p>No images found.</p>
<?php endif; ?>

</body>
</html>
