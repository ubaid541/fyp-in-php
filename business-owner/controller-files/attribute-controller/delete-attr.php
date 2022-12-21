<?php
//delete addon
include "../../config/config.php";
$attr_id = $_GET["id"];

$sql = "DELETE from product_attributes where attr_ID = '{$attr_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "Attribute deleted successfully.";
    header("location: {$hostname}attributes.php");
}


mysqli_close($conn);
