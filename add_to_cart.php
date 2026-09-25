<?php
include("db.php");
include("session.php");

// Check login
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id  = $_SESSION['user_id'];

// Make sure form is submitted properly
if(!isset($_POST['watch_id'])){
    header("Location: product.php");
    exit;
}

$watch_id = intval($_POST['watch_id']);
$quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

// Check if already in cart
$check = mysqli_query($conn,
    "SELECT * FROM cart 
     WHERE user_id='$user_id' AND watch_id='$watch_id'"
);

if(mysqli_num_rows($check) > 0){
    // Increase quantity
    mysqli_query($conn,
        "UPDATE cart 
         SET quantity = quantity + $quantity
         WHERE user_id='$user_id' AND watch_id='$watch_id'"
    );
}else{
    // Insert new item
    mysqli_query($conn,
        "INSERT INTO cart (user_id, watch_id, quantity)
         VALUES ('$user_id','$watch_id','$quantity')"
    );
}

header("Location: cart.php");
exit;
?>