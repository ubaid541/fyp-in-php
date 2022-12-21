<?php
include "../../includes/header.php";
include "../../config/config.php";

$user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
$business_id = mysqli_real_escape_string($conn, $_POST['b_id']);


if (isset($_POST['complete'])) {
    $result = mysqli_query($conn, "SELECT product_order_status from product_order  where user_id = '$user_id' and business_id = '$business_id'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "UPDATE product_order set product_order_status = 1 where user_id = '$user_id' and business_id = '$business_id' ";
            // echo $sql;
            // die();
            mysqli_query($conn, $sql);
        }
    }
    header("location: {$hostname}orders.php");
}

if (isset($_POST['cancel'])) {
    $result = mysqli_query($conn, "SELECT product_order_status from product_order  where user_id = '$user_id' and business_id = '$business_id'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "UPDATE product_order set product_order_status = 2 where user_id = '$user_id' and business_id = '$business_id' ";
            // echo $sql;
            // die();
            mysqli_query($conn, $sql);
        }
    }
    header("location: {$hostname}orders.php");
}

if (isset($_POST['paid'])) {
    $result = mysqli_query($conn, "SELECT product_payment_status from product_order where user_id = '$user_id' and business_id = '$business_id'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "UPDATE product_order set product_payment_status = 1 where user_id = '$user_id' and business_id = '$business_id' ";
            // echo $sql;
            // die();
            mysqli_query($conn, $sql);
        }
    }
    header("location: {$hostname}orders.php");
}

if (isset($_POST['unpaid'])) {
    $result = mysqli_query($conn, "SELECT product_payment_status from product_order where user_id = '$user_id' and business_id = '$business_id'");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql = "UPDATE product_order set product_payment_status = 0 where user_id = '$user_id' and business_id = '$business_id' ";
            // echo $sql;
            // die();
            mysqli_query($conn, $sql);
        }
    }
    header("location: {$hostname}orders.php");
}
mysqli_close($conn);
