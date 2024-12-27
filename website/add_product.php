<?php
include("include/connect.php");

if (isset($_POST['submit'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $imagePath = null;

    // Handle Image Upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'img/products/'; // Use the `img/products` directory
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Create the directory if it doesn't exist
        }

        $imageName = time() . '_' . basename($_FILES['image']['name']); // Unique file name
        $imagePath = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
            echo "<script>alert('Failed to upload image.');</script>";
            $imagePath = null; // Reset the path if upload fails
        }
    } else {
        echo "<script>alert('Please upload a valid image.');</script>";
    }

    // Insert product details into the database
    $query = "INSERT INTO products (pname, category, price, img) VALUES ('$pname', '$category', '$price', '$imagePath')";
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Product added successfully.'); window.location.href = 'inventory_management.php';</script>";
    } else {
        echo "<script>alert('Failed to add product.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="style.css"> <!-- Add your CSS if needed -->
</head>
<body>
    <h1>Add Product</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Product Name:</label><input type="text" name="pname" required>
        <label>Category:</label><input type="text" name="category" required>
        <label>Price:</label><input type="number" name="price" required>
        <label>Upload Image:</label><input type="file" name="image" accept="image/*" required>
        <button type="submit" name="submit">Add Product</button>
    </form>
</body>
</html>
