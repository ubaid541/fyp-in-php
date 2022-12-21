<?php
include "../../config/config.php";
session_start();
if (isset($_POST['update_category'])) {
    $category = mysqli_real_escape_string($conn, $_POST['cat_name']);
    $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);

    // if fields are empty
    if ($category_name == '') {
        $_SESSION['error'] = "Not Updated. All fields must be filled.";
        header("Location: {$hostname}category.php");
    } else {
        // check if input value already exists
        $sql = "SELECT product_cat_title from product_cat where product_cat_title = '{$category}' AND NOT product_cat_id = '{$cat_id}'";
        $result1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result1)) {
            // if input value already exists
            //echo '<p class="alert alert-danger" role="alert">Category ' . $category . ' already exists.</p>';
            $_SESSION['error'] = "Category " . $category . " already exists.";
            header("Location: {$hostname}category.php");
        } else {
            // if input value not exists the update category
            $sql1 = "UPDATE product_cat set product_cat_id = '{$_POST['cat_id']}',
                                product_cat_title = '{$_POST['cat_name']}' where product_cat_id = {$_POST['cat_id']}";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Category successfully updated.";
                header("Location: {$hostname}category.php");
            }
        }
    }
}
