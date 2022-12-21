<?php
//delete category
include "../../config/config.php";

$pro_id = $_GET["id"];
$cat_id = $_GET["catid"];
$cpn_id = $_GET["cpnid"];
$sql1 = "SELECT * from products where pro_id = '{$pro_id}';";
$result = mysqli_query($conn, $sql1) or die("Query Failed: select");
$row = mysqli_fetch_assoc($result);

// delete image from folder
unlink("../../uploads/" . $row['product_image']);

$sql = "DELETE from products where pro_id = '{$pro_id}';";
$sql .= "UPDATE product_cat set pro_id = pro_id - 1 where product_cat_id = '{$cat_id}';";
$sql .= "UPDATE coupon_code set pro_id = pro_id - 1 where coupon_id = '{$cpn_id}';";


if (mysqli_multi_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "Product Successfully Deleted.";
    header("location: {$hostname}products.php");
} else {
    echo "Query failed";
}


mysqli_close($conn);
