<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Content-Type: application/json");

include "../config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    exit(0);
}

// RAW input
$json = file_get_contents("php://input");

// Decode JSON
$data = json_decode($json, true);

// Debug if empty
if (!$data) {
    echo json_encode([
        "status" => "error",
        "message" => "JSON not received",
        "raw" => $json
    ]);
    exit;
}

// Receive values safely
$user_id = isset($data["user_id"]) ? $data["user_id"] : 0;
$category = isset($data["category"]) ? $data["category"] : "";
$amount = isset($data["amount"]) ? $data["amount"] : 0;
$month = isset($data["month"]) ? $data["month"] : "";

// Validation
if ($user_id == 0 || $category == "" || $amount == 0 || $month == "") {
    echo json_encode([
        "status" => "error",
        "message" => "Missing fields",
        "data" => $data
    ]);
    exit;
}

// Insert
$sql = "INSERT INTO budgets (user_id, category, amount, month)
VALUES ('$user_id','$category','$amount','$month')";

if (mysqli_query($conn, $sql)) {
    echo json_encode([
        "status" => "success"
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => mysqli_error($conn)
    ]);
}
?>