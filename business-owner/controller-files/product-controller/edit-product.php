<?php
include "../../config/config.php";
session_start();
// update product
if (empty($_FILES['new_pro_image']['name'])) {
    $new_name = $_POST['old_pro_image'];
} else {
    $errors = array();

    // uploaded image info
    $file_name = $_FILES['new_pro_image']['name'];
    $file_size = $_FILES['new_pro_image']['size'];
    $file_tmp = $_FILES['new_pro_image']['tmp_name'];
    $file_type = $_FILES['new_pro_image']['type'];
    $temp = explode('.', $file_name);
    $file_ext = strtolower(end($temp));
    $extensions = array("jpeg", "jpg", "png");

    // file extension should be as given in $extensions
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This file type is not allowed, Kindly upload JPG,JPEG or PNG file.";
    }

    // file size restriction = 2mb
    if ($file_size > 2097152) {
        $errors[] = "File size must be 2mb or lower.";
    }

    $new_name = time() . "-" . basename($file_name);
    $target = "../../uploads/" . $new_name; //add data with image name to avoid similarity
    $image_name = $new_name;

    //if no errors found then upload image
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $target);
    } else {
        print_r($errors);
        die();
    }
}

$sql = "UPDATE products set product_name = '{$_POST["pro_name"]}', product_description = '{$_POST["pro_desc"]}', product_price = '{$_POST["pro_price"]}', discount = '{$_POST["pro_discount"]}', product_category = '{$_POST["pro_cat"]}', product_image = '{$image_name}', product_tax = '{$_POST["pro_tax"]}', product_addons = '{$_POST["pro_addon"]}', product_attr = '{$_POST["pro_attr"]}' WHERE pro_id = {$_POST["pro_id"]};";
if ($_POST['old_cat'] != $_POST['pro_cat']) {
    $sql .= "UPDATE product_cat set pro_id = pro_id - 1 where product_cat_id = {$_POST['old_cat']};";
    $sql .= "UPDATE product_cat set pro_id = pro_id + 1 where product_cat_id = {$_POST['pro_cat']};";
}
if ($_POST['old_discount'] != $_POST['pro_discount']) {
    $sql .= "UPDATE coupon_code set pro_id = pro_id - 1 where coupon_id = {$_POST['old_discount']};";
    $sql .= "UPDATE coupon_code set pro_id = pro_id + 1 where coupon_id = {$_POST['pro_discount']};";
}


$result = mysqli_multi_query($conn, $sql);

if ($result) {
    $_SESSION['status'] = "Product updated.";
    header("location: {$hostname}products.php");
} else {
    $_SESSION['error'] = "Update Query failed.";
    header("location: {$hostname}products.php");
}
