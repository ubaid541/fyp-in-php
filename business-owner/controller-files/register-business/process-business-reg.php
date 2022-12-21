<?php
include "../../includes/header.php";
if (isset($_POST['register_business'])) {
    include "../../config/config.php";


    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $business_name = mysqli_real_escape_string($conn, $_POST['business_name']);
    $business_city = mysqli_real_escape_string($conn, $_POST['business_city']);
    $business_type = mysqli_real_escape_string($conn, $_POST['business_type']);
    $business_category = mysqli_real_escape_string($conn, $_POST['business_cat']);
    $role = "1";
    $date = date("Y/m/d");

    // check if username already exists
    $sql = "SELECT business_name from business where business_name = '{$business_name}'";
    $result = mysqli_query($conn, $sql) or die("Query failed.");

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">
       Business name already exists.
      </div>';
    } else {
        $sql1 = "INSERT into business(first_name,last_name,username,email,b_phone,password,business_name,city,b_address,business_Type,business_category,business_reg_date,user_role) values ('{$fname}', '{$lname}', '{$username}', '{$email}', '{$phone}', '{$password}','{$business_name}','{$business_city}','{$address}', '{$business_type}', '{$business_category}', '{$date}', '{$role}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}");
        } else {
            echo '<div class="alert alert-danger" role="alert">
        Business Registeration failed.
      </div>';
        }
    }
}
