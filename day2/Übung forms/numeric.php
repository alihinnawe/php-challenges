<html>
	<head>
		<?php print "<title>Übungen Arrays in PHP</title>";?>
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
				echo "<h4>Übung 01 (Numerisches Array)</h4>";
				echo "<pre>";

				// Numerisch indiziertes Array
				$personal_info1 = array(
					0 => htmlspecialchars($_POST['firstname']),
					1 => htmlspecialchars($_POST['age'])
				);
				
				echo "<table border='1'>";
				echo "<tr><th>Name</th><th>Age</th></tr>";
				echo "<tr><td>{$personal_info1[0]}</td><td>{$personal_info1[1]}</td></tr>";
				echo "</table>";
				echo "</pre>";
			}
		?>

		<p>Schreiben Sie ein Programm genauso als assoziatives Array.</p>

		<?php
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				echo "<h4>Übung 02 (Assoziatives Array)</h4>";
				
				$personal_info = array(
					"Vorname" => htmlspecialchars($_POST['firstname']),
					"Alter" => htmlspecialchars($_POST['age'])
				);
			
				echo "<table border='1'>";
				echo "<tr><th>Key</th><th>Value</th></tr>";
				
				foreach ($personal_info as $key => $value) {
					echo "<tr><td>$key</td><td>$value</td></tr>";
				}
				
				echo "</table>";
			}
		?> 
	</body>
</html>
