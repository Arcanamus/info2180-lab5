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
  }
}
?>

<ul>
<?php foreach ($results as $row): ?>
  <li><?= $row['name'] . ' is ruled by ' . $row['head_of_state']; ?></li>
<?php endforeach; ?>
</ul>
