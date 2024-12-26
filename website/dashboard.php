<?php
session_start();
include("include/connect.php");

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css"> <!-- Add your CSS -->
</head>
<body>
    <header>
        <h1>Welcome to the Admin Dashboard</h1>
        <nav>
            <a href="inventory_management.php">Manage Products</a>
            <a href="order_management.php">View Orders</a>
            <a href="logout.php">Logout</a>
        </nav>
    </header>
    
    <main>
        <section>
            <h2>Overview</h2>
            <?php
            // Fetch counts for metrics
            $product_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM products"));
            $order_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM orders"));
            $user_count = mysqli_num_rows(mysqli_query($con, "SELECT * FROM accounts"));
            ?>
            <div>
                <p>Total Products: <?php echo $product_count; ?></p>
                <p>Total Orders: <?php echo $order_count; ?></p>
                <p>Total Users: <?php echo $user_count; ?></p>
            </div>
        </section>
        
        <section>
            <h2>Recent Orders</h2>
            <table border="1">
                <tr>
                    <th>Order ID</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
                <?php
                $orders = mysqli_query($con, "SELECT * FROM orders ORDER BY dateod DESC LIMIT 5");
                while ($order = mysqli_fetch_assoc($orders)) {
                    echo "<tr>
                        <td>{$order['oid']}</td>
                        <td>{$order['dateod']}</td>
                        <td>{$order['total']}</td>
                        <td><a href='view_order.php?id={$order['oid']}'>View</a></td>
                    </tr>";
                }
                ?>
            </table>
        </section>

        <section>
            <h2>Quick Actions</h2>
            <div>
                <a href="add_product.php">Add New Product</a>
                <a href="inventory_management.php">Manage Products</a>
                <a href="order_management.php">Manage Orders</a>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 Techie Tokkor. </p>
    </footer>
</body>
</html>
