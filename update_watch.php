<?php
session_start();
include("db.php");

$result = mysqli_query($conn,"SELECT * FROM watches");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Products</title>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

/* Layout */

.wrapper{
display:flex;
height:100vh;
}

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

.main{
flex:1;
display:flex;
flex-direction:column;
}

.topbar{
height:60px;
background:white;
display:flex;
align-items:center;
padding:0 30px;
border-bottom:1px solid #ddd;
}

.content{
padding:40px;
}

/* Product Cards */

.container{
display:grid;
grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
gap:25px;
}

.card{
background:white;
padding:20px;
border-radius:8px;
box-shadow:0 0 8px rgba(0,0,0,0.1);
text-align:center;
}

.card img{
width:100%;
height:180px;
object-fit:cover;
border-radius:6px;
}

.price{
color:#3742fa;
font-weight:bold;
margin:10px 0;
}

.actions{
margin-top:15px;
display:flex;
justify-content:space-between;
}

.actions a{
padding:8px 12px;
text-decoration:none;
border-radius:5px;
font-size:13px;
}

.edit{
background:#2ed573;
color:white;
}

.delete{
background:#ff4757;
color:white;
}

</style>
</head>

<body>

<div class="wrapper">

<div class="sidebar">
<h2>Admin</h2>

<a href="../admin/admin.php">Dashboard</a>
<a href="add_watch.php">Add Product</a>
<a href="update_watch.php">Manage Products</a>
<a href="../admin/view_order.php">Orders</a>
<a href="../admin/manage_users.php">Users</a>
<a href="../admin/admin_logout.php">Logout</a>

</div>

<div class="main">

<div class="topbar">
<h2>Manage Products</h2>
</div>

<div class="content">

<div class="container">

<?php while($row = mysqli_fetch_assoc($result)){ ?>

<div class="card">

<img src="uploads/<?php echo $row['image']; ?>">

<h3><?php echo $row['name']; ?></h3>

<p class="price">₹<?php echo $row['price']; ?></p>

<div class="actions">

<a class="edit"
href="updatee_watch.php?id=<?php echo $row['id']; ?>">
Edit
</a>

<a class="delete"
href="delete_watch.php?id=<?php echo $row['id']; ?>"
onclick="return confirm('Delete this product?')">
Delete
</a>

</div>

</div>

<?php } ?>

</div>

</div>

</div>

</div>

</body>
</html>