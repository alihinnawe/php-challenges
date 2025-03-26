<?PHP
	$siteTitle = 'Iterator';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>Iterator</h4>';
	echo	 '<h6>klassisches Iterieren</h6>';
		 $txt = 'Komma. separierte Werte. in Massen';
		 $teile = explode('.',$txt);
		 foreach($teile as $wert){
			 echo ' | ' . $wert . ' | ';
		 }
		 echo "<hr />";
	echo'<h6>Sellbstiterieren mit "Iterator"</h6>';
		/* Interface Iterator Methoden 
			public current(): mixed
			public key(): mixed
			public next(): void
			public rewind(): void
			public valid(): bool
		 */
		class BaseIterator implements Iterator{
			private $Ziel;
			private $Index;
			function __construct($Ziel){
				$this->Ziel = $Ziel;
			}
			public function current(){
				return $this->Ziel[$this->Index];
			}
			public function next(){
				$this->Index++;
			}
			public function rewind(){
				$this->Index = 0;
			}
			public function key(){
				return $this->Index;
			}
			public function valid(){
				return $this->Index < count($this->Ziel);
			}
		}
	class BaseClass implements IteratorAggregate{
		public $obj = array("Komma", "separierte Werte", "in Massen");
		function getIterator(){
			return new BaseIterator($this->obj);
		}
	}
	$obj1 = new BaseClass();
	$i = $obj1 -> getIterator();
	for ($i->rewind();$i->valid();$i->next()){
		echo "Index: " . $i->key() . "<br />";
		echo "Wert: " . $i->current() . "<br />";
	}
	echo '<hr />';
	echo '<br />Tutorial: https://www.php.net/manual/de/class.iterator.php';
	echo "<h6>Beispiel PHP Manual</h6>";
		class meinIterator implements Iterator {
			private $position = 0;
			private $array = array(
				"erstesElement",
				"zweitesElement",
				"letztesElement"
				);

			public function __construct() {
				$this->position = 0;
			}

			public function rewind(): void {
				var_dump(__METHOD__);
				$this->position = 0;
			}

			#[\ReturnTypeWillChange]
			public function current() {
				var_dump(__METHOD__);
				return $this->array[$this->position];
			}

			#[\ReturnTypeWillChange]
			public function key() {
				var_dump(__METHOD__);
				return $this->position;
			}

			public function next(): void {
				var_dump(__METHOD__);
				++$this->position;
			}

			public function valid(): bool {
				var_dump(__METHOD__);
				return isset($this->array[$this->position]);
			}
		}
		$it = new meinIterator;
		echo "<pre>";
			foreach($it as $key => $value) {
				var_dump($key, $value);
				echo "\n";
		echo "<pre>";
	}
?>

<?PHP
	include 'inc/footer.inc.php';
?>