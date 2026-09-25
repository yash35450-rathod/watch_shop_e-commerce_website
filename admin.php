<?php
session_start();
include("../watch/db.php");

/* ===== GET TOTAL SALES ===== */
$sell_query = mysqli_query($conn,"SELECT SUM(quantity) as total_sell FROM orders");
$sell_data = mysqli_fetch_assoc($sell_query);
$total_sell = $sell_data['total_sell'] ?? 0;

/* ===== GET TOTAL REVENUE ===== */
$revenue_query = mysqli_query($conn,"SELECT SUM(amount) as total_revenue FROM orders");
$revenue_data = mysqli_fetch_assoc($revenue_query);
$total_revenue = $revenue_data['total_revenue'] ?? 0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>

<style>

/* ===== BODY ===== */
body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
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
transition:0.3s;
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
justify-content:space-between;
align-items:center;
padding:0 30px;
border-bottom:1px solid #ddd;
}

/* ===== CONTENT ===== */
.content{
padding:40px;
}

.dashboard-title{
font-size:28px;
margin-bottom:30px;
}

/* ===== STATS CARDS ===== */

.stats{
display:flex;
gap:20px;
margin-bottom:40px;
flex-wrap:wrap;
}

.card{
flex:1;
min-width:200px;
background:white;
padding:25px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.card h3{
margin:0;
color:#777;
font-size:16px;
}

.card p{
font-size:28px;
font-weight:bold;
margin-top:10px;
color:#3742fa;
}

/* ===== BUTTON GRID ===== */

.container{
display:flex;
flex-wrap:wrap;
gap:20px;
}

.admin-btn{
display:flex;
justify-content:center;
align-items:center;
width:200px;
height:70px;
background:#2f3542;
color:white;
text-decoration:none;
font-weight:bold;
border-radius:8px;
transition:0.3s;
}

.admin-btn:hover{
background:#3742fa;
transform:translateY(-3px);
}

.full-row{
width:420px;
}

</style>
</head>

<body>

<div class="wrapper">

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">

<h2>Admin</h2>

<a href="admin.php">Dashboard</a>
<a href="../watch/add_watch.php">Add Products</a>
<a href="../watch/update_watch.php">Update Product</a>
<a href="view_order.php">View Orders</a>
<a href="manage_users.php">Manage Users</a>

<?php if(isset($_SESSION['admin_id'])): ?>
<a href="admin_logout.php">Logout</a>
<?php endif; ?>

</div>


<!-- ===== MAIN ===== -->
<div class="main">

<div class="topbar">
<h1>Admin Panel</h1>

<nav>
<?php if(isset($_SESSION['admin_id'])): ?>
<a href="admin_profile.php"></a>
<a href="admin_logout.php">Logout</a>
<?php else: ?>
<a href="admin_login.php">Login</a>
<?php endif; ?>
</nav>

</div>


<!-- ===== CONTENT ===== -->
<div class="content">

<h2 class="dashboard-title">Dashboard</h2>

<!-- ===== SALES STATS ===== -->

<div class="stats">

<div class="card">
<h3>Total Products Sold</h3>
<p><?php echo $total_sell; ?></p>
</div>

<div class="card">
<h3>Total Revenue</h3>
<p>₹<?php echo $total_revenue; ?></p>
</div>

</div>


<!-- ===== ADMIN ACTIONS ===== -->

<div class="container">

<a href="../watch/add_watch.php" class="admin-btn">Add Products</a>

<a href="view_order.php" class="admin-btn">Orders</a>

<a href="manage_users.php" class="admin-btn">Users</a>

<a href="../watch/update_watch.php" class="admin-btn">Manage Product</a>

<?php if(isset($_SESSION['admin_id'])): ?>
<a href="admin_logout.php" class="admin-btn full-row">Logout</a>
<?php endif; ?>

</div>

</div>

</div>
</div>

</body>
</html>