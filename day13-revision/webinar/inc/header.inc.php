<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="utf-8"/>
		<title><?php echo $siteTitle;?></title>
		<meta http-equiv="X-CA-Compatible" content="IE=Edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="stylesheet" type="text/css" href="styles/simple.css"/>
	</head>
	<body>
		<header>
			<h1>PHP OOP | 02</h1>
			<a href="#bottom">nach unten</a>
		<nav>
			<?php
				$menu = [
					0 => 'class',
					1 => 'NONoverloaded',
					2 => 'Erweiterungen',
					3 => 'Namensraum',
				];
				foreach($menu as $i => $link)
					echo "<a href='site_$i.php'>" . ($i +1) . "_$link</a>";
			?>
		</nav> 
		</header>
		<div id="top"></div>