<?php
session_start();
include("db.php"); // Make sure this connects to your database

// Handle form submission
if (isset($_POST['register'])) {

    // Trim inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (!$name || !$email || !$phone || !$address || !$password || !$confirm_password) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {

        // Escape special characters for security
        $name = mysqli_real_escape_string($conn, $name);
        $email = mysqli_real_escape_string($conn, $email);
        $phone = mysqli_real_escape_string($conn, $phone);
        $address = mysqli_real_escape_string($conn, $address);

        // Check if email or phone already exists
        $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' OR phone='$phone'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Email or phone already registered.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into users table
            $sql = "INSERT INTO users (name, email, phone, address, password)
                    VALUES ('$name', '$email', '$phone', '$address', '$hashed_password')";

            if (mysqli_query($conn, $sql)) {
                $success = "Registration successful! You can now <a href='login.php'>login</a>.";
            } else {
                $error = "Database error: " . mysqli_error($conn);
            }
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body{
    background:#000;
    color:#fff;
    font-family:Arial, sans-serif;
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:100vh;
}

.form-container{
    background:#111;
    padding:30px;
    border-radius:12px;
    width:400px;
}

h2{
    text-align:center;
    margin-bottom:20px;
    color:#c49b63;
}

input{
    width:100%;
    padding:10px;
    margin:8px 0;
    border-radius:6px;
    border:none;
}

button{
    width:100%;
    padding:12px;
    background:#c49b63;
    border:none;
    font-weight:bold;
    cursor:pointer;
    border-radius:6px;
}

button:hover{
    background:#b38952;
}

.error{
    background:#ff0000;
    color:#fff;
    padding:8px;
    margin-bottom:10px;
    border-radius:6px;
}

.success{
    background:#00aa00;
    color:#fff;
    padding:8px;
    margin-bottom:10px;
    border-radius:6px;
}

a{
    color:#fff;
    text-decoration:underline;
}
</style>
</head>
<body>

<div class="form-container">
<h2>Register</h2>

<?php
if (isset($error)) {
    echo "<div class='error'>$error</div>";
} elseif (isset($success)) {
    echo "<div class='success'>$success</div>";
}
?>

<form method="POST" action="">
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="phone" placeholder="Phone Number" required>
    <input type="text" name="address" placeholder="Address" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    <button type="submit" name="register">Register</button>
</form>
</div>

</body>
</html>
