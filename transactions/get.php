<?php
header("Access-Control-Allow-Origin: *");
include("../config/db.php");

$userId = $_GET['user_id'];

$result = mysqli_query($conn,
"SELECT * FROM transactions WHERE user_id='$userId' ORDER BY id DESC LIMIT 5"
);

$data = [];

while($row = mysqli_fetch_assoc($result)){
  $data[] = $row;
}

echo json_encode($data);