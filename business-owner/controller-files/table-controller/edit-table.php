<?php
include "../../config/config.php";
session_start();
if (isset($_POST['update_table'])) {
    $table = mysqli_real_escape_string($conn, $_POST['tbl_name']);
    $chair_no = mysqli_real_escape_string($conn, $_POST['chair_no']);
    $tbl_id = mysqli_real_escape_string($conn, $_POST['tbl_id']);

    if ($table == '' || $chairs_no == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}table.php");
    } else {
        // check if input value already exists
        $sql = "SELECT tbl_name from tables where tbl_name = '{$table}' AND NOT tbl_id = '{$tbl_id}'";
        $result1 = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result1)) {
            // if input value already exists
            $_SESSION['error'] = "Table " . $table . " already exists.";
            header("Location: {$hostname}table.php");
        } else {
            // if input value not exists then update table
            $sql1 = "UPDATE tables set tbl_id = '{$_POST['tbl_id']}',
        tbl_name = '{$_POST['tbl_name']}', chair_no = '{$_POST['chair_no']}' where tbl_id = {$_POST['tbl_id']}";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Table successfully updated.";
                header("Location: {$hostname}table.php");
            }
        }
    }
}
