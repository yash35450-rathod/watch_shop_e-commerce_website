<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'], $_SESSION['single_watch'], $_SESSION['upi_quantity'])) {
    header("Location: index.php");
    exit;
}

$watch    = $_SESSION['single_watch'];
$quantity = (int) $_SESSION['upi_quantity'];
$total    = $watch['price'] * $quantity;

/* 🧾 Insert order (UPI) */
mysqli_query($conn, "
INSERT INTO orders 
(user_id, product_name, amount, payment_method, status, order_date, quantity, img, watch_id)
VALUES (
    '{$_SESSION['user_id']}',
    '{$watch['name']}',
    '$total',
    'UPI',
    'Paid',
    NOW(),
    '$quantity',
    '{$watch['image']}',
    '{$watch['id']}'
)
");

/* 📦 Save order for success page */
$_SESSION['last_order'] = [
    'name'     => $watch['name'],
    'quantity' => $quantity,
    'amount'   => $total,
    'payment'  => 'UPI',
    'image'    => $watch['image']
];

/* 🧹 Cleanup */
unset($_SESSION['single_watch'], $_SESSION['upi_quantity']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Successful</title>

<meta http-equiv="refresh" content="3;url=order_success.php">

<style>
body{
    background:#000;
    color:#fff;
    font-family:Arial, Helvetica, sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    overflow:hidden;
}

.box{
    text-align:center;
    z-index:2;
}

.loader{
    width:60px;
    height:60px;
    border:6px solid #333;
    border-top:6px solid #c49b63;
    border-radius:50%;
    animation:spin 1s linear infinite;
    margin:20px auto;
}

@keyframes spin{
    from{transform:rotate(0deg)}
    to{transform:rotate(360deg)}
}

.confetti{
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:
        radial-gradient(circle,#c49b63 2px,transparent 2px),
        radial-gradient(circle,#fff 1px,transparent 1px);
    background-size:25px 25px;
    animation:fall 2s linear infinite;
    opacity:0.6;
}

@keyframes fall{
    from{background-position:0 0}
    to{background-position:0 120px}
}
</style>
</head>

<body>

<audio autoplay>
    <source src="sound/payment_received.mp3" type="audio/mpeg">
</audio>

<div class="confetti"></div>

<div class="box">
    <div class="loader"></div>
    <h2>Payment Successful 🎉</h2>
    <p>Amount Paid: ₹<?php echo $total; ?></p>
    <p>Redirecting to order details...</p>
</div>

</body>
</html>
