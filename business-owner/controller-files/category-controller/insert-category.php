<?php
include "../../includes/header.php";
// add category
if (isset($_POST['add_category'])) {
    include "../../config/config.php";
    // get data from input fields
    $category_name = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $business_id = $_SESSION['business_id'];
    $date = date("Y/m/d");

    // if fields are empty
    if ($category_name == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}category.php");
    } else {

        // check if category name already exist
        $sql = "SELECT product_cat_title from product_cat where product_cat_title = '{$category_name}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            //session_start();
            $_SESSION['error'] = "Category Already Exists.";
            header("location: {$hostname}category.php");
        } else {
            $sql1 = "insert into product_cat(product_cat_title,cat_date,business_id) values ('{$category_name}','{$date}','{$business_id}')";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "New category inserted.";
                header("Location: {$hostname}category.php");
            } else {
                $_SESSION['error'] = "Insertion Query Failed.";
                header("location: {$hostname}category.php");
            }
        }
    }
}



mysqli_close($conn);
