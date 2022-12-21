<?php
//include "../../includes/header.php";
include "../../config/config.php";
// add product
if (isset($_FILES['pro_image'])) {
    $errors = array();

    // uploaded image info
    $file_name = $_FILES['pro_image']['name'];
    $file_size = $_FILES['pro_image']['size'];
    $file_tmp = $_FILES['pro_image']['tmp_name'];
    $file_type = $_FILES['pro_image']['type'];
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

    //if no errors found then upload image
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, $target);
    } else {
        print_r($errors);
        die();
    }
}


// get data from input fields
session_start();
$product_name = mysqli_real_escape_string($conn, $_POST['pro_name']);
$product_desc = mysqli_real_escape_string($conn, $_POST['pro_desc']);
$product_price = mysqli_real_escape_string($conn, $_POST['pro_price']);
$product_discount = mysqli_real_escape_string($conn, $_POST['pro_discount']);
$product_addon = mysqli_real_escape_string($conn, $_POST['pro_addon']);
$product_attr = mysqli_real_escape_string($conn, $_POST['pro_attr']);
$product_category = mysqli_real_escape_string($conn, $_POST['pro_cat']);
$product_tax = mysqli_real_escape_string($conn, $_POST['pro_tax']);
$date = date("Y/m/d");
$business_id = $_SESSION['business_id'];

// check if product name already exist
$sql = "SELECT product_name from products where product_name = '{$product_name}'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $_SESSION['error'] = "Product Already Exists.";
    header("location: {$hostname}products.php");
} else {

    if (!is_string($product_name) || !is_string($product_desc)) {
        $_SESSION['error'] = "Only english characters acceptable.";
        header("location: {$hostname}add-product.php");
        die();
    }

    $sql1 = "INSERT into products(product_name,product_description,product_price,discount,product_category,product_image,product_tax,product_addons,product_attr,pro_date,business_id) values ('{$product_name}','{$product_desc}','{$product_price}','{$product_discount}','{$product_category}','{$new_name}','{$product_tax}','{$product_addon}','{$product_attr}','{$date}','{$business_id}');";
    $sql1 .= "UPDATE product_cat set pro_id = pro_id + 1 where product_cat_id = {$product_category};";
    $sql1 .= "UPDATE coupon_code set pro_id = pro_id + 1 where coupon_id = {$product_discount};";

    if (mysqli_multi_query($conn, $sql1)) {
        $_SESSION['status'] = "New Product Added.";
        header("location: {$hostname}products.php");
    } else {
        $_SESSION['error'] = "Insertion Query failed.";
        header("location: {$hostname}products.php");
    }
}


mysqli_close($conn);
