<?php
session_start();

if (!isset($_SESSION['cart_checkout'])) {
    header("Location: cart.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>UPI Payment</title>
<style>
body{background:#000;color:#fff;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh}
.box{background:#111;padding:30px;border-radius:12px;width:320px}
input{width:100%;padding:12px;margin-bottom:15px}
button{width:100%;padding:12px;background:#c49b63;border:none;font-weight:bold}
</style>
</head>
<body>

<div class="box">
<h2>Enter UPI ID</h2>
<form action="upi_cart_success.php" method="POST">
    <input type="text" name="upi" placeholder="example@upi" required>
    <button>Pay Now</button>
</form>
</div>

</body>
</html>
