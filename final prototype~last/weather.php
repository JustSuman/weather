<?php
//get the weather sent from the js
$city = $_GET['city'];

//api key
$apiKey = 'ff481f559fea02934cdb1cf3a79b991a';
//url of the weather api
$url = 'https://api.openweathermap.org/data/2.5/weather?q=' . $city . '&appid=' . $apiKey . '&units=metric';

//read the weather data
$response = file_get_contents($url);
// echo the result such that js can read the value
echo $response;
require './intoDatabase.php';
