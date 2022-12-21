<?php

include '../config.php';
$search_term = $_POST['product'];

$sql = "SELECT distinct(product_name) from products where product_name like '%{$search_term}%'";
$result = mysqli_query($conn, $sql) or die("search SQL query failed.");

$output = "<ul>";

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<a href='#' class='list-group-item list-group-item-action'>{$row['product_name']}</a>";
    }
} else {
    $output .= "<p class='list-group-item list-group-item-action' id='pro_list'>No record found.</p>";
}

$output .= "</ul>";

echo $output;
