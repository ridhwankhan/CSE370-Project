<?php
include("include/connect.php");
$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE pid=$id"));

if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $query = "UPDATE products SET pname='$pname', category='$category', price='$price' WHERE pid=$id";
    mysqli_query($con, $query);
    header("Location: inventory_management.php");
}
?>
<form method="post">
    <label>Product Name:</label><input type="text" name="pname" value="<?php echo $product['pname']; ?>">
    <label>Category:</label><input type="text" name="category" value="<?php echo $product['category']; ?>">
    <label>Price:</label><input type="number" name="price" value="<?php echo $product['price']; ?>">
    <button type="submit" name="submit">Update Product</button>
</form>
