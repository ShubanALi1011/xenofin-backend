<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");

include("../config/db.php");

$data = json_decode(file_get_contents("php://input"), true);

$username = $data['username'];
$email = $data['email'];
$password = $data['password'];

// check email
$emailCheck = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

// check username
$userCheck = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

if (mysqli_num_rows($emailCheck) > 0) {
    echo json_encode(["status"=>"error","field"=>"email","message"=>"Email already exists"]);
    exit;
}

if (mysqli_num_rows($userCheck) > 0) {
    echo json_encode(["status"=>"error","field"=>"username","message"=>"Username already taken"]);
    exit;
}

// insert
mysqli_query($conn, "INSERT INTO users (username,email,password) VALUES ('$username','$email','$password')");

echo json_encode(["status"=>"success"]);