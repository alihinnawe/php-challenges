<?PHP
	$siteTitle = '__traits';
	include 'inc/header.inc.php';
?>

<?php
	echo '<h4>Traits_o1</h4>';
	echo "<p>Traits stellen Methoden zur Verfügung, seltener Eigenschaften.</p>";
	trait Converter{
		private function mbIngb($mb){
			$gb = $mb / 1024;
			return $gb;
		}
	}
	trait SecondConverter{
		private function mbIngb($mb){
			$gb = $mb / 1024;
			return $gb . "GigaByte";
	}
	}
	class Computer{
		use Converter, SecondConverter
		{
			Converter:: mbIngb insteadof SecondConverter;
			/* Converter:: mbIngb as public; */
			Converter:: mbIngb as protected;
			SecondConverter:: mbIngb as public convRam;
		}
		
		public $RAM = '1024';
		public function RAMConv(){
			$gb = $this->mbIngb($this->RAM);
			return "Der Wert ist: " . $gb . "GB RAM"; 
	}
		}
	
	class Handy extends Computer{
		public $RAM = "4096";
		/* public function RAMConv(){
			$gb = $this->mbIngb($this->RAM);
			return "Der Wert ist: " . $gb . "GB RAM"; 
	}*/ }
	echo "<pre>";
	$pc = new Computer();
	var_dump('objComputer: ' . $pc -> RAMConv(''));
	/* var_dump('objComputer: ' . $pc -> mbIngb('2048')); */
	var_dump('objComputer: ' . $pc -> convRam('2048'));
	echo "</pre>"; 
	echo "<pre>";
	$mobile = new Handy;
	var_dump('objMobile: ' . $mobile -> RAMConv());
	/* var_dump('objMobile: ' . $mobile -> mbIngb(4096)); */
	var_dump('objMobile: ' . $mobile -> convRam('2048'));
	echo "</pre>";
	
	echo "<hr />";
	echo "<p>Tutorial: https://www.php.net/manual/de/language.oop5.traits.php</p>";
?>
<?PHP
	include 'inc/footer.inc.php';
?>