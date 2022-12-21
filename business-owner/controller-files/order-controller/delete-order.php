<?php
include "../../includes/header.php";
include "../../config/config.php";

$user_id = $_GET['id'];
$business_id = $_GET['b_id'];

$sql = "DELETE from product_order where user_id = '{$user_id}' and business_id = '{$business_id}'";

if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Order deleted.";
    header("location: {$hostname}orders.php");
} else {
    $_SESSION['error'] = "Delete operation not completed. An error occured.";
    header("location: {$hostname}orders.php");
}
