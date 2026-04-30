<?php
// Railway ke environment variables read karne ke liye getenv use karen
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQL_DATABASE'); 
$port = getenv('MYSQLPORT');

// Connection string
$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    // Sirf debug ke liye error show karega
    die("Connection Failed: " . mysqli_connect_error());
}
?>
