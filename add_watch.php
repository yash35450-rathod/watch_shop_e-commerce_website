<?php
session_start();
include("db.php");

$message = "";

if (isset($_POST['add_product'])) {

    $name   = $_POST['name'];
    $price  = $_POST['price'];
    $description = $_POST['description'];

    $image_name = $_FILES['image']['name'];
    $tmp_name   = $_FILES['image']['tmp_name'];

    $new_image = time() . "_" . $image_name;
    move_uploaded_file($tmp_name, "uploads/" . $new_image);

    $sql = "INSERT INTO watches (name, price, image, description)
            VALUES ('$name', '$price', '$new_image', '$description')";

    if (mysqli_query($conn, $sql)) {
        $message = "Product added successfully!";
    } else {
        $message = "Something went wrong!";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Add Product</title>

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
justify-content:space-between;
align-items:center;
padding:0 30px;
border-bottom:1px solid #ddd;
}

.topbar h1{
font-size:20px;
margin:0;
}

/* ===== CONTENT ===== */
.content{
padding:40px;
}

/* ===== FORM ===== */
.add-watch{
width:420px;
background:white;
padding:25px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.add-watch h2{
margin-bottom:20px;
}

.add-watch input,
.add-watch textarea{
width:100%;
padding:10px;
margin-bottom:12px;
border:1px solid #ccc;
border-radius:5px;
}

.add-watch textarea{
height:90px;
resize:none;
}

.add-watch button{
width:100%;
padding:12px;
background:#3742fa;
border:none;
color:white;
font-weight:bold;
border-radius:5px;
cursor:pointer;
}

.add-watch button:hover{
background:#2f35d0;
}

.msg{
margin-bottom:10px;
color:green;
}

</style>
</head>

<body>

<div class="wrapper">

<!-- ===== SIDEBAR ===== -->
<div class="sidebar">

<h2>Admin</h2>

<a href="../admin/admin.php">Dashboard</a>
<a href="add_watch.php">Add Product</a>
<a href="update_watch.php">Manage Product</a>
<a href="../admin/view_order.php">Orders</a>
<a href="../admin/manage_users.php">Users</a>
<a href="../admin/admin_logout.php">Logout</a>

</div>

<!-- ===== MAIN ===== -->
<div class="main">

<div class="topbar">
<h1>Add Product</h1>
</div>

<div class="content">

<div class="add-watch">

<h2>Add Watch</h2>

<?php if ($message != "") { ?>
<div class="msg"><?php echo $message; ?></div>
<?php } ?>

<form method="post" enctype="multipart/form-data">

<input type="text" name="name" placeholder="Watch Name" required>

<input type="number" name="price" placeholder="Price" required>

<input type="file" name="image" required>

<textarea name="description" placeholder="Watch description" required></textarea>

<button type="submit" name="add_product">Add Product</button>

</form>

</div>

</div>

</div>

</div>
<script> console.log("10+10"); </script>

</body>
</html>