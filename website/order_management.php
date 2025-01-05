<?php
session_start();
include("include/connect.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}

// Delete an order
if (isset($_GET['delete_id'])) {
    $delete_id = intval($_GET['delete_id']);
    $delete_order_query = "DELETE FROM orders WHERE oid = $delete_id";
    $delete_order_details_query = "DELETE FROM `order-details` WHERE oid = $delete_id";

    if (mysqli_query($con, $delete_order_details_query) && mysqli_query($con, $delete_order_query)) {
        // Redirect back to the order management page after successful deletion
        header("Location: order_management.php");
        exit;
    } else {
        echo "<script>alert('Error deleting the order.'); window.location.href = 'order_management.php';</script>";
    }
}

// Fetch all orders
$result = mysqli_query($con, "SELECT oid, dateod, datedel, aid, address, total, status FROM orders");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
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
            padding: 10px 0; /* Reduced padding */
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            height: 122px; /* Reduced height */
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
            max-width: 1000px;
            margin: 200px auto 30px;
            background: white;
            padding: 20px;
            border-radius: 8px;
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

        .btn {
            padding: 8px 16px;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            display: inline-block;
            margin: 0 5px;
        }

        .btn-view {
            background-color: #4CAF50;
            color: white;
        }

        .btn-view:hover {
            background-color: #45a049;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .btn-delete:hover {
            background-color: #d32f2f;
        }

        .action-buttons {
            display: flex;
            justify-content: center;
            gap: 10px;
        }

        .admin-btn {
            padding: 8px 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .admin-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <a href="dashboard.php">
                <img src="img/logo.png" alt="Techie Tokkor Logo" class="logo">
            </a>
            <h1>Order Management</h1>
        </div>
        <nav>
            <a href="dashboard.php">Back to Dashboard</a>
        </nav>
    </header>

    <main>
        <h1>Order List</h1>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Customer ID</th>
                    <th>Address</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $delivery_date = $row['datedel'] ?: 'Pending';
                        echo "<tr>
                            <td>{$row['oid']}</td>
                            <td>{$row['dateod']}</td>
                            <td>{$delivery_date}</td>
                            <td>{$row['aid']}</td>
                            <td>{$row['address']}</td>
                            <td>\${$row['total']}</td>
                            <td>
                                <form method='post' action='update_order_status.php'>
                                    <input type='hidden' name='order_id' value='{$row['oid']}'>
                                    <select name='status'>
                                        <option value='Pending' " . ($row['status'] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                        <option value='Processing' " . ($row['status'] == 'Processing' ? 'selected' : '') . ">Processing</option>
                                        <option value='Shipped' " . ($row['status'] == 'Shipped' ? 'selected' : '') . ">Shipped</option>
                                        <option value='Delivered' " . ($row['status'] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                                    </select>
                                    <button type='submit' class='admin-btn'>Update</button>
                                </form>
                            </td>
                            <td>
                                <div class='action-buttons'>
                                    <a href='view_order.php?id={$row['oid']}' class='btn btn-view'>View</a>
                                    <a href='order_management.php?delete_id={$row['oid']}' class='btn btn-delete' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a>
                                </div>
                            </td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
