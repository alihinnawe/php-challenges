<?PHP
	$siteTitle = 'SPLFileObject';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>SPLFileObject</h4>';
	echo '<h6>fgetCSV()</h6>';
	echo "<p>Beispiele PHP Manual</p>";
	
	$file = new SPLFileObject('text.csv');
	echo "<pre>";
	while(!$file ->eof()){
		var_dump($file->fgetcsv());
	}
	echo "</pre>";
	
	echo '<h6>fgetCSV() mit setFlags()</h6>';
	
	$file = new SPLFileObject('test.csv');
	$file -> setFlags(SplFileObject::READ_CSV);
	
	echo "<pre>";
	foreach($file as $row){
		list($zeile,$val1,$val2,$val3) = $row;
		printf('Spalte1: %s | Spalte2: %s | Spalte3: %s | Spalte4: %s <hr />',$zeile,$val1,$val2,$val3);
	}
	echo "</pre>";
?>
<?PHP
	include 'inc/footer.inc.php';
?>