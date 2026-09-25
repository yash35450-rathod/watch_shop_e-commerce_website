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
'UPI',
'Success',
NOW(),
'{$data['qty']}',
'{$data['watch']['image']}',
'{$data['watch']['id']}'
)
");

unset($_SESSION['order_data'],$_SESSION['single_watch']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Processing</title>
<style>
body{background:#000;color:#fff;text-align:center;margin-top:150px;font-family:Arial}
.loader{
border:6px solid #333;
border-top:6px solid #c49b63;
border-radius:50%;
width:60px;height:60px;
animation:spin 1s linear infinite;
margin:auto;
}
@keyframes spin{100%{transform:rotate(360deg)}}
</style>
</head>
<body>

<div class="loader"></div>
<h2>Processing Payment…</h2>
<h3>₹<?php echo $data['total']; ?> Paid</h3>

<audio autoplay>
<source src="upi_success.mp3" type="audio/mpeg">
</audio>

<script>
setTimeout(()=>{
document.body.innerHTML="<h1>🎉 Payment Successful!</h1>";
},3000);
</script>

</body>
</html>
