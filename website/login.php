<?php
session_start();

include("include/connect.php");

if (isset($_POST['submit'])) {  //checks if the login form is submitted via the POST method.

    $username = $_POST['username'];
    $password = $_POST['password'];//gets the username and password entered by the user.

    $query = "SELECT * FROM accounts WHERE username='$username' AND password='$password'";
    //checks the accounts table for a record where the username and password match the user's input.

    $result = mysqli_query($con, $query);
    //executes the query and stores the result in $result.

    if (mysqli_num_rows($result) > 0) {// checks if the number of row is greater than 0
        $row = mysqli_fetch_assoc($result); //retrieves the first matching row from the result set as an associative array.
        $_SESSION['aid'] = $row['aid'];
        header("Location: profile.php");
        exit();
    }
    else
        {
            echo "<script> alert('Wrong credentials') </script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Techie Tokkor</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />

    <link rel="stylesheet" href="style.css" />

</head>

<body>
    <section id="header">
        <!-- <a href="#"><img src="img/logo.png" class="logo" alt="" /></a> -->
        <a href="index.php"><img src="img/logo.png" class="logo" alt="" width="130" height="150"/></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a class="active" href="login.php">Login</a></li>
                <li><a href="signup.php">SignUp</a></li>
                <li><a href="admin.php">Admin</a></li>
                <li id="lg-bag">
                    <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
                </li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>


    <form method="post" id="form">
        <h3 style="color: darkred; margin: auto"></h3>
        <input class="input1" id="user" name="username" type="text" placeholder="Username *">
        <input class="input1" id="pass" name="password" type="password" placeholder="Password *">
        <button type="submit" class="btn" name="submit">login</button>

    </form>

    <div class="sign">
        <a href="signup.php" class="signn">Do not have an account?</a>
    </div>


    <footer class="section-p1">
        <div class="col">
            <!-- <img class="logo" src="img/logo.png" /> -->
            <img src="img/logo.png" class="logo" alt="" width="130" height="150"/>
            <h4>Contact</h4>
            <p>
                <strong>Address: </strong> Kha 224, Bir Uttam Rafiqul Islam Ave, Dhaka 1212

            </p>
            <p>
                <strong>Phone: </strong> +01718175150
            </p>
            <p>
                <strong>Hours: </strong> 9am-5pm
            </p>
        </div>

        <div class="col">
            <h4>My Account</h4>
            <a href="cart.php">View Cart</a>
            <a href="wishlist.php">My Wishlist</a>
        </div>
        <div class="col install">
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" />
        </div>
        <div class="copyright">
            <p>2025. Techie Tokkor. </p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>
