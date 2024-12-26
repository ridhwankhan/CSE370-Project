<?php
session_start();
include("include/connect.php");

// Check if admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}

// Fetch all orders including the status
$result = mysqli_query($con, "SELECT oid, dateod, datedel, aid, address, total, status FROM orders");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="style.css"> <!-- Add your CSS -->
</head>
<body>
    <header class="admin-header">
        <h1>Order Management</h1>
        <nav class="admin-nav">
            <a href="dashboard.php">Back to Dashboard</a>
        </nav>
    </header>
    <main>
        <table class="admin-table">
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
            <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                    <td><?php echo $row['oid']; ?></td>
                    <td><?php echo $row['dateod']; ?></td>
                    <td><?php echo $row['datedel'] ?: 'Pending'; ?></td>
                    <td><?php echo $row['aid']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td>$<?php echo $row['total']; ?></td>
                    <td>
                        <!-- Status Dropdown -->
                        <form method="post" action="update_order_status.php">
                            <input type="hidden" name="order_id" value="<?php echo $row['oid']; ?>">
                            <select name="status">
                                <option value="Pending" <?php if ($row['status'] == 'Pending') echo 'selected'; ?>>Pending</option>
                                <option value="Processing" <?php if ($row['status'] == 'Processing') echo 'selected'; ?>>Processing</option>
                                <option value="Shipped" <?php if ($row['status'] == 'Shipped') echo 'selected'; ?>>Shipped</option>
                                <option value="Delivered" <?php if ($row['status'] == 'Delivered') echo 'selected'; ?>>Delivered</option>
                            </select>
                            <button type="submit" class="admin-btn">Update</button>
                        </form>
                    </td>
                    <td>
                        <a class="admin-btn" href="view_order.php?id=<?php echo $row['oid']; ?>">View Details</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </main>
    <footer>
        <p>© 2025 Techie Tokkor.</p>
    </footer>
</body>
</html>
