<?php
include "../config.php";

if ($_POST['type'] ==  "") {

    $sql = "SELECT business_id,business_name from business where tables = 1";
    $result = mysqli_query($conn, $sql) or die("Restaurant query failed.");

    $str = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $str .= "<option value='{$row['business_id']}'>{$row['business_name']}</option>";
    }
} else if ($_POST['type'] == "tblData") {
    $sql = "SELECT * from tables where business_id = {$_POST['id']}";
    $result = mysqli_query($conn, $sql) or die("Tables query failed.");

    $str = "";
    while ($row = mysqli_fetch_assoc($result)) {
        $str .= "<option value='{$row['tbl_id']}'>{$row['tbl_name']}</option>";
    }
}

echo $str;
