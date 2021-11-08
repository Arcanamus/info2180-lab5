<?php
    $host = 'localhost';
    $username = 'lab5_user';
    $password = 'password123';
    $dbname = 'world';

    if($_SERVER['REQUEST_METHOD'] === 'GET' ){
        if(empty($_GET['context']) and (isset($_GET['country']) or !empty($_GET['country'])) ){
        $country = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $stmt = $conn->query("SELECT * FROM countries WHERE name LIKE '%$country%'");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>";
        echo "<tr>";
        echo "<th>Country Name</th>";
        echo "<th>Continent</th>";
        echo "<th>Independence Year</th>";
        echo "<th>Head of State</th>";
        echo "</tr>";
        foreach($results as $row) {
            $countryName = $row['name'];
            $continent = $row['continent'];
            $independenceYear = $row['independence_year'];
            $headOfState = $row['head_of_state'];
            echo "<tr>";
            echo "<td>$countryName</td>";
            echo "<td>$continent</td>";
            echo "<td>$independenceYear</td>";
            echo "<td>$headOfState</td>";
            echo "</tr>";
        }
        echo "</table>";
        }
    }

    if ((isset($_GET['context']) or !empty($_GET['context']))) {
        $country = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $stmt = $conn->query("SELECT cities.name, cities.district,cities.population
                         FROM countries LEFT JOIN cities ON countries.code = cities.country_code
                         WHERE countries.name LIKE '%$country%'");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<table>";
        echo "<tr>";
        echo "<th>Name</th>";
        echo "<th>District</th>";
        echo "<th>Population</th>";
        echo "</tr>";
        foreach($results as $row) {
            $city = $row['name'];
            $district = $row['district'];
            $population = $row['population'];
            echo "<tr>";
            echo "<td>$city</td>";
            echo "<td>$district</td>";
            echo "<td>$population</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
?>

