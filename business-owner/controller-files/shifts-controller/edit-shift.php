<?php
session_start();
if (isset($_POST['update_shift'])) {
    include "../../config/config.php";
    $shift_id = mysqli_real_escape_string($conn, $_POST['shift_id']);
    $shift_name = mysqli_real_escape_string($conn, $_POST['shift_name']);
    $shift_desc = mysqli_real_escape_string($conn, $_POST['shift_desc']);
    $start_time = mysqli_real_escape_string($conn, $_POST['start_time']);
    $change_start_time = date("g:iA", strtotime($start_time)); //convert to 12hours
    $end_time = mysqli_real_escape_string($conn, $_POST['end_time']);
    $change_end_time = date("g:iA", strtotime($end_time)); //convert to 12hours

    // check if shift time already exist
    $sql = "SELECT * from rider_shifts where (start_time = '{$change_start_time}' or end_time = '{$change_end_time}') AND NOT shift_id = '{$shift_id}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $_SESSION['error'] = "Shift time already exists.";
        header("Location: {$hostname}shifts.php");
    } else {
        // if input value not exists the update category
        $sql1 = "UPDATE rider_shifts set shift_id = '{$_POST['shift_id']}',
                        shift_name = '{$_POST['shift_name']}',shift_desc = '{$shift_desc}', start_time = '{$change_start_time}', end_time = '{$change_end_time}' where shift_id = {$_POST['shift_id']}";

        if (mysqli_query($conn, $sql1)) {
            $_SESSION['status'] = "Shift successfully updated.";
            header("Location: {$hostname}shifts.php");
        } else {
            $_SESSION['error'] = "Updation query failed.";
            header("Location: {$hostname}shifts.php");
        }
    }
}
