<?php
session_start();
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin1') {

    echo "<script>
            alert('You are not an admin');
            window.location.href = 'index.php';
          </script>";
    // header("Location: index.php"); 
    exit();
}

include("include/connect.php");
$result = mysqli_query($con, "SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="css/inventory_management.css">
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
            <a href= "add_product.php">Add Products</a>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    <main>
        
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
