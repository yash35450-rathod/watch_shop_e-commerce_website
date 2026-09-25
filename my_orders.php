<?php
include("session.php");
include("navbar.php");
include("db.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* REMOVE ORDER */
if (isset($_GET['delete'])) {
    $order_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM orders WHERE id='$order_id' AND user_id='$user_id'");
    header("Location: my_orders.php");
    exit();
}

/* FETCH ORDERS (NO DUPLICATES) */
$sql = "
    SELECT 
        o.id,
        o.product_name,
        o.quantity,
        o.amount,
        o.status,
        o.order_date,
        MAX(w.image) AS image
    FROM orders o
    JOIN watches w ON o.product_name = w.name
    WHERE o.user_id = '$user_id'
    GROUP BY o.id
    ORDER BY o.order_date DESC
";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>My Orders</title>

<style>
body{
    background:#000;
    color:#fff;
    font-family:Arial;
}

h1{
    text-align:center;
    margin-top:30px;
}

table{
    width:90%;
    margin:40px auto;
    border-collapse:collapse;
}

th, td{
    padding:12px;
    border:1px solid #fff;
    text-align:center;
}

th{
    background:#1E90FF;
}

td{
    background:#333;
}

img{
    width:70px;
    border-radius:8px;
}

.remove-btn{
    color:red;
    text-decoration:none;
    font-weight:bold;
}

.remove-btn:hover{
    text-decoration:underline;
}
</style>
</head>

<body>

<h1>My Orders</h1>

<table>
<tr>
    <th>Order ID</th>
    <th>Image</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Total Amount (INR)</th>
    <th>Status</th>
    <th>Order Date</th>
    <th>Action</th>
</tr>

<?php
if(mysqli_num_rows($result) > 0){
    while($row = mysqli_fetch_assoc($result)){

        $image = !empty($row['image']) 
                 ? "uploads/".$row['image'] 
                 : "uploads/no-image.png";

        echo "<tr>
            <td>{$row['id']}</td>

            <td>
                <img src='{$image}' alt='Watch'>
            </td>

            <td>{$row['product_name']}</td>

            <td>{$row['quantity']}</td>

            <td>₹{$row['amount']}</td>

            <td>{$row['status']}</td>

            <td>{$row['order_date']}</td>

            <td>
                <a class='remove-btn'
                   href='my_orders.php?delete={$row['id']}'
                   onclick=\"return confirm('Are you sure you want to remove this order?')\">
                   Remove
                </a>
            </td>
        </tr>";
    }
}else{
    echo "<tr><td colspan='8'>No orders found</td></tr>";
}
?>

</table>

</body>
</html>
