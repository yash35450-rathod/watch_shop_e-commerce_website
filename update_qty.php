<?php
include("db.php");
include("session.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

if(isset($_GET['cart_id']) && isset($_GET['type'])){

    $cart_id = $_GET['cart_id'];
    $type = $_GET['type'];

    $check = mysqli_query($conn,
        "SELECT quantity FROM cart
         WHERE id='$cart_id'
         AND user_id='$user_id'"
    );

    if(mysqli_num_rows($check) > 0){

        $row = mysqli_fetch_assoc($check);
        $qty = $row['quantity'];

        if($type == "plus"){
            mysqli_query($conn,
                "UPDATE cart
                 SET quantity = quantity + 1
                 WHERE id='$cart_id'
                 AND user_id='$user_id'"
            );
        }

        if($type == "minus"){
            if($qty > 1){
                mysqli_query($conn,
                    "UPDATE cart
                     SET quantity = quantity - 1
                     WHERE id='$cart_id'
                     AND user_id='$user_id'"
                );
            } else {
                mysqli_query($conn,
                    "DELETE FROM cart
                     WHERE id='$cart_id'
                     AND user_id='$user_id'"
                );
            }
        }
    }
}

header("Location: cart.php");
exit;
?>