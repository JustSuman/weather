<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
    <title>Weather | Suman Shrestha</title>
</head>

<body style="background: none;">
    <header>
        <span>Weather Forecast</span>
        <div class="searchbar" style="border: 1px solid black;">
            <i class="fa-solid fa-location-dot"></i>
            <form method="get">
                <input type="text" placeholder="Enter your city" name='location'>
                <button><i class=" fa-solid fa-magnifying-glass" onclick="inputEnter()"></i></button>
            </form>
        </div>
    </header>
    <?php
    function fetchThem($city)
    {
        // Set cache file name
        $cache_file = "cache/" . md5($city) . ".json";

        // Check if cache file exists and is less than an hour old
        if (file_exists($cache_file) && time() - filemtime($cache_file) < 3600) {
            // Read data from cache file
            $json_data = file_get_contents($cache_file);
        } else {
            // Fetch data from API
            $api_url = "https://api.openweathermap.org/data/2.5/weather?q=$city&units=metric&appid=ff481f559fea02934cdb1cf3a79b991a";
            $curl = curl_init($api_url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);

            // Check for errors while fetching the data
            if (curl_errno($curl)) {
                echo 'Error fetching API: ' . curl_error($curl);
                return;
            }
            curl_close($curl);

            // Write data to cache file
            file_put_contents($cache_file, $response);

            // Store fetched data in $json_data
            $json_data = $response;
        }

        // Manipulating JSON data
        $json_data = json_decode($json_data, true);
        // ...
        $city =  $json_data['name'];
        $temp =  $json_data['main']['temp'];
        $description = $json_data['weather'][0]['description'];
        $wind = $json_data['wind']['speed'];
        $humidity = $json_data['main']['humidity'];
        $icon = $json_data['weather'][0]['icon'];

        // creating the format of the prototype 1, ui
        $str = '<div class="container">';
        $str .= '<div class="weather">';
        $str .= '<span class="month" name="$month"></span>';
        $str .= '<span id="city" name="$location">' . $city . '</span>';
        $str .=    '<img src="https://openweathermap.org/img/wn/' . $icon . '@2x.png" alt="icon">';
        $str .=    '<span class="temperature">' . $temp . '°C</span>';
        $str .=    '<h1 class="description">' . $description . '</h1>';
        $str .=    '<span class="wind">Wind: ' . $wind . 'km/hr</span>';
        $str .=    '<span class="humidity" >Humidity: ' . $humidity . '%</span>';
        $str .= '</div>';
        $str .= '</div>';

        // Print result
        echo $str;
        $servername = "localhost";
        $database = "weather";
        $username = "root";
        $password = "";
        $conn = new mysqli($servername, $username, $password, $database);
        // inserting into database
        $sql = "INSERT INTO weather (TEMP , HUMIDITY, WIND, LOCATION, icon, description) VALUES ($temp, $humidity, $wind,' $city', '$icon', '$description')";
        // executing the sql
        mysqli_query($conn, $sql);
        // end the connection
        $conn->close();
    }

    // Check if the input field is empty or not
    if (isset($_GET['location'])) {
        $city = $_GET['location'];
        fetchThem($_GET['location']);
    } else {
        fetchThem('Paterson');
    }

    ?>
    <div id="pastweek">
        <h1><a href="./pastweek.php">Past Week Data</a></h1>
    </div>
</body>

</html>
</body>

</html>