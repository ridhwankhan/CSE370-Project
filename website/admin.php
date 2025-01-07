<?php
session_start();


include("include/connect.php"); // Ensure this file connects to the database

if (isset($_POST['submit'])) {
    // Retrieve and sanitize user input
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Query to validate admin credentials
    $query = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Check if the user is an admin (hardcoding admin username for now)
        if ($user['username'] === 'admin1') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php"); // Redirect to admin dashboard
            exit;
        } else {
            echo "<script>alert('Unauthorized Access');</script>";
        }
    } else {
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="header">
    <a href="index.php"><img src="img/logo.png" class="logo" alt="" width="130" height="150"/></a>
        <ul id="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a class="active" href="admin.php">Admin</a></li>
        </ul>
    </section>
    <form method="post" id="form">
        <h3>Admin Login</h3>
        <input class="input1" name="username" type="text" placeholder="Username" required>
        <input class="input1" name="password" type="password" placeholder="Password" required>
        <button type="submit" class="btn" name="submit">Login</button>
    </form>
    <footer>
        <p>2025. Techie Tokkor. All Rights Reserved.</p>
    </footer>
</body>
</html>
