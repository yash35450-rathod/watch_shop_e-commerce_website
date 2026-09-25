<?php
session_start();
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_POST['watch_id']) && !isset($_SESSION['single_watch'])) {
    header("Location: products.php");
    exit;
}

if (isset($_POST['watch_id'])) {
    $watch_id = (int)$_POST['watch_id'];

    $result = mysqli_query($conn, "SELECT * FROM watches WHERE id=$watch_id");
    $watch = mysqli_fetch_assoc($result);

    if (!$watch) {
        header("Location: products.php");
        exit;
    }

    $_SESSION['single_watch'] = $watch;
} else {
    $watch = $_SESSION['single_watch'];
}

$quantity = 1;
$total = $watch['price'] * $quantity;
?>

<!DOCTYPE html>
<html>
<head>
<title>Buy Now</title>

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
    width:380px;
    text-align:center;
}
.box img{
    width:140px;
    height:140px;
    object-fit:cover;
    border-radius:10px;
    margin-bottom:15px;
}
.price{
    color:#c49b63;
    font-size:18px;
    margin-bottom:15px;
}
input[type=number]{
    width:80px;
    padding:8px;
    font-size:16px;
    text-align:center;
}
.total{
    margin:15px 0;
    font-size:18px;
}
button{
    width:100%;
    padding:14px;
    background:#c49b63;
    border:none;
    font-weight:bold;
    cursor:pointer;
    border-radius:6px;
    margin-top:10px;
}
button:hover{
    background:#b38952;
}
</style>
</head>

<body>

<div class="box">

    <img src="uploads/<?php echo $watch['image']; ?>">

    <h2><?php echo $watch['name']; ?></h2>

    <div class="price">
        Price: ₹<?php echo $watch['price']; ?>
    </div>

    <!-- Quantity -->
    <input type="number" id="qty" value="1" min="1">

    <div class="total">
        <strong>Total: ₹<span id="total"><?php echo $watch['price']; ?></span></strong>
    </div>

    <!-- Checkout -->
    <form action="checkout.php" method="POST">
        <input type="hidden" name="quantity" id="hiddenQty" value="1">
        <button type="submit">Continue to Checkout</button>
    </form>

</div>

<script>
// Get elements
let qtyInput = document.getElementById("qty");
let totalText = document.getElementById("total");
let hiddenQty = document.getElementById("hiddenQty");

let price = <?php echo $watch['price']; ?>;

// Auto update when quantity changes
qtyInput.addEventListener("input", function(){

    let qty = parseInt(this.value);

    if(qty < 1){
        qty = 1;
        this.value = 1;
    }

    let total = price * qty;

    totalText.innerText = total;
    hiddenQty.value = qty;
});
</script>

</body>
</html>