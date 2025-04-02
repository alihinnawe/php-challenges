<?php

require_once __DIR__ . '/inc/all.php';

$cityName = 'Budapest';
// $fetcher = new \App\Weather\Fake\FakeWeatherFetcher();
$fetcher = new \App\Weather\Remote\RemoteWeatherFetcher();
$weather = $fetcher->getWeatherForCity($cityName);



var_dump($weather);

render(__DIR__ . '/views/view.php', ['weather' => $weather]);