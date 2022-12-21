<?php
include "../config.php";
include "../includes/header.php";
if (isset($_POST['contact'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);
    $date = date("Y/m/d");

    $sql = "SELECT contact_email from contact where contact_email = '{$email}'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['error'] = "Email Already Exists.";
        header("location: {$hostname}");
    } else {
        $sql = "INSERT into contact(contact_name,contact_email,contact_comment,contact_date) values ('{$name}','{$email}','{$comment}','{$date}') ";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['status'] = "Message submitted.";
            header("Location: {$hostname}");
        } else {
            $_SESSION['error'] = "Insertion Query Failed.";
            header("Location: {$hostname}");
        }
    }
}
