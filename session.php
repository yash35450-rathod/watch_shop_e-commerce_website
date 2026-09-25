<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// protect pages
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
