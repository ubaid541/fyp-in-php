<?php
//session_start();
include "../includes/header.php";
if (isset($_POST['loginUser'])) {
    include "../config.php";

    if (empty($_POST['user_name']) || empty($_POST['password'])) {
        $_SESSION['error'] = "All fields must be filled.";
        header("Location: {$hostname}");
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = md5($_POST['password']);

        $sql = "SELECT user_id,cust_username from user where cust_username = '{$username}' and pass = '{$password}'";
        $result = mysqli_query($conn, $sql) or die("Admin Query failed.");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["username"] = $row['cust_username'];
                $_SESSION["user_id"] = $row['user_id'];
                header("Location: {$hostname}");
            }
            $sql2 = "UPDATE user set status = 1 where user_id = {$_SESSION['user_id']}";
            $exec = mysqli_query($conn, $sql2);
        } else {
            $_SESSION['error'] = "Incorrect Entries.";
            header("Location: {$hostname}login.php");
        }
    }
}
