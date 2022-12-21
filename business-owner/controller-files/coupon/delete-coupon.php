<?php
//delete category
include "../../config/config.php";
$coupon_id = $_GET["id"];

$sql = "DELETE from coupon_code where coupon_id = '{$coupon_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['error'] = "Coupon deleted.";
    header("location: {$hostname}coupons.php");
}


mysqli_close($conn);
