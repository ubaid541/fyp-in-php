<?php
//delete category
include "../../config/config.php";
$Bcat_id = $_GET["id"];

$sql = "DELETE from business_category where business_cat_id = '{$Bcat_id}'";

if (mysqli_query($conn, $sql)) {
    header("location: {$hostname}/business-category.php");
}


mysqli_close($conn);
