<?php
include("include/connect.php");
$result = mysqli_query($con, "SELECT * FROM products");
?>
<<<<<<< HEAD
<h1>Product Management</h1>
<a href="add_product.php">Add New Product</a>
<table border="1">
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['pname']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['pid']; ?>">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['pid']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
=======
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
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
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin-bottom: 20px;
            color: #444;
        }

        a {
            text-decoration: none;
            color: white;
            background-color: #4CAF50;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
        }

        a:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: center;
        }

        th {
            background-color: #f4f4f4;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .actions a {
            margin: 0 5px;
            padding: 8px 12px;
            border-radius: 4px;
        }

        .actions a.edit {
            background-color: #4CAF50;
            color: white;
        }

        .actions a.edit:hover {
            background-color: #45a049;
        }

        .actions a.delete {
            background-color: #f44336;
            color: white;
        }

        .actions a.delete:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <h1>Product Management</h1>
    </header>
    <main>
        <a href="add_product.php">Add New Product</a>
        <table>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td>
                        <img src="product_images/<?php echo $row['img']; ?>" alt="<?php echo $row['pname']; ?>">
                        </td>
                        <td><?php echo $row['pname']; ?></td>
                        <td><?php echo $row['category']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                        <td class="actions">
                            <a href="edit_product.php?id=<?php echo $row['pid']; ?>" class="edit">Edit</a>
                            <a href="delete_product.php?id=<?php echo $row['pid']; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>
</html>
>>>>>>> master
