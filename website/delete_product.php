<?php
include("include/connect.php");
$id = $_GET['id'];
mysqli_query($con, "DELETE FROM products WHERE pid=$id");
header("Location: inventory_management.php");
?>
