<?php
//delete category
include "../../config/config.php";
$shift_id = $_GET["id"];

$sql = "DELETE from rider_shifts where shift_id = '{$shift_id}'";

if (mysqli_query($conn, $sql)) {
    header("location: {$hostname}shifts.php");
}


mysqli_close($conn);
