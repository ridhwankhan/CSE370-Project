<?php
include("include/connect.php");
$result = mysqli_query($con, "SELECT * FROM products");
?>
<h1>Product Management</h1>
<a href="add_product.php">Add New Product</a>
<table border="1">
    <tr>
        <th>Product Name</th>
        <th>Category</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $row['pname']; ?></td>
            <td><?php echo $row['category']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['pid']; ?>">Edit</a>
                <a href="delete_product.php?id=<?php echo $row['pid']; ?>">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>
