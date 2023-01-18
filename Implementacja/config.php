<?php
//  connect PHP to MYSQL Database:
$host = 'localhost';
$user = 'root';
$pass = '';
$db_name = 'db';

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db_name);

// Check connection
if (!$conn) {
  die("Nie można połączyć się z bazą danych: " . mysqli_connect_error());
}
?>

