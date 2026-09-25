<?php
session_start();
include("db.php");

$data = $_SESSION['order_data'];
$user_id = $_SESSION['user_id'];

mysqli_query($conn,"
INSERT INTO orders 
(user_id,product_name,amount,payment_method,status,order_date,quantity,img,watch_id)
VALUES(
'$user_id',
'{$data['watch']['name']}',
'{$data['total']}',
'COD',
'Success',
NOW(),
'{$data['qty']}',
'{$data['watch']['image']}',
'{$data['watch']['id']}'
)
");

unset($_SESSION['order_data'],$_SESSION['single_watch']);
?>

<h1 style="color:white;text-align:center;margin-top:100px;">
✅ Order Placed Successfully (COD)
</h1>
