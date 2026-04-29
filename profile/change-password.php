<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");

include "../config/db.php";

$data = json_decode(file_get_contents("php://input"), true);

$user_id = $data["user_id"];
$old_password = $data["old_password"];
$new_password = $data["new_password"];

// Check old password
$check = mysqli_query($conn, "SELECT * FROM users WHERE id='$user_id' AND password='$old_password'");

if(mysqli_num_rows($check) == 0){
    echo json_encode([
        "status" => "error",
        "message" => "Old password is incorrect"
    ]);
    exit();
}

// Update password
$update = mysqli_query($conn, "UPDATE users SET password='$new_password' WHERE id='$user_id'");

if($update){
    echo json_encode([
        "status" => "success",
        "message" => "Password updated"
    ]);
}else{
    echo json_encode([
        "status" => "error",
        "message" => "Update failed"
    ]);
}
?>