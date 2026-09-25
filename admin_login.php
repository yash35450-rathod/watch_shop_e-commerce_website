<?php
include("db.php");
session_start();

$message = "";

if(isset($_POST['login'])){

$email = mysqli_real_escape_string($conn,$_POST['email']);
$password = mysqli_real_escape_string($conn,$_POST['password']);

$query = mysqli_query($conn,"SELECT * FROM admin WHERE email='$email'");

if(mysqli_num_rows($query) > 0){

$admin = mysqli_fetch_assoc($query);

if(password_verify($password,$admin['password'])){

$_SESSION['admin_id'] = $admin['id'];
$_SESSION['admin_username'] = $admin['username'];

header("Location: admin.php");
exit;

}else{

$message = "Incorrect password!";

}

}else{

$message = "Email not registered!";

}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>

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
height:100vh;
display:flex;
justify-content:center;
align-items:center;
}

/* LOGIN CARD */

.form-container{
width:380px;
background:#111;
padding:35px;
border-radius:12px;
box-shadow:0 10px 40px rgba(196,155,99,0.35);
}

/* TITLE */

h2{
text-align:center;
margin-bottom:25px;
letter-spacing:2px;
}

h2 span{
color:#c49b63;
}

/* INPUT */

.input-group{
margin-bottom:15px;
}

.input-group input{
width:100%;
padding:12px;
background:#000;
border:1px solid #333;
color:#fff;
border-radius:6px;
outline:none;
}

.input-group input:focus{
border-color:#c49b63;
}

/* BUTTON */

button{
width:100%;
padding:12px;
background:#c49b63;
color:#000;
border:none;
border-radius:6px;
font-weight:bold;
cursor:pointer;
letter-spacing:1px;
transition:0.3s;
}

button:hover{
background:#fff;
}

/* MESSAGE */

.message{
margin-top:15px;
text-align:center;
color:#c49b63;
font-size:14px;
}

/* REGISTER LINK */

.register{
text-align:center;
margin-top:15px;
font-size:14px;
}

.register a{
color:#c49b63;
text-decoration:none;
font-weight:bold;
}

</style>

</head>

<body>

<div class="form-container">

<h2><span>Admin</span> Login</h2>

<form method="POST">

<div class="input-group">
<input type="email" name="email" placeholder="Email Address" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Password" required>
</div>

<button type="submit" name="login">Login</button>

</form>

<div class="message">
<?php echo $message; ?>
</div>

<div class="register">
Don't have an account? <a href="admin_register.php">Register</a>
</div>

</div>

</body>
</html>