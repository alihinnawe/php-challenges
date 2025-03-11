<html>
	<head>
		<?php print "<title>Übungen Arrays in PHP</title>";?>
		<!-- <?php ?> -->
		<link href="style.css" rel="stylesheet" type="text/css"/>
	</head>
	<body>
		<header>
			<hgroup>
				<h3>Übungen Arrays in PHP</h3>
				<h5>numerisch indiziertes array</h5>
			</hgroup>
		</header>
		
		<form action="" method="POST">
				<fieldset>
					<legend>IndexArr Personal Info</legend>
					<label for="firstname">First Name:</label>
					<input type="text" name="firstname" value="<?php if (isset($_POST['firstname'])) { echo trim($_POST['firstname']);} ?>" required><br><br>
					
					<label for="age">Age:</label>
					<input type="text" name="age" value="<?php if (isset($_POST['age'])) { echo trim($_POST['age']); } ?>" required><br><br>
					
					<input type="submit" value="Submit">					
				</fieldset>
		</form>
		
		<?php 
		
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				echo "<h4>Übung 01</h4>" . "\n";
				echo "<pre>";
					echo "My firstname is " . " " . htmlspecialchars($_POST['firstname']) . " and my age is " . htmlspecialchars($_POST['age']) ."!" . "\n\n";
					//var_dump(htmlspecialchars($_POST['firstname']));
					//var_dump(htmlspecialchars($_POST['age']));
					
					echo "<table border='1'>";
					
					echo "<tr>";
					echo "<th>Name</th>";
					echo "<th>Age</th>";
					echo "</tr>";
					echo "<tr>";
					echo "<td>" .htmlspecialchars($_POST['firstname']) . "</td>";
					echo "<td>" .htmlspecialchars($_POST['age']) . "</td>";
					echo "</tr>";
					echo "</table>";

				echo "</pre>";
			}
		?>
		<p>Schreiben Sie ein Programm genauso als assoziatives Array.</p>
		 <?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				
				$perosnal_info = array("vorname" => htmlspecialchars($_POST['firstname']), "age"=> htmlspecialchars($_POST['age']));
			
			echo "<table border='1'>";
					
					echo "<tr>";
					echo "<th>Key</th>";
					echo "<th>Value</th>";
					echo "</tr>";
					
					foreach ($perosnal_info as $key => $value) {
						echo "<tr><td> $key </td> <td> $value </td></tr>";
					}
					
					echo "</table>";
			}
		?> 
	</body>
</html>

