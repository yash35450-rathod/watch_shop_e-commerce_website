<?php
session_start();
include("db.php");

$message = "";

if(isset($_POST['login'])){

    $phone = mysqli_real_escape_string($conn,$_POST['phone']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE phone='$phone' LIMIT 1";
    $result = mysqli_query($conn,$sql);

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password,$user['password'])){

            $_SESSION['user_id']   = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['phone']     = $user['phone'];

            header("Location: index.php");
            exit();

        }else{
            $message = "Incorrect password!";
        }

    }else{
        $message = "Phone number not registered!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login</title>

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

/* LOGIN BOX */

.login-box{
width:400px;
background:#111;
padding:35px;
border-radius:12px;
box-shadow:0 10px 40px rgba(196,155,99,0.3);
}

.login-box h2{
text-align:center;
margin-bottom:25px;
letter-spacing:2px;
}

.login-box h2 span{
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
border-radius:5px;
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
font-weight:bold;
letter-spacing:1px;
cursor:pointer;
border-radius:5px;
transition:0.3s;
}

button:hover{
background:#fff;
}

/* MESSAGE */

.msg{
text-align:center;
margin-bottom:15px;
color:#c49b63;
}

/* REGISTER */

.register-link{
text-align:center;
margin-top:15px;
font-size:13px;
}

.register-link a{
color:#c49b63;
text-decoration:none;
}

</style>

</head>

<body>

<div class="login-box">

<h2><span>Login</span> Account</h2>

<?php if($message!=""){ ?>
<div class="msg"><?php echo $message; ?></div>
<?php } ?>

<form method="POST">

<div class="input-group">
<input type="text" name="phone" placeholder="Phone Number" required>
</div>

<div class="input-group">
<input type="password" name="password" placeholder="Password" required>
</div>

<button type="submit" name="login">LOGIN</button>

</form>

<div class="register-link">
Don’t have an account? <a href="register.php">Register</a>
</div>

</div>

</body>
</html>