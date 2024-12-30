<?php
include("include/connect.php");

if (isset($_POST['submit'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
<<<<<<< HEAD
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
=======

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $image = $_FILES['image'];
        $imageName = $image['name'];
        $imageTmpName = $image['tmp_name'];
        $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));
        $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];

        if (in_array($imageExt, $allowedExt)) {
            $newImageName = uniqid("IMG-", true) . "." . $imageExt;
            $imageDestination = "product_images/" . $newImageName;

            if (move_uploaded_file($imageTmpName, $imageDestination)) {
                // Save product information to the database
                $query = "INSERT INTO products (pname, category, price, img) VALUES ('$pname', '$category', '$price', '$newImageName')";
                if (mysqli_query($con, $query)) {
                    header("Location: inventory_management.php");
                } else {
                    echo "Error: " . mysqli_error($con);
                }
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    } else {
        echo "Error uploading the file.";
>>>>>>> master
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
<<<<<<< HEAD
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
=======
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f5f7;
            color: #333;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
        }
        main {
            max-width: 600px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        label {
            font-weight: bold;
            margin-bottom: 5px;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        button {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Add Product</h1>
    </header>
    <main>
        <form method="post" enctype="multipart/form-data">
            <div>
                <label for="pname">Product Name:</label>
                <input type="text" name="pname" id="pname" required>
            </div>
            <div>
                <label for="category">Category:</label>
                <input type="text" name="category" id="category" required>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required>
            </div>
            <div>
                <label for="image">Product Image:</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <button type="submit" name="submit">Add Product</button>
        </form>
    </main>
>>>>>>> master
</body>
</html>
