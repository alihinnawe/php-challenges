<?PHP
	$siteTitle = 'compare';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>Vergleich von Objekten gleicher Klasse</h4>';
		class SuperClass{
			public $eigenschaft = "Eigenschaft der SuperClass";
			public function output(){
				echo "Output der SuperClass";
			}
		}
		
		$objectOne = new SuperClass();
		$objectTwo = new SuperClass();
	
		echo "<pre>";
			echo "Vergleich obj1 '==' obj2 <br />";
			echo $objectOne == $objectTwo; // true[1]
		echo "</pre>";
		echo "<pre>";
			echo "Vergleich obj1 '===' obj2 <br />";
			echo $objectOne === $objectTwo; //false[] 
		echo "</pre>";
			echo "<pre>";
			echo "Vergleich obj1 '===' obj1 <br />";
			echo $objectOne === $objectOne; //true[1]
		echo "</pre>";
		$objectTwo->eigenschaft="Eigenschaft des obj2";
		echo "<pre>";
			echo "Vergleich obj1 '==' obj2[geänderte Eigenschaft] <br />";
			echo $objectOne == $objectTwo; //false[]
		echo "</pre>";
	
	echo '<hr />';
	echo '<br />Tutorial: https://';

?>
<?PHP
	include 'inc/footer.inc.php';
?>