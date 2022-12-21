<?php
include "../config.php";
include "../includes/header.php";

if (isset($_POST['place_order'])) {
    $items =  array();
    $shipp_address = mysqli_real_escape_string($conn, $_POST['shipp_address']);
    $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
    $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
    $addon_id = mysqli_real_escape_string($conn, $_POST['addon_id']);
    $attr_id = mysqli_real_escape_string($conn, $_POST['attr_id']);
    $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
    $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
    $payment_status = 0;
    $order_status = 0;
    date_default_timezone_set("Asia/Karachi");
    $added_on = date('Y-m-d h:i:s A');
    $user_id = $_SESSION['user_id'];
    $rider = 0;

    $sql1 = "SELECT * from product_cart where user_ID = {$_SESSION['user_id']}";
    $run = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($run) > 0) {
        while ($row = mysqli_fetch_assoc($run)) {

            $items[$row['cart_ID']]['product_ID'] = $row['product_ID'];
            $items[$row['cart_ID']]['qty'] = $row['qty'];
            $items[$row['cart_ID']]['business_id'] = $row['business_id'];
            $items[$row['cart_ID']]['addon_ID'] = $row['addon_ID'];
            $items[$row['cart_ID']]['attr_ID'] = $row['attr_ID'];
            $items[$row['cart_ID']]['user_id'] = $user_id;
            $items[$row['cart_ID']]['discount_ID'] = $row['discount_ID'];
        }
    }


    if (is_array($items)) {
        foreach ($items as  $row => $value) {
            $item_name = mysqli_real_escape_string($conn, $value['product_ID']);
            $qty = mysqli_real_escape_string($conn, $value['qty']);
            $business_id = mysqli_real_escape_string($conn, $value['business_id']);
            $attr_ID = mysqli_real_escape_string($conn, $value['attr_ID']);
            $addon_ID = mysqli_real_escape_string($conn, $value['addon_ID']);
            $user_id = mysqli_real_escape_string($conn, $value['user_id']);
            $shipp_address = mysqli_real_escape_string($conn, $_POST['shipp_address']);
            $user_phone = mysqli_real_escape_string($conn, $_POST['user_phone']);
            $user_email = mysqli_real_escape_string($conn, $_POST['user_email']);
            $addon_id = mysqli_real_escape_string($conn, $_POST['addon_id']);
            $attr_id = mysqli_real_escape_string($conn, $_POST['attr_id']);
            $discount = mysqli_real_escape_string($conn, $value['discount_ID']);
            $total_amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
            $payment_method = mysqli_real_escape_string($conn, $_POST['payment_method']);
            $payment_status = 0;
            $order_status = 0;
            date_default_timezone_set("Asia/Karachi");
            $added_on = date('Y-m-d h:i:s A');
            $user_id = $_SESSION['user_id'];
            $rider = 0;
            $notify = 0;
            $sql2 = "INSERT into product_order(product_ID,product_quantity,addon_ID,attr_ID,discount,total_amount,product_payment_method,product_payment_status,product_order_status,product_order_date,address,contact_num,email,user_id,business_id,rider,notify) 
            values('$item_name','$qty','$addon_ID','$attr_ID','$discount','$total_amount','$payment_method','$payment_status','$order_status','$added_on','$shipp_address','$user_phone','$user_email','$user_id','$business_id','$rider','$notify')";
            mysqli_query($conn, $sql2);
            // echo $sql2;
            // die();
        }
    }

    $sql3 = "DELETE from product_cart where user_id = '$user_id'";

    if (mysqli_query($conn, $sql3)) {
        header("location: {$hostname}order-history.php");
    }
}
