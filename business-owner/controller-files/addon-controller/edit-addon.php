<?php
include "../../config/config.php";
session_start();
if (isset($_POST['update_addon'])) {
    $addon = mysqli_real_escape_string($conn, $_POST['addon_name']);
    $addon_price = mysqli_real_escape_string($conn, $_POST['addon_price']);
    $addon_id = mysqli_real_escape_string($conn, $_POST['addon_ID']);

    // if fields are empty
    if ($addon == '' || $addon_price == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}addons.php");
    } else {

        // check if input value already exists
        $sql = "SELECT addon_name from product_addons where addon_name = '{$addon}' AND NOT addon_ID = '{$addon_id}'";
        $result1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result1) > 0) {
            // if input value already exists
            $_SESSION['error'] = "Addon " . $addon . " already exists.";
            header("Location: {$hostname}addons.php");
        } else {
            // if input value not exists then update addon
            $sql1 = "UPDATE product_addons set addon_ID = '{$_POST['addon_ID']}',
                                addon_name = '{$_POST['addon_name']}', addon_price = '{$_POST['addon_price']}' where addon_ID = {$_POST['addon_ID']}";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Addon successfully updated.";
                header("Location: {$hostname}addons.php");
            }
        }
    }
}
