<?php
session_start();
include("db.php");
include("navbar.php");

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$id = $_SESSION['user_id'];

$query = "SELECT id,name,email,phone,address FROM users WHERE id='$id'";
$result = mysqli_query($conn,$query);

if(mysqli_num_rows($result) > 0){
    $user = mysqli_fetch_assoc($result);
}else{
    echo "User not found";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>My Profile</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Arial, Helvetica, sans-serif;
}

body{
background:#000;
color:#fff;
}

/* PROFILE PAGE AREA */

.profile-container{
min-height:80vh;
display:flex;
justify-content:center;
align-items:center;
padding:40px;
}

/* PROFILE CARD */

.profile-card{
width:420px;
background:#111;
padding:35px;
border-radius:12px;
box-shadow:0 10px 40px rgba(196,155,99,0.35);
text-align:center;
}

/* PROFILE TITLE */

.profile-card h2{
margin-bottom:25px;
letter-spacing:2px;
}

.profile-card h2 span{
color:#c49b63;
}

/* PROFILE ICON */

.profile-icon{
width:80px;
height:80px;
border-radius:50%;
background:#c49b63;
display:flex;
align-items:center;
justify-content:center;
margin:0 auto 20px;
font-size:32px;
font-weight:bold;
color:#000;
}

/* USER INFORMATION */

.info{
text-align:left;
margin-top:15px;
}

.info p{
padding:12px 0;
border-bottom:1px solid #222;
font-size:15px;
}

.info b{
color:#c49b63;
}

/* BUTTON LINKS */

.links{
margin-top:25px;
}

.links a{
display:inline-block;
padding:10px 20px;
margin:5px;
background:#c49b63;
color:#000;
text-decoration:none;
border-radius:6px;
font-weight:bold;
transition:0.3s;
}

.links a:hover{
background:#fff;
}

</style>

</head>

<body>

<div class="profile-container">

<div class="profile-card">

<div class="profile-icon">
<?php echo strtoupper(substr($user['name'],0,1)); ?>
</div>

<h2><span>My</span> Profile</h2>

<div class="info">
<p><b>Name:</b> <?php echo $user['name']; ?></p>
<p><b>Email:</b> <?php echo $user['email']; ?></p>
<p><b>Phone:</b> <?php echo $user['phone']; ?></p>
<p><b>Address:</b> <?php echo $user['address']; ?></p>
</div>

<div class="links">
<a href="my_orders.php">My Orders</a>
<a href="logout.php">Logout</a>
</div>

</div>

</div>

</body>
</html>