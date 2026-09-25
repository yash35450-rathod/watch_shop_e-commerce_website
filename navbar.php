
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<?php
$page = basename($_SERVER['PHP_SELF']);
?>
<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* NAVBAR */
.navbar{
    width:100%;
    display:flex;
    justify-content:flex-start;
    align-items:center;
    padding:22px 60px;
    background:#000;
}

/* LOGO */
.logo{
    font-size:24px;
    font-weight:bold;
}

.logo span{
    color:#c49b63;
}

/* RIGHT MENU */
.nav-right{
    margin-left:auto;
    display:flex;
    gap:22px;
}

/* LINKS */
.nav-right a{
    color:#fff;
    text-decoration:none;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:1px;
}

.nav-right a:hover{
    color:#c49b63;
}

/* ACTIVE PAGE */
.nav-right a.active{
    color:#c49b63;
}

/* MOBILE */
@media(max-width:900px){
    .navbar{
        flex-direction:column;
    }
    .nav-right{
        margin-left:0;
        margin-top:10px;
    }
}
</style>

<header class="navbar">
    <div class="logo">Watch<span>Shop</span></div>

    <div class="nav-right">
        <a href="index.php" class="<?= $page=='index.php'?'active':'' ?>">Home</a>
        <a href="watch.php" class="<?= $page=='watch.php'?'active':'' ?>">Watch</a>
        <a href="cart.php" class="<?= $page=='cart.php'?'active':'' ?>">Cart</a>

        <?php if(isset($_SESSION['user_id'])){ ?>
            <a href="profile.php" class="<?= $page=='profile.php'?'active':'' ?>">Profile</a>
            <a href="logout.php">Logout</a>
        <?php }else{ ?>
            <a href="login.php" class="<?= $page=='login.php'?'active':'' ?>">Login</a>
            <a href="register.php" class="<?= $page=='register.php'?'active':'' ?>">Register</a>
        <?php } ?>
    </div>
</header>
