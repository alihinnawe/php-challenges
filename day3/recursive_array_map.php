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
    $key_array_map_return = [];

    foreach ($day as $key => $value) {
        if (is_array($value)) {
            $result = recursive_array_map($value);
            foreach ($result as $nested_key => $nested_value) {
                $key_array_map_return[$nested_key] = $nested_value;
            }
        } else {
            $key_array_map_return[$key] = $value;
        }
    }

    return $key_array_map_return;
}

$final_array = recursive_array_map($day1);

$flattened_array = [];

foreach ($final_array as $key => $value) {
    if (is_array($value)) {
        foreach ($value as $nested_key => $nested_value) {
            $flattened_array[$nested_key] = $nested_value;
        }
    } else {
        $flattened_array[$key] = $value;
    }
}

echo "<pre>";
var_dump($flattened_array);
echo "<h1>test<\h1>";
echo "</pre>";

?>
