<?php
include("db.php");

if (!isset($_GET['id'])) {
    die("ID missing");
}

$id = $_GET['id'];

// get image name
$result = mysqli_query($conn, "SELECT image FROM watches WHERE id=$id");
$row = mysqli_fetch_assoc($result);

// delete image file
if ($row && file_exists("uploads/".$row['image'])) {
    unlink("uploads/".$row['image']);
}

// delete record
mysqli_query($conn, "DELETE FROM watches WHERE id=$id");

// redirect back
header("Location: update_watch.php");
exit;
