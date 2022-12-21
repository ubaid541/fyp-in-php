<?php
//session_start();
include "../includes/header.php";

if (isset($_POST['loginUser'])) {
    include "../config/config.php";

    if (empty($_POST['user_name']) || empty($_POST['password'])) {
        $_SESSION['error'] = "All fields must be filled.";
        header("location: {$hostname}");
    } else {
        $username = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = md5($_POST['password']);
        $role = mysqli_real_escape_string($conn, $_POST['role']);

        if ($role == 0) {
            $sql = "SELECT user_id,cust_username,user_role from user where cust_username = '{$username}' and pass = '{$password}'";

            $result = mysqli_query($conn, $sql) or die("Admin Query failed.");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION["username"] = $row['cust_username'];
                    $_SESSION["user_id"] = $row['user_id'];
                    $_SESSION["user_role"] = $row['user_role'];

                    header("Location: {$hostname}admin.php");
                }
            } else {
                $_SESSION['error'] = "Incorrect entries for admin.";
                header("location: {$hostname}");
                //         echo '<div class="alert alert-danger" role="alert">
                //     Incorrect entries.
                //    </div>';
            }
        } else if ($role == 1) {
            $sql = "SELECT business_id,username,user_role from business where username = '{$username}' and password = '{$password}' and user_role = '{$role}'";

            $result = mysqli_query($conn, $sql) or die("Seller Query failed.");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $_SESSION["username"] = $row['username'];
                    $_SESSION["business_id"] = $row['business_id'];
                    $_SESSION["user_role"] = $row['user_role'];

                    header("Location: {$hostname}admin.php");
                }
            } else {
                $_SESSION['error'] = "Incorrect entries for seller.";
                header("location: {$hostname}");
            }
        }
    }
}
