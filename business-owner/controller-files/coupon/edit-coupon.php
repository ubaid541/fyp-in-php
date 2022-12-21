<?php
include "../../includes/header.php";
// add coupon
if (isset($_POST['update_coupon'])) {
    include "../../config/config.php";
    // get data from input fields
    $coupon_id = mysqli_real_escape_string($conn, $_POST['cpn_id']);
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
        $sql = "SELECT coupon_name from coupon_code where coupon_name = '{$coupon_name_upper}' and not coupon_id = '{$coupon_id}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            //session_start();
            $_SESSION['error'] = "Coupon Already Exists.";
            header("location: {$hostname}coupons.php");
        } else {
            $sql1 = "UPDATE coupon_code set coupon_id = '{$_POST['cpn_id']}', coupon_name = '{$_POST['cpn_name']}',coupon_desc = '{$_POST['cpn_desc']}',coupon_value = '{$_POST['cpn_val']}',coupon_expired = '{$_POST['cpn_exp_date']}',coupon_status = '{$_POST['cpn_status']}' where coupon_id = {$_POST['cpn_id']};";

            if ($current_date > $expiry_date || $current_date == $expiry_date || $_POST['cpn_status'] == 1) {
                $sql1 .= "UPDATE coupon_code set coupon_status = 1 where coupon_id = {$_POST['cpn_id']};";
            } else if ($current_date < $expiry_date || $current_date != $expiry_date || $_POST['cpn_status'] == 0) {
                $sql1 .= "UPDATE coupon_code set coupon_status = 0 where coupon_id = {$_POST['cpn_id']};";
            }

            if (mysqli_multi_query($conn, $sql1)) {
                $_SESSION['status'] = "Coupon Updated.";
                header("Location: {$hostname}coupons.php");
            } else {
                $_SESSION['error'] = "Update Query Failed.";
                header("location: {$hostname}coupons.php");
            }
        }
    }
}



mysqli_close($conn);
