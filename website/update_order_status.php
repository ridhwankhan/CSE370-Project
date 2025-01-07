<?php
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin1') {

    header("Location: index.php"); 
    exit();
}
include("include/connect.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = intval($_POST['order_id']);
    $status = $_POST['status'];

    $query = "UPDATE orders SET status = '$status' WHERE oid = $order_id";
    if (mysqli_query($con, $query)) {
        header("Location: order_management.php");
    } else {
        echo "Error updating status: " . mysqli_error($con);
    }
}
?>
