<?php
//delete table
include "../../config/config.php";
$rsvr_id = $_GET["id"];

$sql = "DELETE from reservations where rsvr_id = '{$rsvr_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "Reservation successfully deleted.";
    header("location: {$hostname}reservations.php");
}


mysqli_close($conn);
