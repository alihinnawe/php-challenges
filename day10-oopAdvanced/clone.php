<?PHP
	$siteTitle = 'clone ';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>Objekte klonen</h4>';
		class SuperClass{
			public $variable = "Standardwert der SuperClass";
			public function output(){
				echo "Output der SuperClass";
			}
			}
			function modify($obj){
				$obj->variable = "Standardwert modify()";
				echo "In der Funktion: $obj->variable<br />";
			}
			$Referenz = new SuperClass();
			// clone: Kopie der Orginalinstanz
			// Übergabe des Clone als Wert an die äußere Funktion
			modify(clone $Referenz);
			echo "Außerhalb der Funktion: $Referenz->variable";
	echo "<h4>clone | __clone</h4>";
	echo "<p>Beispiel Manual:  Eine Objektkopie wird durch die Nutzung des clone Schlüsselwortes (welches wenn möglich die __clone()-Methode des Objektes aufruft) erzeugt.<br />

		&#36;kopie_des_objektes = clone &#36;objekt;<br />
	Wenn ein Objekt geklont wird, wird PHP eine seichte Kopie der Eigenschaften des Objektes durchführen. Alle Eigenschaften, die Referenzen auf andere Variablen sind, werden Referenzen bleiben. </p>";	
		class SubObject
			{
			static $instanzen = 0;
			public $instanz;

			public function __construct() {
        $this->instanz = ++self::$instanzen;
			}

			public function __clone() {
				$this->instanz = ++self::$instanzen;
			}
		}
		class MyCloneable
		{
			public $objekt1;
			public $objekt2;

			function __clone()
			{
				// Erzwinge eine Kopie von this->object,
				// andernfalls wird es auf das selbe Objekt zeigen
				$this->objekt1 = clone $this->objekt1;
			}
		}

			$obj = new MyCloneable();

			$obj->objekt1 = new SubObject();
			$obj->objekt2 = new SubObject();

			$obj2 = clone $obj;

			echo "<pre>";
				print "Original Objekt:\n";
				print_r($obj);
			echo "</pre>";
			echo "<pre>";
				print "geklontes Objekt:\n";
				print_r($obj2);
			echo "</pre>";


	echo "<h4>Zugriff auf ein Element eines soeben geklonten Objekts</h4>";
	echo "<p>Beispiel Manual: Es ist möglich, auf die Klassenelemente eines soeben geklonten Objekts in einem einzigen Ausdruck zuzugreifen:</p>";
		$dateTime = new DateTime();
		echo "<pre>";
		echo (clone $dateTime)->format('d.m.y');
		echo "</pre>";
	
	echo '<hr />';
	echo '<br />Tutorial: https://www.php.net/manual/de/language.oop5.cloning.php';

?>
<?PHP
	include 'inc/footer.inc.php';
?>