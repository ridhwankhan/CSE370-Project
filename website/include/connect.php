<?php
$con = mysqli_connect('localhost', 'root', '', 'emc');
if (!$con) {
    die('Connection failed: ' . mysqli_connect_error()); // More detailed error message
}
?>
