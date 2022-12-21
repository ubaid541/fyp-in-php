<?php
include "../../includes/header.php";
// add category
if (isset($_POST['add_attr'])) {
    include "../../config/config.php";
    // get data from input fields
    $attr_name = mysqli_real_escape_string($conn, $_POST['attr_name']);
    $attr_price = mysqli_real_escape_string($conn, $_POST['attr_price']);
    $business_id = $_SESSION['business_id'];
    $date = date("Y/m/d");

    // check if input fields are empty
    if ($attr_name == '' || $attr_price == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}attributes.php");
    } else {

        // check if attribute already exist
        $sql = "select attr_Name from product_attributes where attr_Name = '{$attr_name}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Attribute " . $attr_name . " already Exists.";
            header("Location: {$hostname}attributes.php");
        } else {
            $sql1 = "INSERT into product_attributes(attr_Name,attr_price,attr_date,business_id) values ('{$attr_name}','{$attr_price}','{$date}',{$business_id})";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "New attribute added.";
                header("Location: {$hostname}attributes.php");
            } else {
                $_SESSION['error'] = "Insertion Query Failed.";
                header("Location: {$hostname}attributes.php");
            }
        }
    }
}



mysqli_close($conn);
