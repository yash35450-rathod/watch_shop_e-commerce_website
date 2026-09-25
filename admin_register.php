<?php
include("db.php");
session_start();

$message = "";

if(isset($_POST['register'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm  = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    if($password !== $confirm){
        $message = "Passwords do not match!";
    } else {

        $check = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email'");

        if(mysqli_num_rows($check) > 0){
            $message = "Email already registered!";
        } else {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO admin (username,email,password,created_at)
                      VALUES ('$username','$email','$hashed',NOW())";

            if(mysqli_query($conn,$query)){
                $message = "Admin registered successfully! <br><a href='admin_login.php'></a>";
            }else{
                $message = "Error: ".mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Register</title>

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
align-items:center;
justify-content:center;
}

/* FORM BOX */

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

/* INPUT GROUP */

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

/* LINK */

.message a{
color:#c49b63;
text-decoration:none;
font-weight:bold;
}

/* Already have account link */

.already-account{
text-align:center;
margin-top:15px;
font-size:14px;
}

.already-account a{
color:#c49b63;
text-decoration:none;
font-weight:bold;
}

.already-account a:hover{
text-decoration:underline;
}

</style>

</head>

<body>

<div class="form-container">

<h2><span>Admin</span> Register</h2>

<form method="POST">

<div class="input-group">
<input type="text" name="username" placeholder="Username" required>
</div>

<div class="input-group">
<input type="email" name="email" placeholder="Email Address" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Password" required>
</div>

<div class="input-group">
<input type="password" name="confirm_password" placeholder="Confirm Password" required>
</div>

<button type="submit" name="register">Register</button>

</form>

<div class="message">
<?php echo $message; ?>
</div>

<div class="already-account">
Already have an account? <a href="admin_login.php">Login here</a>
</div>

</div>

</body>
</html>