<?php

include("include/connect.php");
$id = $_GET['id'];

// Fetch the product to get the image path
$product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE pid=$id"));

// Delete the image file if it exists
if (file_exists($product['img'])) {
    unlink($product['img']);
}

// Delete the product record
mysqli_query($con, "DELETE FROM products WHERE pid=$id");
header("Location: inventory_management.php");
?>
