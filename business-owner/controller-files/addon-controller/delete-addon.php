<?php
//delete addon
include "../../config/config.php";
$addon_id = $_GET["id"];

$sql = "DELETE from product_addons where addon_ID = '{$addon_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "Addon Deleted successfully.";
    header("location: {$hostname}addons.php");
}


mysqli_close($conn);
