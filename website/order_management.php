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

// Ensure 'status' column exists in the 'orders' table
$check_column_query = "SHOW COLUMNS FROM orders LIKE 'status'";
$result = mysqli_query($con, $check_column_query);
if (mysqli_num_rows($result) === 0) {
    $add_column_query = "ALTER TABLE orders ADD COLUMN status VARCHAR(50) NOT NULL DEFAULT 'Pending';";
    if (!mysqli_query($con, $add_column_query)) {
        die("Error adding 'status' column: " . mysqli_error($con));
    }
}

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

// Update order status and delivery date
if (isset($_POST['order_id']) && isset($_POST['status'])) {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    // Set delivery date to the current date for specific statuses
    if ($status === 'Delivered') {
        date_default_timezone_set('Asia/Dhaka'); // Set the timezone
        $delivery_date = date('Y-m-d');
    } else {
        $delivery_date = NULL; // Reset date if status is not relevant
    }

    $update_query = "UPDATE orders SET status = '$status', datedel = " . ($delivery_date ? "'$delivery_date'" : "NULL") . " WHERE oid = $order_id";

    if (!mysqli_query($con, $update_query)) {
        echo "Error updating order: " . mysqli_error($con);
    } else {
        echo "<script>alert('Order status and delivery date updated successfully!'); window.location.href = 'order_management.php';</script>";
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
    <link rel="stylesheet" href="css/order_management.css">
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
                        // Determine the delivery date based on the status
                        if ($row['status'] === 'Pending' || $row['status'] === 'Processing' || $row['status'] === 'Shipped') {
                            $delivery_date = $row['status']; // Display the status as the delivery date
                        } else {
                            $delivery_date = $row['datedel'] ? $row['datedel'] : 'Not Set'; // Display the actual date for Delivered or 'Not Set'
                        }

                        echo "<tr>
                            <td>{$row['oid']}</td>
                            <td>{$row['dateod']}</td>
                            <td>{$delivery_date}</td>
                            <td>{$row['aid']}</td>
                            <td>{$row['address']}</td>
                            <td>\${$row['total']}</td>
                            <td>
                                <form method='post' action='order_management.php'>
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
