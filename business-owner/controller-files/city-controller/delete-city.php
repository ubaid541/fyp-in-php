<?php
//delete category
include "../../config/config.php";
$city_id = $_GET["id"];

$sql = "DELETE from city where city_id = '{$city_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "City Deleted successfully.";
    header("location: {$hostname}cities.php");
}


mysqli_close($conn);
