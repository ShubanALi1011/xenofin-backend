<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include "../config/db.php";

// JSON data receive karo
$data = json_decode(file_get_contents("php://input"), true);

// Check agar data aaya bhi hai
if (!$data) {
    echo json_encode(["status" => "error", "message" => "No data received"]);
    exit;
}

// Values
$id = $data['id'];
$amount = $data['amount'];
$type = $data['type'];
$category = $data['category'];
$description = $data['description'];
$date = $data['date'];

// Query
$sql = "UPDATE transactions 
        SET amount='$amount',
            type='$type',
            category='$category',
            description='$description',
            date='$date'
        WHERE id='$id'";

// Execute
if (mysqli_query($conn, $sql)) {
    echo json_encode(["status" => "success"]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
?>