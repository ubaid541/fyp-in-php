<?php


if (isset($_POST['register_rider'])) {
    include "config.php";
    include "./includes/header.php";

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $username = mysqli_real_escape_string($conn, $_POST['user_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $city = mysqli_real_escape_string($conn, $_POST['rider_city']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $date = date("Y/m/d");
    $orders = 0;
    $role = "2";

    // check if username already exists
    $sql = "SELECT * from rider where username = '{$username}' and phone = '{$phone}'";
    $result = mysqli_query($conn, $sql) or die("Query failed.");

    if (mysqli_num_rows($result) > 0) {
        echo '<div class="alert alert-danger" role="alert">
       Username or password already exists.
      </div>';
    } else {
        $sql1 = "INSERT into rider(name,username,email,phone,password,address,city,rider_reg_date,orders,user_role) values ('{$name}', '{$username}', '{$email}', '{$phone}', '{$password}', '{$address}', '{$city}', '{$date}','{$orders}','{$role}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}");
        } else {
            echo  '<div class="alert alert-danger" role="alert">
        Rider registeration failed.
      </div>';
        }
    }
}
