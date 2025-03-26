<?PHP
	$siteTitle = 'Iterator Filter';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>Iterator</h4>';
	echo '<h6>Iterator Filter</h6>';
	class CSVIterator implements Iterator{
		private $csv;
		private $position;
		public function __construct($csv){
			$this->csv = explode(',',$csv);
		}
		public function next(){
			$this->position += 1;
		}
		public function rewind(){
			$this->position = 0;
		}
		public function key(){
			return $this->position;
		}
		public function current(){
			return $this->csv[$this->position];
		}
		public function valid(){
			return $this->position < count($this->csv);
		}
	}
	
	class CSVFilterIterator extends FilterIterator{
		private $wert;
		
		public function __construct(CSVIterator $CSVIterator, $wert){
			parent:: __construct($CSVIterator);
			$this->wert = $wert;
			}
		public function accept(){
			$element = $this ->getInnerIterator()->current();
			if(strpos($element,$this->wert) !== 0){
				return true;
			}else{
				return false;
			}
		} 
	}
	
	class CSV implements IteratorAggregate{
		private $csv;
		public function __construct($csv = ' '){
			$this->csv = $csv;
		}
		public function getIterator(){
			return new CSVFilterIterator(new CSVIterator($this->csv), 'Komma');
		}
	}
	
	$txt = new CSV('Komma,in Massen,separierte,Werte');
	
	foreach($txt as $key => $value){
		echo $value . " <br /> ";
	}
	
?>
<?PHP
	include 'inc/footer.inc.php';
?>