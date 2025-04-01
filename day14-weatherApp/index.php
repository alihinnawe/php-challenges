<?php

require_once __DIR__ . '/inc/all.php';

$fetcher = new \App\Weather\Fake\FakeWeatherFetcher;
$weather = $fetcher->getWeatherForCity('Belgrad');


var_dump($weather);

render(__DIR__ . '/views/view.php', ['weather' => $weather]);