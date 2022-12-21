<?php
include "../../includes/header.php";
// add category
if (isset($_POST['add_Bcategory'])) {
    include "../../config/config.php";
    // get data from input fields
    $Bcategory_name = mysqli_real_escape_string($conn, $_POST['Bcat_name']);
    $date = date("Y/m/d");

    // check if category name already exist
    $sql = "select business_cat_title from business_category where business_cat_title = '{$Bcategory_name}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<p class="alert alert-danger" role="alert">Business category already exits.</p>';
    } else {
        $sql1 = "insert into business_category(business_cat_title,business_date) values ('{$Bcategory_name}','{$date}')";

        if (mysqli_query($conn, $sql1)) {
            header("Location: {$hostname}business-category.php");
        } else {
            echo '<p class="alert alert-danger" role="alert">Query fialed.</p>';
        }
    }
}



mysqli_close($conn);
