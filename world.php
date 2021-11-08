<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

if($_SERVER['REQUEST_METHOD'] === 'GET' ){
  if((isset($_GET['country']) or !empty($_GET['country'])) ){
    $country = filter_var($_GET['country'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);;
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
?>

