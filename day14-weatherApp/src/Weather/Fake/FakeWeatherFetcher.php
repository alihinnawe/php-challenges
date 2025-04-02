<?php 

namespace App\Weather\Fake;

use App\Weather\WeatherContract;
use App\Weather\WeatherInfo;
$cityName = "Beirut";
class FakeWeatherFetcher implements WeatherContract {
    public function getWeatherForCity(string $cityName): ?WeatherInfo {
        return new WeatherInfo($cityName, "21°C", false);
    }
}
