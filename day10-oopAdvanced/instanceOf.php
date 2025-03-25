<?PHP
	$siteTitle = '__instanceof';
	include 'inc/header.inc.php';
?>
<?php
	echo '<h4>object instanceof class</h4>';
		class baseClass{
			public $variable = "Basisklasse 01";
		}
		class B_class{
			public $var = "Basisklasse 02";
			}
		function overWrite($obj){
			if($obj instanceof baseClass){
				$output = $obj -> variable = "Standardwert der Instanz von baseClass";
				echo $output;
			}else{
				echo "UUups, das ist kein Wert der objIns der baseClass";
			}
		}
		
		$NonInstanz = new B_class();
		echo "<pre>";
			overWrite($NonInstanz);
		echo "</pre>";
		$instan = new baseClass();
		echo "<pre>";
			overWrite($instan);
		echo "</pre>";
	echo '<hr />';
	echo '<br />Tutorial: https://www.php.net/manual/de/language.operators.type.php';
	
?>
<?PHP
	include 'inc/footer.inc.php';
?>