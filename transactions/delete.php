<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

$id = $data['id'];

mysqli_query($conn, "DELETE FROM transactions WHERE id='$id'");

echo json_encode(["status"=>"deleted"]);