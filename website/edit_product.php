<?php
include("include/connect.php");
$id = $_GET['id'];
$product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE pid=$id"));

if (isset($_POST['submit'])) {
    $pname = $_POST['pname'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $imagePath = $product['img'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/product/';
        $imageName = basename($_FILES['image']['name']);
        $newImagePath = $uploadDir . $imageName;
    
        if (move_uploaded_file($_FILES['image']['tmp_name'], $newImagePath)) {
            // Update the image path in the database
            $query = "UPDATE products SET pname='$pname', category='$category', price='$price', img='$newImagePath' WHERE pid=$id";
            mysqli_query($con, $query);
        }
    }
    
    // Update the product record
    $query = "UPDATE products SET pname='$pname', category='$category', price='$price', img='$imagePath' WHERE pid=$id";
    mysqli_query($con, $query);
    header("Location: inventory_management.php");
}
?>
<form method="post" enctype="multipart/form-data">
    <label>Product Name:</label><input type="text" name="pname" value="<?php echo $product['pname']; ?>">
    <label>Category:</label><input type="text" name="category" value="<?php echo $product['category']; ?>">
    <label>Price:</label><input type="number" name="price" value="<?php echo $product['price']; ?>">
    <label>Upload Image:</label><input type="file" name="image" accept="image/*">
    <button type="submit" name="submit">Update Product</button>
</form>
