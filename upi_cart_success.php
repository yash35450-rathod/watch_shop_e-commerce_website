<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'], $_SESSION['cart_checkout'])) {
    header("Location: index.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$items = $_SESSION['cart_checkout'];
$total = 0;

foreach ($items as $item) {
    $amount = $item['price'] * $item['quantity'];
    $total += $amount;

    mysqli_query($conn,"
    INSERT INTO orders
    (user_id, product_name, amount, payment_method, status, order_date, quantity, img, watch_id)
    VALUES
    ('$user_id','{$item['name']}','$amount','UPI','Paid',NOW(),'{$item['quantity']}','{$item['image']}','{$item['watch_id']}')
    ");
}

/* clear cart */


$_SESSION['last_order'] = [
    'items' => $items,   // 👈 THIS FIXES EVERYTHING
    'amount' => $total,
    'payment' => 'UPI'
];


unset($_SESSION['cart_checkout']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Payment Success</title>
<meta http-equiv="refresh" content="3;url=order_success.php">
<style>
body{background:#000;color:#fff;font-family:Arial;display:flex;justify-content:center;align-items:center;height:100vh}
.loader{border:6px solid #333;border-top:6px solid #c49b63;border-radius:50%;width:60px;height:60px;animation:spin 1s linear infinite}
@keyframes spin{to{transform:rotate(360deg)}}
</style>
</head>
<body>

<audio autoplay>
<source src="sound/payment_received.mp3" type="audio/mpeg">
</audio>

<div>
<div class="loader"></div>
<h2>Payment Successful 🎉</h2>
<p>Amount Paid ₹<?php echo $total; ?></p>
</div>

</body>
</html>
