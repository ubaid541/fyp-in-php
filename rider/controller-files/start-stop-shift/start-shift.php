<?php
//start shift
include "../../config.php";
session_start();
$shift_id = $_GET["id"];
$rider_id = $_SESSION['rider_ID'];

$sql = "UPDATE rider set shift = '$shift_id' where rider_ID = '{$rider_id}'";

if (mysqli_query($conn, $sql)) {
    header("Location: {$hostname}shifts.php");
}

mysqli_close($conn);
