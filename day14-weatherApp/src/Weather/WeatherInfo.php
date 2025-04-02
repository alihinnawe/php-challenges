<?php
	namespace App\Weather;

    class WeatherInfo {
        public function __construct(
            public string $cityName,  // Add city name
            public string $temperature,
            public bool $raining
        ) {}
    }
