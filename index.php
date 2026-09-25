<?php
// index.php (PHP used only as entry file)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Custom Watches</title>
    <style>
    /* ===== GLOBAL RESET ===== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
}

/* ===== BODY ===== */
body {
    background-color: #000;
    color: #fff;
    overflow-x: hidden; /* prevent horizontal scroll */
}

/* ===== HEADER / NAVBAR ===== */
header {
    width: 100%;
    background-color: #111; /* dark background */
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    position: fixed;   /* stays on top */
    top: 0;
    left: 0;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0,0,0,0.5);
}

.logo {
    font-size: 22px;
    font-weight: bold;
}

.logo span {
    color: #c49b63;
}

nav {
    display: flex;
    gap: 25px;
}

nav a {
    color: #fff;
    text-decoration: none;
    font-size: 14px;
    letter-spacing: 1px;
    padding: 8px 12px;
    transition: 0.3s;
}

nav a:hover,
nav a.active {
    color: #000;
    background-color: #c49b63;
    border-radius: 5px;
}

/* ===== HERO SECTION ===== */
.hero {
    width: 100%;
    min-height: 45vh;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 120px 50px 20px 50px; /* top padding pushes hero below navbar */
    overflow: hidden;
}

.hero-text {
    max-width: 60%;
}

.hero-text h1 {
    font-size: 80px;
    line-height: 1.1;
    margin-bottom: 20px;
    color: #ffffff;
}

/* ===== HERO BUTTONS ===== */
.buttons a {
    display: inline-block;
    padding: 10px 15px;
    border: 1px solid #925608;
    color: #925608;
    text-decoration: none;
    margin-right: 8px;
    font-size: 8px;
    letter-spacing: 1px;
    transition: 0.3s ease;
    border-radius: 1px;
}

.buttons a:hover {
    background-color: #c49b63;
    color: #000;
}

/* ===== HERO IMAGE ===== */
.hero-image {
    max-width: 40%;
}

.hero-image img {
    width: 100%;
    max-width: 100%;
    height: auto;
    display: block;
    border-radius: 20px;
}

/* ===== RESPONSIVE ===== */
@media (max-width: 900px) {

    header {
        flex-direction: column;
        padding: 15px 20px;
        align-items: flex-start;
    }

    nav {
        flex-direction: column;
        width: 100%;
        gap: 10px;
        margin-top: 10px;
    }

    nav a {
        width: 100%;
        text-align: center;
    }

    .hero {
        flex-direction: column;
        text-align: center;
        padding-top: 150px; /* adjust for stacked header */
        padding-left: 20px;
        padding-right: 20px;
    }

    .hero-text {
        max-width: 100%;
    }

    .hero-text h1 {
        font-size: 42px;
    }

    .buttons a {
        margin-bottom: 10px;
        margin-right: 0;
    }

    .hero-image {
        max-width: 1000%;
        margin-top: 100px;
    }
}

    </style>
</head>
<body>

<header>
 <?php
 include("navbar.php");?>

</header>

<section class="hero">
    <div class="hero-text">
        <h1>
            CUSTOM WATCHES<br>
            FOR ANY<br>
            OCCASION
        </h1>

        <div class="buttons">
            <a href="#">DESIGN & ORDER</a>
            <a href="#">REQUEST VIRTUAL</a>
        </div>
    </div>

    <div class="hero-image">
        <!-- Replace image path with your own watch image -->
        <img src="good.jpeg" alt="Luxury Watch">
    </div>
</section>

</body>
</html>
