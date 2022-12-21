<?php
include "../../includes/header.php";
// add city
if (isset($_POST['add_city'])) {
    include "../../config/config.php";
    // get data from input fields
    $city_name = mysqli_real_escape_string($conn, $_POST['city_name']);
    $city_tagline = mysqli_real_escape_string($conn, $_POST['city_tagline']);
    if (strlen($city_tagline) > 20) {
        $city_tagline_trimmed = substr($city_tagline, 0, 20);
    } else {
        $city_tagline_trimmed =  $_POST['city_tagline'];
    }
    $date = date("Y/m/d");

    // check if city name already exist
    $sql = "select city_name from city where city_name = '{$city_name}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<p class="alert alert-danger" role="alert">City already exits.</p>';
    } else {
        $sql1 = "insert into city(city_name,city_tagline,city_date) values ('{$city_name}','{$city_tagline_trimmed}','{$date}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}/cities.php");
        } else {
            echo '<p class="alert alert-danger" role="alert">Query fialed.</p>';
        }
    }
}



mysqli_close($conn);
