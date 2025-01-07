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
    <link rel="stylesheet" href="css/view_order.css">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="dashboard.php">
                <img src="img/logo.png" alt="Techie Tokkor Logo" class="logo">
            </a>
            <h1>Order Details (Order ID: <?php echo $order_id; ?>)</h1>
        </div>
        <nav>
            <a href="dashboard.php">Dashboard</a>
            <a href="logout.php">Logout</a>
        </nav>
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
