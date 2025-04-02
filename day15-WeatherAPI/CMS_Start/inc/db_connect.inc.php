<?php
	try{
		$pdo = new PDO('localhost','dbname','','',[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
	}
	catch(PDOException $e){
		echo "Die Verbindung zur Datenbank kann nicht aufgebaut werden...";
		die();
	}

// https://www.php.net/manual/de/pdo.error-handling.php
