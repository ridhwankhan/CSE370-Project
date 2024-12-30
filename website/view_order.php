<?php
session_start();
include("include/connect.php");

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit;
}

// Get the order ID from the URL
if (!isset($_GET['id'])) {
    echo "<script>alert('No order selected.'); window.location.href = 'order_management.php';</script>";
    exit;
}

$order_id = intval($_GET['id']);

// Fetch order details
$order_query = "SELECT * FROM orders WHERE oid = $order_id";
$order_result = mysqli_query($con, $order_query);
$order = mysqli_fetch_assoc($order_result);

if (!$order) {
    echo "<script>alert('Order not found.'); window.location.href = 'order_management.php';</script>";
    exit;
}

// Fetch products in the order
$order_products_query = "
    SELECT od.pid, p.pname, od.qty, p.price 
    FROM `order-details` od
    JOIN products p ON od.pid = p.pid
    WHERE od.oid = $order_id
";
$order_products_result = mysqli_query($con, $order_products_query);

// Fetch user details
$user_query = "SELECT * FROM accounts WHERE aid = {$order['aid']}";
$user_result = mysqli_query($con, $user_query);
$user = mysqli_fetch_assoc($user_result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f5f7;
            color: #333;
        }

        header {
            padding: 20px;
            text-align: center;
            background: #4CAF50;
            color: white;
            margin-bottom: 20px;
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            margin-bottom: 20px;
            color: #444;
        }

        section {
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

        a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        footer {
            margin-top: 20px;
            text-align: center;
            padding: 10px;
            background: #f4f4f4;
            color: #666;
        }
    </style>
</head>
<body>
    <header>
        <h1>Order Details (Order ID: <?php echo $order_id; ?>)</h1>
        <a href="order_management.php">Back to Orders</a>
    </header>

    <main>
        <section>
            <h2>Customer Information</h2>
            <p><strong>Name:</strong> <?php echo "{$user['afname']} {$user['alname']}"; ?></p>
            <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
            <p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>
            <p><strong>Address:</strong> <?php echo $order['address']; ?></p>
            <p><strong>City:</strong> <?php echo $order['city']; ?></p>
            <p><strong>Country:</strong> <?php echo $order['country']; ?></p>
        </section>

        <section>
            <h2>Order Information</h2>
            <p><strong>Order Date:</strong> <?php echo $order['dateod']; ?></p>
            <p><strong>Delivery Date:</strong> <?php echo $order['datedel']; ?></p>
            <p><strong>Total Amount:</strong> $<?php echo $order['total']; ?></p>
        </section>

        <section>
            <h2>Products in Order</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($product = mysqli_fetch_assoc($order_products_result)) {
                        $subtotal = $product['qty'] * $product['price'];
                        echo "<tr>
                            <td>{$product['pid']}</td>
                            <td>{$product['pname']}</td>
                            <td>{$product['qty']}</td>
                            <td>\${$product['price']}</td>
                            <td>\${$subtotal}</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <p>© 2025 Techie Tokkor. Admin Panel</p>
    </footer>
</body>
</html>