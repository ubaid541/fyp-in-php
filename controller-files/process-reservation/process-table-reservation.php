<?php

include "../../includes/header.php";
// reserve table
if (isset($_POST['reserve_table'])) {
    include "../../config.php";

    $restaurant = mysqli_real_escape_string($conn, $_POST['restaurant']);
    $date = mysqli_real_escape_string($conn, $_POST['reserve_date']);
    $start_time = mysqli_real_escape_string($conn, $_POST['reserve_start_time']);
    $change_start_time = date("g:iA", strtotime($start_time)); //convert to 12hours
    $end_time = mysqli_real_escape_string($conn, $_POST['reserve_end_time']);
    $change_end_time = date("g:iA", strtotime($end_time)); //convert to 12hours
    $table = mysqli_real_escape_string($conn, $_POST['tbl']);
    $num_of_people = mysqli_real_escape_string($conn, $_POST['num_of_people']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $user_id = $_SESSION['user_id'];

    // if fields are empty
    if ($restaurant == '' || $date == '' || $change_start_time == '' || $change_end_time == '' || $num_of_people == '' || $comment == '') {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}table-reservation.php");
    } else {
        // check if table already reserved
        $sql = "SELECT * from reservations where (tbl_id = '{$table}' and end_time > '{$change_start_time}')";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result)) {
            $_SESSION['error'] = "Table is not available for the selected time.";
            header("Location: {$hostname}table-reservation.php");
        } else {
            $sql1 = "INSERT into reservations(restaurant_id,date,start_time,end_time,people,comment,user_id,tbl_id) values({$restaurant},'{$date}','{$change_start_time}','{$change_end_time}',{$num_of_people},'{$comment}','{$user_id}','{$table}')";

            if (mysqli_query($conn, $sql1)) {
                $_SESSION['status'] = "Table Reserved.";
                header("Location: {$hostname}table-reservation.php");
            } else {
                $_SESSION['error'] = "Reservation query failed.";
                header("Location: {$hostname}table-reservation.php");
            }
        }
    }
}
