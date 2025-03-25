<?PHP
	$siteTitle = 'compare';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>Serialisieren von Objekten</h4>';
	class Base{
		public $eigenschaft = "String in der Klasse";
		public function lesen(){
			echo "Function in der Klasse";
		}
	}
	$obj1 = new Base();
	$serial = serialize($obj1);
		echo "<pre>";
			echo "Objekt serialisiert: " . $serial;
			echo "<br />Type: " . gettype($serial);
		echo "</pre>";
	$obj2 = unserialize($serial);
		echo "<pre>";
			echo "Objekt UNserialisiert: " . gettype($obj2);
		echo "</pre>";
			echo "<pre>";
			echo "Objekt obj2->lesen: " . $obj2->lesen();
		echo "</pre>";
	echo '<h4>__sleep</h4>';
	echo '<h4>__wakeup</h4>';
	class Parentclass{
		public $val = "String 01 in der Parentklasse";
		public $str = "String 02 in der Parentklasse";
		public function lesen(){
			echo "Function in der Parentklasse";
		}
		public function __sleep(){
			return array("val");
		}
		public function __wakeup(){
			$this->str="String 03 aus wakeUp";
		}
	}
	$obj3 = new Parentclass();
	$obj3->val="String 1 in des Objects3.<br/> ";
	$obj3->str="String 2 in des Objects3.<br/> ";
	$ser = serialize($obj3);
		echo "<pre>";
			echo "Objekt serialisiert: " . $ser;
			echo "<br />Type: " . gettype($ser);
		echo "</pre>";
	$obj4 = unserialize($ser);
		echo "<pre>";
			echo "Objekt UNserialisiert: " . gettype($obj4);
		echo "</pre>";
			echo "<pre>";
			echo "Objekt obj4->lesen: " . $obj4->lesen();
		echo "</pre>";
		echo "<pre>";
			echo "obj4->val: " . $obj4->val;
		echo "</pre>";
		echo "<pre>";
			echo "obj4->str: " . $obj4->str;
		echo "</pre>";
	
	
	echo '<hr />';
	echo '<br />Tutorial: https://';

?>
<?PHP
	include 'inc/footer.inc.php';
?>