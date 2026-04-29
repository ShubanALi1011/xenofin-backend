<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data['user_id'];
$amount = $data['amount'];
$type = $data['type'];
$category = $data['category'];
$description = $data['description'];
$date = $data['date'];

mysqli_query($conn, "INSERT INTO transactions 
(user_id, amount, type, category, description, date)
VALUES ('$user_id','$amount','$type','$category','$description','$date')");

echo json_encode(["status"=>"success"]);