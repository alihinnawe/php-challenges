<?PHP
	$siteTitle = '__anonyme_class';
	include 'inc/header.inc.php';
?>

<?php
	echo '<h4>anonyme Klasse</h4>';
	// Klasse ohne Klassenname
	$image = new class{
	// v.a. innerhalb des Klassenkonzepts, wenn eine Funktion oder Methode eine Klasse als Parameter erwartet
		public function getTheImage($title,$id){
			echo "Dieses Bild ist $id. " . $title; 
			}
	};
	$image->getTheImage('Bild 1','a');
?>
<?PHP
	include 'inc/footer.inc.php';
?>