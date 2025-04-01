<?php
			namespace myNS;
			class Begruessung{
				private $name;
				function __construct($name){
					$this->name = $name;
				}
				function helloWorld(){
				echo "Hallo {$this->name}.";
				}
			}
	?>