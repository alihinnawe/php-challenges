<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles/simple.css" />
    <link rel="stylesheet" href="./styles/custom.css" />
    <title>Document</title>
</head>
<body>
    <header>
        <h1>Ein eigenes CMS Zwischenstand</h1>
        <p>mit Datenbankanbindung</p>
		<nav>
		<?php foreach($navigation AS $navigationsElement): ?> 
		<?php 
			/* <a href="index.php?page=<?php echo e($navigationsElement->slug);?>"><?php e($navigationsElement->title;?></a> */?>
			<a href="./?<?php echo http_build_query(['page' => $navigationsElement->slug]);?>">
			<?php echo e($navigationsElement->title);?></a>
		<?php ?>
		<?php  endforeach; ?>
    </header>
    <main>
        <?php echo $content; ?>
    </main>
    <footer>
        <p>Projekt: CMS </p>
    </footer>
</body>
</html>