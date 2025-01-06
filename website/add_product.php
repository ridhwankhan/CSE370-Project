<?php
include("include/connect.php");

if (isset($_POST['submit'])) {
    $pname = mysqli_real_escape_string($con, $_POST['pname']);
    $category = mysqli_real_escape_string($con, $_POST['category']);
    $price = mysqli_real_escape_string($con, $_POST['price']);
    $qtyavail = mysqli_real_escape_string($con, $_POST['qtyavail']); // Capture available quantity
    $brand = mysqli_real_escape_string($con, $_POST['brand']);
    $description = mysqli_real_escape_string($con, $_POST['description']);

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
                $query = "INSERT INTO products (pname, category, price, qtyavail, img, brand, description ) 
                          VALUES ('$pname', '$category', '$price', '$qtyavail', '$newImageName', '$brand','$description')";
                if (mysqli_query($con, $query)) {
                    header("Location: inventory_management.php");
                    exit(); // Ensure script stops after redirect
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
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
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
        padding: 10px 0; /* Adjust padding */
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
        display: flex;
        align-items: center;
        height: 122px; /* Adjust height */
        justify-content: space-between;
    }



        .header-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: 20px;
        }

        .logo {
            width: 140px;
            height: auto;
            margin-left: 35px;
            border-radius: 8px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        main {
            max-width: 600px;
            margin: 200px auto 30px;
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
        textarea {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 5px;
            resize: vertical; /* Allow vertical resizing */
            margin-left: -10px; /* Add margin to the right */
            
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="index.php">
                <img src="img/logo.png" alt="Techie Tokkor Logo" class="logo">
            </a>
            <h1>Add Product</h1>
        </div>
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
                <label for="brand">Brand:</label>
                <input type="text" name="brand" id="brand" required>
            </div>

            <div>
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required>
            </div>
            <div>
                <label for="qtyavail">Quantity Available:</label>
                <input type="number" name="qtyavail" id="qtyavail" min="1" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea name="description" id="description" rows="4" required ></textarea>
            </div>
            <div>
                <label for="image">Product Image:</label>
                <input type="file" name="image" id="image" accept="image/*" required>
            </div>
            <button type="submit" name="submit">Add Product</button>
        </form>
    </main>
</body>
</html>
