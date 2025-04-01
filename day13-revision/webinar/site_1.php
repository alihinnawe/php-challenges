<?php
	$siteTitle = '...Operator';
	include 'inc/header.inc.php';
?>
		<main>
		<?php
		// Klassendefinition [klassischer Konstruktor]
			class BaseClass{
				public $variable = 'Eigenschaft';
				public function op(...$werte){
					foreach($werte as $wert){
						echo $wert . "<br />";
					}
				}
			}
			$obj = new BaseClass();
			echo "<pre>";
				$obj -> op("value1","value2");
				$obj -> op("value1","value2","value3");
				$obj -> op("value1","value2","value3","value_4","value_5");
			echo "</pre>";
		?>
		<?php
			//
		?>
		</main>
<?php
	include 'inc/footer.inc.php';
?>