<?php
include "../config.php";
include "../includes/header.php";


$p_id = mysqli_real_escape_string($conn, $_POST['id']);
$attr = mysqli_real_escape_string($conn, $_POST['attr']);
$addon = mysqli_real_escape_string($conn, $_POST['addon']);
$qty = mysqli_real_escape_string($conn, $_POST['qty']);
$discount = mysqli_real_escape_string($conn, $_POST['discount']);
$discount_val = mysqli_real_escape_string($conn, $_POST['discount_val']);
$type = mysqli_real_escape_string($conn, $_POST['type']);
$pprice = mysqli_real_escape_string($conn, $_POST['pprice']);
$aprice = mysqli_real_escape_string($conn, $_POST['aprice']);
$atprice = mysqli_real_escape_string($conn, $_POST['atprice']);
$shipping_charges = mysqli_real_escape_string($conn, $_POST['shipping_charges']);
date_default_timezone_set("Asia/Karachi");
$added_on = date('Y-m-d h:i:s A');
$user_id = $_SESSION['user_id'];
$business_id = mysqli_real_escape_string($conn, $_POST['business']);

// calculate total amount
$count_qty = $pprice * $qty;
$add_prices = $count_qty + $aprice + $atprice + $shipping_charges;
$sub_total = $add_prices - $discount_val;
$amount = 0;
$tamount = $sub_total + $amount;

// add to cart
if ($type == 'add') {
    // check if product already added to cart
    $res = mysqli_query($conn, "SELECT * from product_cart where user_ID = '$user_id' and product_ID = '$p_id'");
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        mysqli_query($conn, "UPDATE product_cart set qty = '$qty', sub_total = '$sub_total', total = '$tamount' where product_ID = '$p_id' ");
    } else {
        mysqli_query($conn, "INSERT into product_cart(product_ID,addon_ID,attr_ID,qty,discount_ID,sub_total,total,user_ID,business_id,added_on) values ('$p_id','$addon','$attr','$qty','$discount','$sub_total','$tamount','$user_id','$business_id','$added_on') ");
    }
}

// update cart
if ($type == 'update') {
    // check if product already added to cart
    $res = mysqli_query($conn, "SELECT * from product_cart where user_ID = '$user_id' and product_ID = '$p_id'");
    if (mysqli_num_rows($res) > 0) {
        $row = mysqli_fetch_assoc($res);
        mysqli_query($conn, "UPDATE product_cart set qty = '$qty',sub_total = '$sub_total', total = '$tamount' where product_ID = '$p_id' ");
    }
}



// delete product from cart
if ($type == 'delete') {
    $delete = mysqli_query($conn, "DELETE from product_cart where product_ID = '$p_id'");
}
