<?php
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQL_DATABASE'); 
$port = getenv('MYSQLPORT');

// Connection string with explicit variables
$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
