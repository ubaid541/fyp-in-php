<?php
include "../../config/config.php";
session_start();
if (isset($_POST['update_business'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    //$password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
    $business_city = mysqli_real_escape_string($conn, $_POST['business_city']);
    $business_type = mysqli_real_escape_string($conn, $_POST['business_type']);
    $business_category = mysqli_real_escape_string($conn, $_POST['business_cat']);
    $business_id = mysqli_real_escape_string($conn, $_POST['business_id']);
    $tbl_reserve = mysqli_real_escape_string($conn, $_POST['tbl_reserve']);


    // if fields are empty
    if ($username == '' || $business_name == '' || $email == '' || $phone == '') {
        $_SESSION['error'] = "Not Updated. All fields must be filled.";
        header("Location: {$hostname}update-business-details.php");
    } else {
        // check if shift time already exist
        $sql = "SELECT * from business where (username = '{$username}' or email = '{$email}' or b_phone = '{$phone}' or business_name = '{$business_name}') AND NOT business_id = '{$business_id}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username, email, phone or business name already exists.";
            header("Location: {$hostname}update-business-details.php");
        } else {

            // if input value not exists the update business
            $sql1 = "UPDATE business set business_id = '{$_POST['business_id']}',
        first_name = '{$fname}', last_name = '{$lname}', username = '{$username}', email = '{$email}', b_phone = '{$phone}', business_name = '{$business_name}', city = '{$business_city}', b_address = '{$address}', business_Type = '{$business_type}', business_category = '{$business_category}',tables = '{$tbl_reserve}' where business_id = {$_POST['business_id']}";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Business info updated successfully.";
                header("Location: {$hostname}update-business-details.php");
            }
        }
    }
}
