<?php
	function execute($fun){
		$fun();
	}


function ft(){
	$variable = 'value';
		execute(
			function() use ($variable){	
			// global $variable = 'value';
			var_dump($variable);
			echo "<br />";
			var_dump('Hier ist ein execute...');
		});
}

ft();