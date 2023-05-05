<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAST WEEK DATA</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto&display=swap');

        body {
            font-family: Roboto;
            place-items: center;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <h1>Past Week Data:</h1>

    <br>
    <?php
    $servername = "localhost";
    $database = "weather";
    $username = "root";
    $password = "";

    // $sql = "UPDATE weather SET `LOCATION` = 'Hello' WHERE LOCATION = 'Hanoi'";
    $conn = new mysqli($servername, $username, $password, $database);
    $sql = "SELECT * FROM `weather`";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        // output data of each row
        while ($row = $result->fetch_assoc()) {
            if ($row["icon"]) {
                $str = '<div class="container">';
                $str .= '<h1>Location: ' . $row["LOCATION"] . '</h1>';
                $str .=    '<img src="https://openweathermap.org/img/wn/' . $row["icon"] . '@2x.png" alt="icon">';
                $str .=    '<h1 class="description">' . $row['description'] . '</h1>';
                $str .= '<h2>Tempreture: ' . $row["TEMP"] . 'C</h2>';
                $str .= '<h2>Humidity: ' . $row["HUMIDITY"] . '%</h2>';
                $str .= '<h2>Wind speed: ' . $row["WIND"] . 'km/hr</h2></div><hr>';
                echo $str;
            }
        }
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>
    <button><a href="./index.php">Current</a></button>
</body>

</html>