<?php
include "../config.php";
session_start();
if (isset($_POST['update_rider'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $rider_city = mysqli_real_escape_string($conn, $_POST['rider_city']);
    $rider_id = mysqli_real_escape_string($conn, $_POST['rider_id']);

    // if fields are empty
    if ($username == '' || $name == '' || $email == '' || $phone == '') {
        $_SESSION['error'] = "Not Updated. All fields must be filled.";
        header("Location: {$hostname}update-rider-details.php");
    } else {
        // check if shift time already exist
        $sql = "SELECT * from rider where (username = '{$username}' or email = '{$email}' or phone = '{$phone}'s) AND NOT rider_ID = '{$rider_id}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Username, email or phone already exists.";
            header("Location: {$hostname}update-rider-details.php");
        } else {

            // if input value not exists the update business
            $sql1 = "UPDATE rider set name = '{$name}', username = '{$username}', email = '{$email}', phone = '{$phone}', city = '{$rider_city}', address = '{$address}' where rider_ID = {$rider_id}";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Rider info updated successfully.";
                header("Location: {$hostname}update-rider-details.php");
            }
        }
    }
}
