<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'], $_SESSION['single_watch'], $_POST['quantity'])) {
    header("Location: index.php");
    exit;
}

$watch = $_SESSION['single_watch'];
$quantity = (int)$_POST['quantity'];
$total = $watch['price'] * $quantity;
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<style>
body{
    background:#000;
    color:#fff;
    font-family:Arial;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}
.box{
    background:#111;
    padding:30px;
    border-radius:12px;
    width:360px;
}
img{width:100%;border-radius:10px;margin-bottom:15px}
h2{text-align:center;color:#c49b63}
.row{margin:8px 0}
button{
    width:100%;
    padding:12px;
    background:#c49b63;
    border:none;
    margin-top:15px;
    font-weight:bold;
    cursor:pointer;
}
label{display:block;margin:8px 0}
</style>
</head>

<body>
<div class="box">

<img src="uploads/<?php echo $watch['image']; ?>">

<h2>Checkout</h2>

<div class="row">Product: <b><?php echo $watch['name']; ?></b></div>
<div class="row">Quantity: <?php echo $quantity; ?></div>
<div class="row"><b>Total: ₹<?php echo $total; ?></b></div>

<form action="order_process.php" method="POST">
    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
    <input type="hidden" name="payment_method" value="cod">

    <button type="submit">Cash on Delivery</button>
</form>

<form action="upi_page.php" method="POST">
    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
    <button type="submit">Pay via UPI</button>
</form>

</div>
</body>
</html>
