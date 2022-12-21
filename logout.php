<?php

include "config.php";

session_start();

$sql1 = "UPDATE user set status = 0 where user_id = {$_SESSION['user_id']}";
$exec = mysqli_query($conn, $sql1);

session_unset();
session_destroy();

$sql1 = "UPDATE user set status = 0 where user_id = {$_SESSION['user_id']}";
$exec = mysqli_query($conn, $sql1);

header("Location: {$hostname}");
