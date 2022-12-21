<?php
//delete addon
include "../../config/config.php";
$bType_id = $_GET["id"];

$sql = "DELETE from  business_type where business_type_id = '{$bType_id}'";

if (mysqli_query($conn, $sql)) {
    header("location: {$hostname}/business-type.php");
}


mysqli_close($conn);
