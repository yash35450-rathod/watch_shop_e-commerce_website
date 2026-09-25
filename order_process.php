<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'], $_SESSION['single_watch'], $_POST['quantity'])) {
    header("Location: index.php");
    exit;
}

$watch    = $_SESSION['single_watch'];
$quantity = (int) $_POST['quantity'];
$total    = $watch['price'] * $quantity;

/* 🧾 Insert order (COD) */
mysqli_query($conn, "
INSERT INTO orders 
(user_id, product_name, amount, payment_method, status, order_date, quantity, img, watch_id)
VALUES (
    '{$_SESSION['user_id']}',
    '{$watch['name']}',
    '$total',
    'COD',
    'Pending',
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
    'payment'  => 'Cash on Delivery',
    'image'    => $watch['image']
];

/* 🧹 Cleanup */
unset($_SESSION['single_watch']);

/* ➡ Redirect to common success page */
header("Location: order_success.php");
exit;
