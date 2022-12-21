<?php
include "../config/config.php";
if (!isset($_SESSION)) {
    session_start();
}

$select_all = mysqli_query($conn, "SELECT notify from product_order where business_id = {$_SESSION['business_id']} and notify = 0 ");

if (mysqli_num_rows($select_all) > 0) {
    while ($row = mysqli_fetch_assoc($select_all)) {
        $sql =  "UPDATE product_order set notify = 1 where business_id = {$_SESSION['business_id']}";
        $result = mysqli_query($conn, $sql);
    }
}
if ($result) {
    echo 1;
} else {
    echo 0;
}
