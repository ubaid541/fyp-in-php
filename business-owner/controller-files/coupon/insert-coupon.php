<?php
include "../../includes/header.php";
// add coupon
if (isset($_POST['add_cpn'])) {
    include "../../config/config.php";
    // get data from input fields
    $coupon_name = mysqli_real_escape_string($conn, $_POST['cpn_name']);
    $coupon_name_upper = trim(strtoupper($coupon_name));
    $coupon_desc = mysqli_real_escape_string($conn, $_POST['cpn_desc']);
    $coupon_value = mysqli_real_escape_string($conn, $_POST['cpn_val']);
    $coupon_status = mysqli_real_escape_string($conn, $_POST['cpn_status']);
    $expiry_date = mysqli_real_escape_string($conn, $_POST['cpn_exp_date']);
    $business_id = $_SESSION['business_id'];
    $start_date = date("Y/m/d");
    $current_date = date("Y-m-d");

    // if fields are empty
    if ($coupon_name_upper == '' || $coupon_desc == '' || $coupon_value == '' || $expiry_date == '' || $coupon_status == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}coupons.php");
    } else {

        // check if coupon code already exist
        $sql = "SELECT coupon_name from coupon_code where coupon_name = '{$coupon_name_upper}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            //session_start();
            $_SESSION['error'] = "Coupon Already Exists.";
            header("location: {$hostname}coupons.php");
        } else {
            $sql1 = "INSERT into coupon_code(coupon_name,coupon_desc,coupon_value,coupon_expired,coupon_status,coupon_added_on,business_id) values ('{$coupon_name_upper}','{$coupon_desc}','{$coupon_value}','{$expiry_date}','{$coupon_status}','{$start_date}','{$business_id}');";
            if ($current_date > $expiry_date || $current_date == $expiry_date) {
                $sql1 .= "UPDATE coupon_code set coupon_status = 1 where business_id = {$_SESSION['business_id']}";
            }

            if (mysqli_multi_query($conn, $sql1)) {
                $_SESSION['status'] = "New coupon inserted.";
                header("Location: {$hostname}coupons.php");
            } else {
                $_SESSION['error'] = "Insertion Query Failed.";
                header("location: {$hostname}coupons.php");
            }
        }
    }
}



mysqli_close($conn);
