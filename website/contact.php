<?php
session_start();
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
        <a href="index.php"><img src="img/logo.png" class="logo" alt="". width="150", height="140" /></a>

        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>

                <?php

                if ($_SESSION['aid'] < 0) {
                    echo "   <li><a href='login.php'>login</a></li>
            <li><a href='signup.php'>SignUp</a></li>
            ";
                } else {
                    echo "   <li><a href='profile.php'>profile</a></li>
          ";
                }
                ?>
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

    <section id="page-header" class="about-header">
        <h2>#GameTillTheEnd</h2>

        <p>Providing Premium Gaming Experience</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>address</p>
                </li>
                <li>
                    <i class="fal fa-envelope"></i>
                    <p>techietokkor@gmail.com</p>
                </li>
                <li>
                    <i class="fal fa-phone-alt"></i>
                    <p>+01845041234</p>
                </li>
                <li>
                    <i class="fal fa-clock"></i>
                    <p>Monday to Saturday: 9am to 5pm</p>

                </li>
            </div>
        </div>
        <div class="map">
            <iframe
             src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6853.777513218648!2d90.42251407654734!3d23.76991556232959!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755c7715a40c603%3A0xec01cd75f33139f5!2sBRAC%20University!5e1!3m2!1sen!2sbd!4v1735247161383!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                width="600" height="450" style="border: 0" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <div class="people">
            <div>
                <img src="img/people/a.jpeg" alt="" />
                <p>
                    <span>Ed</span> Founder and CEO <br />
                    Phone: +01850452345 <br />
                    Email:Ed@gmail.com
                </p>
            </div>
            <div>
                <img src="img/people/b.jpeg" alt="" />
                <p>
                    <span>Edd</span> Executive Marketing Manager <br />
                    Phone: +01778864563 <br />
                    Email:Edd@gmail.com
                </p>
            </div>
            <div>
                <img src="img/people/c.jpeg" alt="" />
                <p>
                    <span>Eddy</span> Customer Service Officer <br />
                    Phone: +01971451499 <br />
                    Email:Eddy@gmail.com
                </p>
            </div>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
        <img src="img/logo.png" class="logo" alt="". width="150", height="140" />

        <h4>Contact</h4>
            <p>
                <strong>Address: </strong> Kha 224, Bir Uttam Rafiqul Islam Ave, Dhaka 1212

            </p>
            <p>
                <strong>Phone: </strong> +8801718175150
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
            <p>2025. Techie Tokkor</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>

</html>

<script>
window.addEventListener("unload", function() {
  // Call a PHP script to log out the user
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "logout.php", false);
  xhr.send();
});
</script>