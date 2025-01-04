<?php
include("include/connect.php");
$result = mysqli_query($con, "SELECT * FROM products");
?>
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
            padding: 20px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            height: 150px;
            justify-content: space-between;
        }

        .header-container {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-left: 20px;
        }

        .logo {
            width: 120px;
            height: auto;
            margin-left: 35px;
            margin-top: 15px;
}



        header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 15px;
            margin-right: 20px;
        }

        nav a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 15px;
            border-radius: 5px;
        }

        nav a:hover {
            background-color: white;
            color: #4CAF50;
        }

        main {
            max-width: 1200px;
            margin: 200px auto 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
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
        <div class="header-container">
            <a href="index.php">
                <img src="img/logo.png" alt="Techie Tokkor Logo" class="logo">
            </a>
            <h1>Product Management</h1>
        </div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
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
