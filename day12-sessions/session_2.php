<?php
	// Sessionverwaltung starten (startwert in php.ini unter session.auto_start=1)
	// Schreiben der Daten in $_SESSION
	session_start();
	$sitetitle = "Sessions_read";
?>
	<html>
	<head>
		<meta charset="UTF-8"/>
		<title><?php echo $sitetitle;?></title>
	</head>
	<body>
	<h4>Lesen der Daten in assArr</h4>
		<?php
			if(isset($_SESSION['keyword'])){
				echo htmlspecialchars($_SESSION['keyword']);
				echo "<br />";
			echo htmlspecialchars($_SESSION['assoziation']);
			}
			// Löschen der Daten ohne das Löschen der ID
			/* unset($_SESSION['keyword']);
			   unset($_SESSION['assoziation']); */
			session_unset();
			session_destroy();
			setcookie(session_name(),'deleted',0,"/");
			echo "<hr />";
			echo "Ihre Sitzungs - ID ist: " . session_id();
		?>
		<p>Lesen der Daten: <a href="session_1.php">writeDatas</a></p>
		<p><a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">Neu Laden</a>
	</body>
	</html>