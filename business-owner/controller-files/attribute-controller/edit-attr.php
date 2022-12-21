<?php
include "../../config/config.php";
session_start();
if (isset($_POST['update_attr'])) {
    $attr = mysqli_real_escape_string($conn, $_POST['attr_name']);
    $attr_price = mysqli_real_escape_string($conn, $_POST['attr_price']);
    $attr_id = mysqli_real_escape_string($conn, $_POST['attr_ID']);

    // if fields are empty
    if ($attr == '' || $attr_price == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}attributes.php");
    } else {
        // check if text entered instead of price
        if (!is_numeric($attr_price)) {
            $_SESSION['error'] = "Not Updated. Only numbers allowed in price.";
            header("Location: {$hostname}attributes.php");
        } else {

            // check if input value already exists
            $sql = "SELECT attr_Name from product_attributes where attr_Name = '{$attr}' AND NOT attr_ID = '{$attr_id}'";
            $result1 = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result1) > 0) {
                // if input value already exists
                $_SESSION['error'] = "Attribute " . $attr . " already exists.";
                header("Location: {$hostname}attributes.php");
            } else {
                // if input value not exists then update attribute
                $sql1 = "UPDATE product_attributes set attr_ID = '{$_POST['attr_ID']}',
                                attr_Name = '{$_POST['attr_name']}', attr_price = '{$_POST['attr_price']}' where attr_ID = {$_POST['attr_ID']}";

                if (mysqli_query($conn, $sql1)) {
                    $_SESSION['status'] = "Attribute successfully updated.";
                    header("Location: {$hostname}attributes.php");
                }
            }
        }
    }
}
