<?php

header("Access-Control-Allow-Origin: *");
include("../config/db.php");

$userId = $_GET['user_id'];

// Income
$income = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(amount) as total FROM transactions WHERE user_id='$userId' AND type='income'"
))['total'] ?? 0;

// Expense
$expense = mysqli_fetch_assoc(mysqli_query($conn,
"SELECT SUM(amount) as total FROM transactions WHERE user_id='$userId' AND type='expense'"
))['total'] ?? 0;

$balance = $income - $expense;

// Recent transactions
$result = mysqli_query($conn,
"SELECT category, amount, type FROM transactions WHERE user_id='$userId' ORDER BY id DESC LIMIT 5"
);

$transactions = [];

while($row = mysqli_fetch_assoc($result)){
  $transactions[] = $row;
}

echo json_encode([
  "income"=>$income,
  "expense"=>$expense,
  "balance"=>$balance,
  "transactions"=>$transactions
]);