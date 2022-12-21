<?php
include "../../includes/header.php";
// add shift
if (isset($_POST['add_shift'])) {
    include "../../config/config.php";
    // get data from input fields
    $shift_name = mysqli_real_escape_string($conn, $_POST['shift_name']);
    $shift_desc = mysqli_real_escape_string($conn, $_POST['shift_desc']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $change_start_time = date("g:iA", strtotime($start_time)); //convert to 12hours
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
    $change_end_time = date("g:iA", strtotime($end_time)); //convert to 12hours
    $date = date("Y/m/d");

    // check if shift time already exist
    $sql = "SELECT * from rider_shifts where start_time = '{$change_start_time}' and end_time = '{$change_end_time}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<p class="alert alert-danger" role="alert">Shift time already exits.</p>';
    } else {
        $sql1 = "INSERT into rider_shifts(shift_name,shift_desc,start_time,end_time,shift_date) values ('{$shift_name}','{$shift_desc}',
        '{$change_start_time}','{$change_end_time}','{$date}')";


        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}shifts.php");
        } else {
            echo '<p class="alert alert-danger" role="alert">Insert Query failed.</p>';
        }
    }
}



mysqli_close($conn);
