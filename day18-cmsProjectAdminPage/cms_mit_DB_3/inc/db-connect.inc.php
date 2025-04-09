<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=cms', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
	return $pdo;
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}
