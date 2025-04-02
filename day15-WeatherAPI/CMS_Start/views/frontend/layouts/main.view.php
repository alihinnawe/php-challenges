<!DOCTYPE HTML>
<html lang="de">
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" href="../styles/simple.css" type="text/css"/>
		<title>kleines CMS</title>
	</head>
	<body>
		<header>
		<h4>cms __Basissystem</h4>
		<?php foreach($navigation as $navigationElement):?>
			<a href="./?<?php echo http_build_query(['page'=> $navigationsElement->slug]);?>"><?php echo e($navigationElement->title);?></a>
		<?php endforeach;?>
		</header>
		<main>
			<?php echo $content; ?>
		</main>
		<footer><p>PHP basics 2025</p></footer>
	</body>
</html>