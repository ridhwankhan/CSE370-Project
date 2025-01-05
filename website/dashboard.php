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
            padding: 10px 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            height: 122px;
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
            color: white;
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
            margin-top: 150px; /* Adjusted to match the reduced header height */
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #444;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
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

        footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #f4f4f4;
            color: #666;
        }

        .Bars {
            margin-bottom: 20px;
        }

        .Bars a {
            margin-right: 10px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
            border: 1px solid #4CAF50;
            padding: 8px 16px;
            border-radius: 4px;
        }

        .Bars a:hover {
            background: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="index.php"><img src="img/logo.png" alt="Techie Tokkor Logo" class="logo"></a>
            <h1>Welcome to the Admin Dashboard</h1>
        </div>
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
            <table>
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
            <h2 align="center">Quick Actions</h2>
            <div align="center"  class="Bars">
                <a href="add_product.php">Add New Product</a>
                <a href="order_management.php">Manage Orders</a>
            </div>
        </section>
    </main>

    <footer>
        <p>© 2025 Techie Tokkor.</p>
    </footer>
</body>
</html>
