<?php
//session_start();
include "../includes/header.php";
if (isset($_POST['loginUser'])) {
    include "../config.php";

    if (empty($_POST['user_name']) || empty($_POST['password'])) {
        echo '<div class="alert alert-danger" role="alert">
       All fields must be filled.
      </div>';
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = md5($_POST['password']);

        $sql = "SELECT rider_ID,username,user_role from rider where username = '{$username}' and password = '{$password}'";

        $result = mysqli_query($conn, $sql) or die("Rider Query failed.");

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $_SESSION["username"] = $row['username'];
                $_SESSION["rider_ID"] = $row['rider_ID'];
                $_SESSION["user_role"] = $row['user_role'];

                header("Location: {$hostname}rider.php");
            }
            $sql2 = "UPDATE rider set rider_status = 1 where rider_ID = {$_SESSION['rider_ID']}";
            $exec = mysqli_query($conn, $sql2);
        } else {
            header("location: {$hostname}");
            echo '<div class="alert alert-danger" role="alert">
            Incorrect entries.
           </div>';
        }
    }
}
