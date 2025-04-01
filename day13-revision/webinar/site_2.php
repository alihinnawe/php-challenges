<?php
	$siteTitle = 'Erweiterungen';
	include 'inc/header.inc.php';
?>
		<main>
		<?php
			echo "<h2>extends</h2>";
		// Klassendefinition [klassischer Konstruktor]
			/* class BaseClass{
				public $variable = 'Eigenschaft der BaseClass';
				public function op($werte){
					echo $wert . "<br />";
					}
				}
			class SubClass extends BaseClass{
				public $attribut = 'Eigenschaft der SubClass';
				}
			$objSub = new SubClass();
			echo $objSub->variable . "<br />";
			echo "$objSub->attribut<br />";
			echo "<hr />";
			$objSub->variable="Neue Zuweisung für den Wert aus BaseClass";
			echo $objSub->variable . "<br />"; */
			
		?>
		<?php
			echo "<h2>extends</h2>";
			class BaseClass{
				public $variable = 'Eigenschaft der BaseClass';
				public function op(){
					return "Function der BaseClass" . "<br />";
					}
				}
			class SubClass extends BaseClass{
				public $attribut = 'Eigenschaft der SubClass';
				public function op(){
					return "Function der SubClass" . "<br />";
					}
				}
				
			$objSub = new SubClass();
			echo $objSub->op(). "<hr />";
			$obj_1 = new BaseClass;
			echo $obj_1->op(). "<hr />";;
			?>
			<?php
				echo "<h2>interface</h2>";	
				interface Booten{
					public function boot();
				}
				interface Formatieren{
					public function formater($form);
				}
				class WorkingClass implements Booten, Formatieren{
					public function boot(){
						return "Der Rechner bootet.";
					}
					public function formater($form){
						return "Laufwerk $form ist formatiert.";
					}
				}
				
				class ElectronicClass implements Booten{
					public function boot(){
						return "Die Engine des Cars bootet.";
					}
				}
				
				$WorkingObj = new WorkingClass();
				echo $WorkingObj->boot() . "<hr />";
				echo $WorkingObj->formater('C') . "<hr />";
				$ElectronicObj = new ElectronicClass();
				echo $ElectronicObj->boot() . "<hr />";
				?>
			<?php
				echo "<h2>abstract</h2>";
					abstract class AbstrakteKlasse{
						abstract protected function getVal();
						/* abstract private function getVal();
						Fatal error: Abstract function AbstrakteKlasse::getVal() cannot be declared private in */
						abstract protected function starten($val);
						
						public function ausgabe(){
						echo $this->getVal() . "<br />";
					}
				}
				class Klasse_1 extends AbstrakteKlasse{
					protected function getVal(){
						return "Klasse_1 [concrete]";
					}
					public function starten($val){
						return "Übergebener Wert : $val.";
					}
				}
					class Klasse_2 extends AbstrakteKlasse{
					protected function getVal(){
						return "Klasse_2 [concrete]";
					}
					public function starten($val){
						return "Übergebener Wert : $val.";
					}
				}
				$object_1 = new Klasse_1();
				echo $object_1-> ausgabe();
				$object_2 = new Klasse_2();
				echo $object_2-> ausgabe();
			?>
		</main>
<?php
	include 'inc/footer.inc.php';
?>