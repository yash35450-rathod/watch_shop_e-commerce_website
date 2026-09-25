<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT cart.*, watches.name, watches.price, watches.image
     FROM cart
     JOIN watches ON cart.watch_id = watches.id
     WHERE cart.user_id='$user_id'"
);

$items = [];
$grand = 0;

while ($row = mysqli_fetch_assoc($result)) {
    $row['total'] = $row['price'] * $row['quantity'];
    $grand += $row['total'];
    $items[] = $row;
}

if (empty($items)) {
    header("Location: cart.php");
    exit;
}

$_SESSION['cart_checkout'] = $items;
?>

<!DOCTYPE html>
<html>
<head>
<title>Checkout</title>
<style>
body{background:#000;color:#fff;font-family:Arial}
.box{width:420px;margin:50px auto;background:#111;padding:25px;border-radius:12px}
.row{margin:6px 0;font-size:14px}
h2{text-align:center;color:#c49b63}
button{width:100%;padding:12px;background:#c49b63;border:none;margin-top:15px;font-weight:bold}
</style>
</head>
<body>

<div class="box">
<h2>Cart Checkout</h2>

<?php foreach($items as $item){ ?>
<div class="row">
<?php echo $item['name']; ?> × <?php echo $item['quantity']; ?>
</div>
<?php } ?>

<hr>
<div class="row"><b>Total: ₹<?php echo $grand; ?></b></div>

<form action="order_process_cart.php" method="POST">
    <button>Cash on Delivery</button>
</form>

<form action="upi_cart.php" method="POST">
    <button>Pay via UPI</button>
</form>

</div>
</body>
</html>
