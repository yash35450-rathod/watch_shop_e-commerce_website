<?php
include("db.php");
session_start();

/* ===== ADMIN CHECK ===== */
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit;
}

/* ===== DELETE ORDER ===== */
if(isset($_GET['delete'])){

    $delete_id = $_GET['delete'];

    mysqli_query($conn,"DELETE FROM orders WHERE id='$delete_id'");

    header("Location:view_order.php");
    exit;
}

/* ===== FETCH ORDERS ===== */
$result = mysqli_query($conn, "SELECT * FROM orders ORDER BY id DESC");

?>

<!DOCTYPE html>
<html>
<head>
<title>View Orders</title>

<style>

/* ===== BODY ===== */

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

/* ===== LAYOUT ===== */

.wrapper{
display:flex;
height:100vh;
}

/* ===== SIDEBAR ===== */

.sidebar{
width:220px;
background:#2f3542;
color:white;
padding-top:20px;
}

.sidebar h2{
text-align:center;
margin-bottom:30px;
}

.sidebar a{
display:block;
padding:15px 25px;
color:white;
text-decoration:none;
}

.sidebar a:hover{
background:#57606f;
}

/* ===== MAIN ===== */

.main{
flex:1;
display:flex;
flex-direction:column;
}

/* ===== TOPBAR ===== */

.topbar{
height:60px;
background:white;
display:flex;
align-items:center;
padding:0 30px;
border-bottom:1px solid #ddd;
}

.topbar h2{
margin:0;
}

/* ===== CONTENT ===== */

.content{
padding:40px;
overflow:auto;
}

/* ===== TABLE ===== */

table{
width:100%;
border-collapse:collapse;
background:white;
border-radius:8px;
overflow:hidden;
box-shadow:0 0 8px rgba(0,0,0,0.1);
}

th,td{
padding:12px 15px;
text-align:center;
border-bottom:1px solid #eee;
}

th{
background:#2f3542;
color:white;
}

tr:hover{
background:#f1f2f6;
}

/* ===== IMAGE ===== */

img{
border-radius:6px;
}

/* ===== REMOVE BUTTON ===== */

.remove-btn{
background:#ff4757;
color:white;
padding:7px 12px;
text-decoration:none;
border-radius:5px;
font-size:13px;
}

.remove-btn:hover{
background:#ff6b81;
}

</style>

</head>

<body>

<div class="wrapper">

<!-- ===== SIDEBAR ===== -->

<div class="sidebar">

<h2>Admin</h2>

<a href="admin.php">Dashboard</a>
<a href="../watch/add_watch.php">Add Product</a>
<a href="../watch/update_watch.php">Manage Products</a>
<a href="view_order.php">Orders</a>
<a href="manage_users.php">Users</a>
<a href="admin_logout.php">Logout</a>

</div>


<!-- ===== MAIN ===== -->

<div class="main">

<div class="topbar">
<h2>All Orders</h2>
</div>

<div class="content">

<table>

<tr>
<th>ID</th>
<th>User ID</th>
<th>Product</th>
<th>Amount</th>
<th>Payment</th>
<th>Status</th>
<th>Date</th>
<th>Qty</th>
<th>Image</th>
<th>Action</th>
</tr>

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['user_id']; ?></td>

<td><?= $row['product_name']; ?></td>

<td>₹<?= $row['amount']; ?></td>

<td><?= $row['payment_method']; ?></td>

<td><?= $row['status']; ?></td>

<td><?= $row['order_date']; ?></td>

<td><?= $row['quantity']; ?></td>

<td>
<img src="../watch/uploads/<?= $row['img']; ?>" width="60">
</td>

<td>

<a class="remove-btn"
href="view_order.php?delete=<?= $row['id']; ?>"
onclick="return confirm('Are you sure you want to remove this order?')">
Remove
</a>

</td>

</tr>

<?php } ?>

</table>

</div>
</div>
</div>

</body>
</html>