<?php
include("db.php");
include("session.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['cart_id'])){

    $cart_id = $_GET['cart_id'];

    mysqli_query($conn,
        "DELETE FROM cart
         WHERE id='$cart_id'
         AND user_id='$user_id'"
    );
}

header("Location: cart.php");
exit;
?>