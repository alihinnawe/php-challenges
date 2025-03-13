<?php

$day = [
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

$final_array = recursive_array_map($day);
echo "<pre>";
var_dump($final_array);
echo "</pre>";
function recursive_array_map($day) {
    $key_array_map_return = [];

    foreach ($day as $key => $value) {
        if (is_array($value)) {
            echo "sub array of {$key}:<br>";
            echo "<pre>";
            var_dump($value);
            echo "</pre>";
            $key_array_map_return[$key] = recursive_array_map($value);
        } else {
            $key_array_map_return[$key] = $value;
        }
    }

    return $key_array_map_return;
}




?>
