<?php
if (isset($_POST['register_admin'])) {
    include "./config/config.php";

    $fname = mysqli_real_escape_string($conn, $_POST['first_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['last_name']);
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $date = date("Y/m/d");
    $role = "0";

    // check if username already exists
    $sql = "SELECT cust_username from user where cust_username = '{$username}'";
    $result = mysqli_query($conn, $sql) or die("Query failed.");

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">
       Username already exists.
      </div>';
    } else {
        $sql1 = "INSERT into user(first_name,last_name,cust_username,email,phone,pass,address,date,user_role) values ('{$fname}', '{$lname}', '{$username}', '{$email}', '', '{$password}', '', '{$date}','{$role}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}");
        } else {
            echo '<div class="alert alert-danger" role="alert">
        Admin registeration failed.
      </div>';
        }
    }
}
