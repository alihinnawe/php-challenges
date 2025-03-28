<?php
	// Sessionverwaltung starten (startwert in php.ini unter session.auto_start=1)
	// Schreiben der Daten in $_SESSION
	session_start();
	$sitetitle = "Sessions_write";
?>
	<html>
	<head>
		<meta charset="UTF-8"/>
		<title><?php echo $sitetitle;?></title>
	</head>
	<body>
	<h4>Schreiben der Daten in assArr</h4>
		<?php
			echo "Ihre Sitzungs - ID ist: " . session_id();
		
			$_SESSION['keyword'] = "value in _Session";
			$_SESSION['assoziation'] = "Wert in _Session";
		?>
		<p>Lesen der Daten: <a href="session_2.php">readDatas</a></p>
	</body>
	</html>