<?php
$servername = "localhost";
$database = "id20714130_weather";
$username = "id20714130_admin";
$password = "VegaPunk#16";

$conn = new mysqli($servername, $username, $password, $database);

$json_data = json_decode($response, true);

$city = $json_data['name'];
$temp = $json_data['main']['temp'];
$description = $json_data['weather'][0]['description'];
$wind = $json_data['wind']['speed'];
$humidity = $json_data['main']['humidity'];
$icon = $json_data['weather'][0]['icon'];
$day = date('l');

// Check if the data already exists in the database
$check_sql = "SELECT * FROM weather WHERE `LOCATION` = '$city' AND `date` = CURRENT_DATE()";
$result = $conn->query($check_sql);

$sql = "INSERT INTO weather (`TEMP`, `HUMIDITY`, `WIND`, `LOCATION`, `icon`, `description`, `day`) VALUES ($temp, $humidity, $wind, '$city', '$icon', '$description', '$day')";
if ($result->num_rows === 0) {
    mysqli_query($conn, $sql);
}

$conn->close();
