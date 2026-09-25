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
    ('$user_id','{$item['name']}','$amount','COD','Pending',NOW(),'{$item['quantity']}','{$item['image']}','{$item['watch_id']}')
    ");
}



$_SESSION['last_order'] = [
    'items' => $items,   // 👈 THIS FIXES EVERYTHING
    'amount' => $total,
    'payment' => 'UPI'
];



unset($_SESSION['cart_checkout']);

header("Location: order_success.php");
exit;
