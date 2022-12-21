<?php
include "../includes/header.php";
if (isset($_POST['register_customer'])) {
    include "../config.php";


    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $customer_city = mysqli_real_escape_string($conn, $_POST['business_city']);
    $role = "3";
    $date = date("Y/m/d");

    // check if username already exists
    $sql = "SELECT cust_username,email from user where cust_username = '{$username}' or email = '{$email}'";
    $result = mysqli_query($conn, $sql) or die("Query failed.");

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Username or email already exists.";
        header("Location: {$hostname}register-customer.php");
    } else {

        if (is_numeric($fname) || is_numeric($lname) || is_numeric($username)) {
            $_SESSION['error'] = "Only english characters acceptable.";
            header("Location: {$hostname}register-customer.php");
            die();
        }
        if (strpos($email, "@") === false) {
            $_SESSION['error'] = "Email must have an at-sign (@)";
            header("Location: {$hostname}register-customer.php");
            die();
        }

        $sql1 = "INSERT into user(first_name,last_name,cust_username,email,phone,pass,city,address,date,user_role) values ('{$fname}', '{$lname}', '{$username}', '{$email}', '{$phone}', '{$password}','{$customer_city}','{$address}', '{$date}', '{$role}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}");
        } else {
            $_SESSION['error'] = "User registeration failed.";
            header("Location: {$hostname}register-customer.php");;
        }
    }
}
