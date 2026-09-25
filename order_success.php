<?php
session_start();

if (!isset($_SESSION['last_order'])) {
    header("Location: index.php");
    exit;
}

$order = $_SESSION['last_order'];
unset($_SESSION['last_order']);

/* Detect type */
$is_cart = isset($order['items']);
?>

<!DOCTYPE html>
<html>
<head>
<title>Order Successful</title>

<style>
body{
    background:#000;
    color:#fff;
    font-family:Arial, Helvetica, sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    background:#111;
    padding:30px;
    border-radius:14px;
    width:420px;
    text-align:center;
}

.box img{
    width:100px;
    height:100px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:10px;
}

h2{
    color:#c49b63;
    margin-bottom:15px;
}

.row{
    margin:6px 0;
    font-size:14px;
}

hr{border:1px solid #333;margin:12px 0}

.btn{
    display:inline-block;
    margin-top:20px;
    padding:12px 20px;
    background:#c49b63;
    color:#000;
    text-decoration:none;
    font-weight:bold;
    border-radius:6px;
}
</style>
</head>

<body>

<div class="box">
<h2>Order Successful ✅</h2>

<?php if (!$is_cart) { ?>
    <!-- 🔹 SINGLE PRODUCT ORDER -->

    <img src="uploads/<?php echo $order['image']; ?>">

    <div class="row"><b>Product:</b> <?php echo $order['name']; ?></div>
    <div class="row"><b>Quantity:</b> <?php echo $order['quantity']; ?></div>

<?php } else { ?>
    <!-- 🔹 CART ORDER -->

    <?php foreach ($order['items'] as $item) { ?>
        <div class="row">
            <?php echo $item['name']; ?> × <?php echo $item['quantity']; ?>
        </div>
    <?php } ?>

<?php } ?>

<hr>

<div class="row"><b>Payment:</b> <?php echo $order['payment']; ?></div>
<div class="row"><b>Total Amount:</b> ₹<?php echo $order['amount']; ?></div>

<a href="watch.php" class="btn">Continue Shopping</a>
</div>

</body>
</html>
