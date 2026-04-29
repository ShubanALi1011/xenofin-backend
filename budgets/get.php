<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

include "../config/db.php";

$user_id = $_GET['user_id'];

$sql = "
SELECT 
    b.*,

    IFNULL(
        (
            SELECT SUM(t.amount)
            FROM transactions t
            WHERE t.user_id = b.user_id
            AND t.category = b.category
            AND t.type = 'expense'
            AND DATE_FORMAT(t.date, '%Y-%m') = b.month
        ),
        0
    ) AS spent

FROM budgets b
WHERE b.user_id = '$user_id'
ORDER BY b.id DESC
";

$result = mysqli_query($conn, $sql);

$data = [];

while($row = mysqli_fetch_assoc($result)){
    $data[] = $row;
}

echo json_encode($data);
?>