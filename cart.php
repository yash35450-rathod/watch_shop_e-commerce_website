<?php
include("db.php");
include("session.php");
include("navbar.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
    "SELECT cart.id AS cart_id, cart.quantity,
            watches.name, watches.price, watches.image
     FROM cart
     JOIN watches ON cart.watch_id = watches.id
     WHERE cart.user_id='$user_id'"
);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Cart</title>
<style>
body{background:#000;color:#fff;font-family:Arial}
table{width:85%;margin:40px auto;border-collapse:collapse}
th,td{padding:15px;text-align:center;border-bottom:1px solid #333}
img{width:80px;border-radius:6px}
.qty a{
    padding:6px 12px;
    border:1px solid #c49b63;
    color:#c49b63;
    text-decoration:none;
    margin:0 5px;
}
.qty a:hover{
    background:#c49b63;
    color:#000;
}
.buy{
    background:#c49b63;
    color:#000;
    padding:14px 30px;
    border:none;
    cursor:pointer;
}
.remove{
    color:red;
    text-decoration:none;
    font-weight:bold;
}
.remove:hover{
    color:#fff;
}
.empty{
    text-align:center;
    margin-top:60px;
    font-size:20px;
}
</style>
</head>
<body>

<h1 align="center">Your Cart</h1>

<?php if(mysqli_num_rows($result) > 0) { ?>

<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Price</th>
    <th>Quantity</th>
    <th>Total</th>
    <th>Remove</th>
</tr>

<?php
$grand = 0;
while($row = mysqli_fetch_assoc($result)){
    $total = $row['price'] * $row['quantity'];
    $grand += $total;
?>

<tr>
    <td><img src="uploads/<?php echo $row['image']; ?>"></td>
    <td><?php echo $row['name']; ?></td>
    <td>₹<?php echo $row['price']; ?></td>

    <td class="qty">
        <a href="update_qty.php?cart_id=<?php echo $row['cart_id']; ?>&type=minus">−</a>
        <?php echo $row['quantity']; ?>
        <a href="update_qty.php?cart_id=<?php echo $row['cart_id']; ?>&type=plus">+</a>
    </td>

    <td>₹<?php echo $total; ?></td>

    <td>
        <a href="remove_from_cart.php?cart_id=<?php echo $row['cart_id']; ?>" class="remove">
            Remove
        </a>
    </td>
</tr>

<?php } ?>

<tr>
    <td colspan="4"><strong>Grand Total</strong></td>
    <td><strong>₹<?php echo $grand; ?></strong></td>
    <td></td>
</tr>

</table>

<div style="text-align:center;margin-bottom:50px;">
    <form action="checkout_cart.php" method="POST">
        <button type="submit" class="buy">BUY / CHECKOUT</button>
    </form>
</div>

<?php } else { ?>

<div class="empty">
    🛒 Your cart is empty
</div>

<?php } ?>

</body>
</html>