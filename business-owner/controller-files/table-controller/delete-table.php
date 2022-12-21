<?php
//delete table
include "../../config/config.php";
$tbl_id = $_GET["id"];

$sql = "DELETE from tables where tbl_id = '{$tbl_id}'";

if (mysqli_query($conn, $sql)) {
    session_start();
    $_SESSION['status'] = "Table information successfully deleted.";
    header("location: {$hostname}table.php");
}


mysqli_close($conn);
