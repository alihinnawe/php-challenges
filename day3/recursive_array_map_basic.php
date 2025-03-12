

<?php
	$day1 = [
		"1UE" => [
			"title" => "Ausgabe in PHP",
			"info" => [
				"date" => "2025-03-12",
				"location" => "Online"
			]
		],
		"2UE" => [
			"title" => "Superglobals",
			"info" => [
				"date" => "2025-03-14",
				"location" => "Classroom"
			]
		],
		"3UE & 4UE" => [
			"title" => "Include",
			"info" => [
				"date" => "2025-03-16",
				"location" => "Office"
			]
		],
		"ID" => [
			'id' => "PHP OOP",
			'level' => "cool",
			'nr' => "108",
			'ceo' => [
				'name' => 'noName',
				'age' => 'unKnown',
				'country' => 'noLand'
			]
		]
	];
	
	function recursive_array_map($day) {
		
		$keys = array_keys($day);
		$key_array_map_return = [];
		
		foreach($keys as $key => $value)
		{
				if (is_array($key)){
					$key_array_map_return[$key] = recursive_array_map($day[$key]);
					
				}
		}
		return $key_array_map_return;
		
	}
	
	$final_array = recursive_array_map($day1);
	echo "<pre>";
	var_dump($final_array);
	echo "<\pre>";

?>