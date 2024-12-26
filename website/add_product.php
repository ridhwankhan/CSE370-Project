<?php
include("include/connect.php");
if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $query = "INSERT INTO products (pname, category, price) VALUES ('$pname', '$category', '$price')";
    mysqli_query($con, $query);
    header("Location: inventory_management.php");
}
?>
<form method="post">
    <label>Product Name:</label><input type="text" name="pname">
    <label>Category:</label><input type="text" name="category">
    <label>Price:</label><input type="number" name="price">
    <button type="submit" name="submit">Add Product</button>
</form>
