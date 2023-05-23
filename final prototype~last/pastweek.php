<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./oldData.css">
    <title>PAST WEEK DATA</title>
</head>

<body>
    <div class="intro">
        <h1>Past Week Data:</h1>
        <a href="./index.html">Current Data</a>
    </div>
    <div class="container-main">
        <br>
        <?php
        $servername = "localhost";
        $database = "id20714130_weather";
        $username = "id20714130_admin";
        $password = "VegaPunk#16";

        // $sql = "UPDATE weather SET `LOCATION` = 'Hello' WHERE LOCATION = 'Hanoi'";
        $conn = new mysqli($servername, $username, $password, $database);
        $sql = "SELECT * FROM `weather`";
        $result = mysqli_query($conn, $sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                if ($row["icon"]) {
                    $str = '<div class="container">';
                    $str .= '<span class="month">' . $row["day"] . '</span>';
                    $str .= '<h1>Location: ' . $row["LOCATION"] . '</h1>';
                    $str .=    '<img src="https://openweathermap.org/img/wn/' . $row["icon"] . '@2x.png" alt="icon">';
                    $str .=    '<h1 class="description">' . $row['description'] . '</h1>';
                    $str .= '<h2>Tempreture: ' . $row["TEMP"] . 'C</h2>';
                    $str .= '<h2>Humidity: ' . $row["HUMIDITY"] . '%</h2>';
                    $str .= '<h2>Wind speed: ' . $row["WIND"] . 'km/hr</h2></div>';
                    echo $str;
                }
            }
        }
        $conn->close();
        ?>

    </div>
</body>

</html>