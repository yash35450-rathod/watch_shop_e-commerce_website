<?php
include("navbar.php");
include("db.php");

$result = mysqli_query($conn, "SELECT * FROM watches");
?>

<!DOCTYPE html>
<html>
<head>
<title>Our Watches</title>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial, Helvetica, sans-serif;}
body{background:#000;color:#fff;overflow-x:hidden;}
h1{text-align:center;margin:40px 0 10px;font-size:42px;}
.container{width:100%;padding:40px 60px;display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:30px;}
.card{background:#111;border-radius:12px;padding:20px;text-align:center;transition:0.3s ease;}
.card:hover{transform:translateY(-8px);box-shadow:0 10px 30px rgba(196,155,99,0.25);}
.card img{width:100%;height:220px;object-fit:cover;border-radius:10px;margin-bottom:15px;}
.card h3{font-size:18px;margin-bottom:8px;}
.price{color:#c49b63;font-size:16px;margin-bottom:15px;}
.actions{display:flex;justify-content:center;gap:10px;flex-wrap: wrap;}
.actions button{padding:5px 10px;border:none;border-radius:4px;font-weight:bold;cursor:pointer;}
.buy{background:#c49b63;color:#000;}
.buy:hover{background:#fff;}
.cart{background:#000;border:1px solid #c49b63;color:#c49b63;}
.cart:hover{background:#c49b63;color:#000;}
@media(max-width:900px){.container{padding:20px;}h1{font-size:32px;}}
</style>
</head>
<body>

<h1>Our Watches</h1>
<div class="container">
<?php while($row = mysqli_fetch_assoc($result)) { ?>
    <div class="card">
        <img src="uploads/<?php echo $row['image']; ?>">
        <h3><?php echo $row['name']; ?></h3>
        <p class="price">₹<?php echo $row['price']; ?></p>

        <!-- BUY NOW (POST to buy.php) -->
        <form action="buy.php" method="POST" class="actions">
            <input type="hidden" name="watch_id" value="<?php echo $row['id']; ?>">
            <button type="submit" class="buy">BUY NOW</button>
        </form>

        <!-- ADD TO CART -->
        <form action="add_to_cart.php" method="POST" class="actions">
            <input type="hidden" name="watch_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="quantity" value="1">
            <button type="submit" class="cart">ADD TO CART</button>
        </form>
    </div>
<?php } ?>
</div>
</body>
</html>
