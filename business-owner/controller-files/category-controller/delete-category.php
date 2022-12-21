<?php
//delete category
include "../../config/config.php";
$cat_id = $_GET["id"];

$sql = "DELETE from product_cat where product_cat_id = '{$cat_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['error'] = "Category deleted.";
    header("location: {$hostname}category.php");
}


mysqli_close($conn);
