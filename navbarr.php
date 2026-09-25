
<style>
     /* ===== NAVBAR ===== */
header{
    position:relative;
    display:flex;
    align-items:center;
    padding:25px 60px;
    background:#000;
    border-bottom:1px solid #222;
}

/* logo left */
.logo{
    font-size:22px;
    font-weight:bold;
    color:#fff;
}

.logo span{
    color:#c49b63;
}

/* nav centered */
nav{
    position:absolute;
    left:50%;
    transform:translateX(-50%);
}

nav a{
    color:#fff;
    text-decoration:none;
    margin:0 25px;
    font-size:14px;
    letter-spacing:1px;
}

nav a.active,
nav a:hover{
    color:#c49b63;
}

/* phone right */
.phone{
    margin-left:auto;
    font-size:14px;
    color:#fff;
}

/* responsive */
@media(max-width:900px){
    header{
        flex-direction:column;
        gap:15px;
    }

    nav{
        position:static;
        transform:none;
    }

    .phone{
        margin-left:0;
    }
}

    </style>
<header>
    <div class="logo">ADMIN<span>site</span></div>

    <nav>
        <a href="add_watch.php" class="<?= ($page=='add_watch.php')?'active':'' ?>">
            ADD WATCH
        </a>
        <a href="update_watch.php" class="<?= ($page=='update_watch.php')?'active':'' ?>">
            UPDATE WATCH
        </a>
         <a href="../admin/admin.php" class="<?= ($page=='../admin/admin.php')?'active':'' ?>">
            ADMIN
        </a>
    </nav>


</header>
