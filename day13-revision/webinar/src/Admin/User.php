<?php

	/* namespace Admin; */
	namespace App\Admin;
	/* use PDO; */
	
	class User{
		public function printName(){
			echo "<br />";
			 $role = new Role();
			echo "<br />";
			echo 'printName()| NS Admin | Klasse Admin / User wurde aufgerufen.<br />';
		}
		public function methodNamespace(){
		// $pdo = new PDO();
			$role = new Role();
			echo '<pre>methodNamespace(Admin)</pre>';
	}}