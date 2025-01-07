<?php
include("include/connect.php");
session_start();

// Check if 'aid' exists in the session
if (isset($_SESSION['aid']) && $_SESSION['aid'] != -1) {
    $aid = intval($_SESSION['aid']); // Sanitize the 'aid' value

    // Execute the query to delete items from the cart for the current user
    $query = "DELETE FROM CART WHERE aid = $aid";
    if (!mysqli_query($con, $query)) {
        echo "Error deleting cart items: " . mysqli_error($con);
    }
}

// // Clear the session variables
// $_SESSION = array();

// Destroy the session
session_destroy();

// Show a popup message and then redirect
echo "<script>
    alert('Logged out Successfully');
    window.location.href = 'login.php';
</script>";
exit;
?>
