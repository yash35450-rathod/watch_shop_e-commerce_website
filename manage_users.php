<?php
session_start();
include("../watch/db.php");

/* ===== ADMIN LOGIN CHECK ===== */
if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit;
}

/* ===== DELETE USER ===== */
if(isset($_GET['delete_id'])){
    $delete_id = (int)$_GET['delete_id'];

    mysqli_query($conn,"DELETE FROM users WHERE id=$delete_id");

    header("Location: manage_users.php");
    exit;
}

/* ===== FETCH USERS ===== */
$result = mysqli_query($conn,"SELECT id,name,email,phone,address FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Users</title>

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

/* ===== DELETE BUTTON ===== */

.delete-btn{
background:#ff4757;
color:white;
padding:7px 12px;
text-decoration:none;
border-radius:5px;
font-size:13px;
}

.delete-btn:hover{
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
<h2>Manage Users</h2>
</div>

<div class="content">

<?php if(mysqli_num_rows($result)>0){ ?>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
<th>Phone</th>
<th>Address</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?= $row['id']; ?></td>

<td><?= $row['name']; ?></td>

<td><?= $row['email']; ?></td>

<td><?= $row['phone']; ?></td>

<td><?= $row['address']; ?></td>

<td>

<a class="delete-btn"
href="manage_users.php?delete_id=<?= $row['id']; ?>"
onclick="return confirm('Delete this user?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

<?php } else { ?>

<h3>No users found</h3>

<?php } ?>

</div>
</div>
</div>

</body>
</html>