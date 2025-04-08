<?php
	function myFunction(){
		var_dump('hier ist myFunction ....');
	}
	
	$fkt = 'myFunction';
	$fkt();
	
	echo "<hr />";
	
	$funktion = function(){
		var_dump('hier ist die anonyme Function ....');
	};
	
	$funktion();
	echo "<hr />";
	$variable = $funktion;
	
	$variable();
