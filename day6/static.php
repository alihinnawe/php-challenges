<?PHP
	$siteTitle = '__late static binding';
	include 'header.inc.php';
?>
<?PHP
	/* __CLASS__ | :: self  | ::static */
	class Base{
	public static function klasse(){
		// Klassenname aus aktuellem Kontext
			return __CLASS__;
		}
	public static function basemethod(){
		// direkter Zugriff auf die Klasse innerhalb des Vererbungsverhaltens
		/* return self::klasse() . ": aktuelle Klasse erzeugt";*/ 
		
		// statischer Zugriff auf die Klasse innerhalb des Vererbungsverhaltens
		// Typdeklaration
		return static::klasse() . ": aktuelle Klasse erzeugt";
	}
	}
	class SubClass extends Base{
		public static function klasse(){
		return __CLASS__;
		}
	}
	echo SubClass::basemethod();
	echo Base::basemethod();
?>

<?PHP
	include 'footer.inc.php';
?>