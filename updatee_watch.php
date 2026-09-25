<?php
session_start();
include("db.php");

if(!isset($_GET['id'])){
die("Product not found");
}

$id = $_GET['id'];

$result = mysqli_query($conn,"SELECT * FROM watches WHERE id=$id");
$watch = mysqli_fetch_assoc($result);

$msg="";

if(isset($_POST['update'])){

$name=$_POST['name'];
$price=$_POST['price'];

if(!empty($_FILES['image']['name'])){

$image=$_FILES['image']['name'];
$tmp=$_FILES['image']['tmp_name'];

$new_image=time()."_".$image;

move_uploaded_file($tmp,"uploads/".$new_image);

$sql="UPDATE watches SET name='$name',price='$price',image='$new_image' WHERE id=$id";

}else{

$sql="UPDATE watches SET name='$name',price='$price' WHERE id=$id";

}

if(mysqli_query($conn,$sql)){
header("Location:update_watch.php");
exit;
}else{
$msg="Update failed";
}

}

?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Product</title>

<style>

body{
margin:0;
font-family:Arial;
background:#f4f6f9;
}

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

.form-box{
width:420px;
background:white;
padding:25px;
border-radius:8px;
box-shadow:0 0 10px rgba(0,0,0,0.1);
}

.form-box input{
width:100%;
padding:10px;
margin-bottom:12px;
border:1px solid #ccc;
border-radius:5px;
}

.form-box button{
width:100%;
padding:12px;
background:#3742fa;
border:none;
color:white;
font-weight:bold;
border-radius:5px;
cursor:pointer;
}

.form-box img{
width:150px;
display:block;
margin:10px auto;
}

.msg{
color:red;
margin-bottom:10px;
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
<h2>Edit Product</h2>
</div>

<div class="content">

<div class="form-box">

<h3>Edit Watch</h3>

<?php if($msg!=""){ ?>
<div class="msg"><?php echo $msg; ?></div>
<?php } ?>

<form method="post" enctype="multipart/form-data">

<input type="text" name="name"
value="<?php echo $watch['name']; ?>">

<input type="number" name="price"
value="<?php echo $watch['price']; ?>">

<img src="uploads/<?php echo $watch['image']; ?>">

<input type="file" name="image">

<button name="update">Update Product</button>

</form>

</div>

</div>

</div>

</div>

</body>
</html>