<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bildergalerie</title>
   <link rel="stylesheet" href="styles/gallery.css" type="text/css"/>
  <link rel="stylesheet" href="styles/simple.css" type="text/css"/>

</head>
<body>
    <header>
        <h1>PHP OOP | <small>_02</small></h1>
        <p>Eine Bildergalerie, die in der Folge verschiedene Funktionen anbietet, z.B. Datenanbindung</p>
        <h3>Bildergalerie in PHP OOP</h3>
        <a href="#bottom">🔻</a>
    </header>

    <main>
        <?php
        // Check if $images is set and not empty
        if (!empty($images)) : ?>
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
            <p>Es wurden keine Bilder gefunden.</p>
        <?php endif; ?>
    </main>

    <div id="bottom"></div>
    <footer>
        <p>PHP OOP | Berlin 2025 | Ali Hinnawe</p>
        <a href="#top">🔺</a>
    </footer>
</body>
</html>
