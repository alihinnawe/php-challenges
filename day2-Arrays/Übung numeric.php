<html>
	<head>
		<?php print "<title>Übungen Arrays in PHP</title>";?>
		<!-- <?php ?> -->
		<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<header>
			<hgroup>
				<h3>Übungen Arrays in PHP<h3>
				<h5>numerisch indiziertes array</h5>
			<hgroup>
		</header>
		<?php 
			echo "<h4>Übung 01</h4>";
			echo "<p>Schreiben Sie ein Programm, in dem der Vorname und Nachname in zwei Feldern gespeichert wird.
				<br />Im ersten Feld soll der Vorname, im zweiten Feld soll das zugehörige Alter enthalten sein.
				<br/>Paarweise werden die Elemente in den beiden Feldern innerhalb einer Tabelle im viewport ausgegeben.</p>";
		?>
		
		<?php 
				$firstName = ['Ali','Shirin','Mohammed'];
				// 0 => Ali,
				// 1 => Shirin,
				// 2 => Mohammed
				$age=[41,25,35];
				// 0 => 41,
				// 1 => 25,
				// 2 => 35
				echo "<pre>";
				echo "<table border='1'>";
					
					echo "<tr>";
					echo "<th>Name</th>";
					echo "<th>Age</th>";
					echo "</tr>";
					for($i=0;$i<3;$i++)
						
					echo "<tr><td>$firstName[$i]</td><td>$age[$i]</td></tr>";
					echo "</table>";

				echo "</pre>";
			
		
		
		
		?>
		
		
		
		<p>Schreiben Sie ein Programm genauso als assoziatives Array.</p>
		<!-- <?php
		
		?> -->
	</body>
</html>

