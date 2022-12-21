<?php
include "../../includes/header.php";
// add table
if (isset($_POST['add_tbl'])) {
    include "../../config/config.php";
    // get data from input fields
    //session_start();
    $table_name = mysqli_real_escape_string($conn, $_POST['tbl_name']);
    $chairs_num = mysqli_real_escape_string($conn, $_POST['chair_no']);
    $date = date("Y/m/d");
    $business_id = $_SESSION['business_id'];

    // if fields are empty
    if ($table_name == '' || $chairs_num == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}table.php");
    } else {
        // check if category name already exist
        $sql = "select tbl_name from tables where tbl_name = '{$table_name}'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['error'] = "Table Already Exists.";
            header("Location: {$hostname}table.php");
        } else {
            $sql1 = "insert into tables(tbl_name,tbl_date,chair_no,business_id) values ('{$table_name}','{$date}','{$chairs_num}','{$business_id}')";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "New table added.";
                header("Location: {$hostname}table.php");
            } else {
                $_SESSION['error'] = "Query failed.";
                header("Location: {$hostname}table.php");
            }
        }
    }
}



mysqli_close($conn);
