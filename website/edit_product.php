<?php
include("include/connect.php");

// Fetch product details
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $result = mysqli_query($con, "SELECT * FROM products WHERE pid = $id");
    $product = mysqli_fetch_assoc($result);

    if (!$product) {
        echo "Product not found!";
        exit;
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $price = mysqli_real_escape_string($con, $_POST['price']);

    // Handle image upload
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
                // Delete old image if it exists
                if (!empty($product['img']) && file_exists("product_images/" . $product['img'])) {
                    unlink("product_images/" . $product['img']);
                }

                // Update product with new image
                $product['img'] = $newImageName;
            } else {
                echo "Failed to upload the image.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.";
        }
    }

    // Update product details in the database
    $sql = "UPDATE products SET pname = '$pname', category = '$category', price = '$price', img = '{$product['img']}' WHERE pid = $id";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Product updated successfully!'); window.location.href='inventory_management.php';</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
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

        header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        main {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            font-weight: bold;
        }

        input, select {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
            width: 100%;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #45a049;
        }

        .image-preview {
            margin-bottom: 20px;
            text-align: center;
        }

        .image-preview img {
            max-width: 100%;
            height: auto;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #f4f4f4;
            color: #666;
        }
    </style>
</head>
<body>
<header>
    <h1>Edit Product</h1>
</header>
<main>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="pname">Product Name:</label>
        <input type="text" id="pname" name="pname" value="<?php echo htmlspecialchars($product['pname']); ?>" required>

        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?php echo htmlspecialchars($product['category']); ?>" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>

        <div class="image-preview">
            <p>Current Image:</p>
            <?php if (!empty($product['img'])) { ?>
                <img src="product_images/<?php echo $product['img']; ?>" alt="Product Image">
            <?php } else { ?>
                <p>No image available.</p>
            <?php } ?>
        </div>

        <label for="image">Change Image:</label>
        <input type="file" id="image" name="image">

        <button type="submit">Update Product</button>
    </form>
</main>
<footer>
    <p>© 2025 Techie Tokkor. </p>
</footer>
</body>
</html>