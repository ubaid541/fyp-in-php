<?php
include "../config.php";
session_start();
if (isset($_POST['update_user'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    //$password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $user_city = mysqli_real_escape_string($conn, $_POST['user_city']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // if fields are empty
    if ($username == '' || $email == '' || $phone == '') {
        $_SESSION['error'] = "Not Updated. All fields must be filled.";
        header("Location: {$hostname}user-account.php");
    } else {
        if (is_numeric($fname) || is_numeric($lname) || is_numeric($username)) {
            $_SESSION['error'] = "Only english characters acceptable.";
            header("Location: {$hostname}user-account.php");
            die();
        }
        if (strpos($email, "@") === false) {
            $_SESSION['error'] = "Email must have an at-sign (@)";
            header("Location: {$hostname}user-account.php");
            die();
        }
        // check if this information already exist
        $sql = "SELECT * from user where (cust_username = '{$username}' or email = '{$email}' or phone = '{$phone}') AND NOT user_id = '{$user_id}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username, email, phone already exists.";
            header("Location: {$hostname}user-account.php");
        } else {

            // if input value not exists the update user
            $sql1 = "UPDATE user set first_name = '{$fname}', last_name = '{$lname}', cust_username = '{$username}', email = '{$email}', phone = '{$phone}', city = '{$user_city}', address = '{$address}' where user_id = {$_POST['user_id']}";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Your info updated successfully.";
                header("Location: {$hostname}user-account.php");
            }
        }
    }
}
