<?php
include "../../includes/header.php";
// add business type
if (isset($_POST['add_bType'])) {
    include "../../config/config.php";
    // get data from input fields
    $bType_name = mysqli_real_escape_string($conn, $_POST['bType_name']);
    $date = date("Y/m/d");

    // check if type already exist
    $sql = "select business_type_name from business_type where business-type = '{$bType_name}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<p class="alert alert-danger" role="alert">Type already exits.</p>';
    } else {
        $sql1 = "INSERT into business_type (business_type_name,business_type_date) values ('{$bType_name}','{$date}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}/business-type.php");
        } else {
            echo '<p class="alert alert-danger" role="alert">Query failed.</p>';
        }
    }
}



mysqli_close($conn);
