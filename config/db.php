<?php
$host = getenv('MYSQLHOST');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$db   = getenv('MYSQL_DATABASE'); 
$port = getenv('MYSQLPORT');

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die(json_encode(["status" => "error", "message" => "Database Connection Failed"]));
}
?>
