<?PHP
	$siteTitle = '__operator ... ';
	include 'inc/header.inc.php';

	/****************************************/
?>
<?php
	echo '<h4>Vorgabewerte für Parameter - Überladen der Funktionen</h4>';
		echo "fatale Error";
/* 		class Monitor{
			function monitors($dis1,$dis2){
				return "Der Computer hat die Displays: $dis1 und $dis2<br />";
			}
			function monitors($dis1,$dis2,$dis3,$dis4,$dis5){
				return "Der Computer hat die Displays: $dis1, $dis2,$dis3,$dis4 und $dis5<br />";
			}
		}
		
		$monitor = new Monitor();
		echo "<pre>";
			echo $monitor->monitors("15 Zoll", "21 Zoll");
		echo "</pre>";
			echo "<pre>";
			echo $monitor->monitors("15 Zoll", "21 Zoll","23 Zoll", "26 Zoll", "27 Zoll");
		echo "</pre>"; */
	echo '<h4>Einsatz des ... - Operator</h4>';
	class baseclass{
		public function VarDisplay(...$displays){
			$number = func_num_args();
			echo "Displays[$number]: <br />";
				foreach($displays as $display){
					echo " # " . $display . " # ";
				}
			}
		}
		$object_1 = new baseclass();
		$object_1->VarDisplay("15 Zoll", "21 Zoll");
		echo "<pre>";
		var_dump($object_1);
		echo "</pre>";
		$object_1 -> VarDisplay("15 Zoll", "21 Zoll","23 Zoll", "26 Zoll", "27 Zoll");
		echo "<pre>";
		var_dump($object_1);
		echo "</pre>";
		echo '<h4>Einsatz der Methode func_get_args</h4>';
			class courses{
				public function courses(){
					$courses = func_get_args();
					$num = func_num_args();
					echo $num . " arguments: <br />\n";
					foreach($courses as $course){
						echo " * " . $course . " * ";
					}
				}
			}
			$myCourse = new courses();
			$myCourse ->courses("HTML","css");
			echo "<pre>";
/* 				echo "2 arguments: <br />\n";
 */				var_dump($myCourse);
			echo "</pre>";
			$myCourse ->courses("HTML","css","PHP","OOP","JavaScript","CAD");
			echo "<pre>";
/* 				echo "6 arguments: <br />\n";
 */				var_dump($myCourse);
			echo "</pre>";
			$myCourse ->courses("Word","Excel","PowerPoint","Adobe");
			echo "<pre>";
/* 				echo "6 arguments: <br />\n";
 */				var_dump($myCourse);
			echo "</pre>";
	echo '<hr />';
	echo '<br />Tutorial: https://www.php.net/manual/de/functions.arguments.php#functions.variable-arg-list';
	echo '<br />Tutorial: https://https://www.php.net/manual/de/function.func-get-arg.php';
?>
<?PHP
	include 'inc/footer.inc.php';
?>