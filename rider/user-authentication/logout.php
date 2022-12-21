<?php

include "../config.php";

session_start();
$sql2 = "UPDATE rider set rider_status = 0 where rider_ID = {$_SESSION['rider_ID']}";
$exec = mysqli_query($conn, $sql2);
session_unset();
session_destroy();

header("Location: http://localhost/fatafut-mangwaen");
