<?php
	$siteTitle = '';
	include 'inc/header.inc.php';
?>
		<main>
		<?php
		// Klassendefinition [klassischer Konstruktor]
			class BaseClass{
				public $variable = 'Eigenschaft';
				public function op(){
					return "Methode";
				}
			}
			$obj = new BaseClass();
			echo "<pre>";
			echo $obj->variable,PHP_EOL, $obj-> op(),PHP_EOL;
			echo "</pre>";
		?>
		<?php
			class ParentClass{
				public $Speicher = "der Speicher der Klasse"; 
				/* private $Speicher = "der Speicher der Klasse";
				Fatal error:  Uncaught Error: Cannot access private property ParentClass::$Speicher in C:\xampp\htdocs\oop\webinar\index.php:31
				Stack trace: #0 {main}   thrown in C:\xampp\htdocs\oop\webinar\index.php on line 31*/
				private function formatieren(){
					return "Festplatte ist formatiert";
				}
				public function starten(){
					return "Gestartet: " . $this->formatieren();
				}
				public function __construct($wert){
					$this->Speicher = $wert;
					echo "Objekt instanziiert. <br />";
				}
				public function __destruct(){
					echo "Destruktor aktiviert <br />";
				}
			}
			$BaseObj = new ParentClass('der Speicher des Objekts_1');
			$BaseObj_1 = new ParentClass('der Speicher des Objekts_2');
			echo "<pre>";
			echo $BaseObj ->Speicher;
			echo "</pre>";
			echo "<pre>";
			echo $BaseObj_1 ->Speicher;
			echo "</pre>";
			echo "<pre>";
			echo $BaseObj ->starten();;
			echo "</pre>";
			echo "<pre>";
			echo $BaseObj_1 ->starten();;
			echo "</pre>";
			/* echo "<pre>";
			echo $BaseObj->formatieren(); 
			// Uncaught Error: Call to private method
			echo "</pre>"; */
		?>
		</main>
<?php
	include 'inc/footer.inc.php';
?>