<?php
include "../../includes/header.php";
session_start();
// add category
if (isset($_POST['add_addon'])) {
    include "../../config/config.php";
    // get data from input fields
    $addon_name = mysqli_real_escape_string($conn, $_POST['addon_name']);
    $addon_price = mysqli_real_escape_string($conn, $_POST['addon_price']);
    $date = date("Y/m/d");
    $business_id = $_SESSION['business_id'];

    // if fields are empty
    if ($addon_name == '' || $addon_price == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}addons.php");
    } else {

        // check if category name already exist
        $sql = "SELECT addon_name from product_addons where addon_name = '{$addon_name}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Addon Already Exists.";
            header("location: {$hostname}addons.php");
        } else {
            $sql1 = "INSERT into product_addons(addon_name,addon_price,add_date,business_id) values ('{$addon_name}','{$addon_price}','{$date}',{$business_id})";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "New addon added.";
                header("Location: {$hostname}addons.php");
            } else {
                $_SESSION['error'] = "Insertion Query Failed.";
                header("Location: {$hostname}addons.php");
            }
        }
    }
}



mysqli_close($conn);
