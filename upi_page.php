<?php
session_start();

if (!isset($_SESSION['user_id'], $_SESSION['single_watch'], $_POST['quantity'])) {
    header("Location: index.php");
    exit;
}

$_SESSION['upi_quantity'] = (int)$_POST['quantity'];
?>

<!DOCTYPE html>
<html>
<head>
<title>UPI Payment</title>
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
    width:320px;
}
input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:6px;
    border:none;
}
button{
    width:100%;
    padding:12px;
    background:#c49b63;
    border:none;
    font-weight:bold;
}
</style>
</head>

<body>
<div class="box">
<h2>Enter UPI ID</h2>

<form action="upi_success.php" method="POST">
    <input type="text" name="upi_id" placeholder="example@upi" required>
    <button type="submit">Pay Now</button>
</form>

</div>
</body>
</html>
