<?php

include "../config.php";

$msg      = str_replace("'", "", $_POST['message']);
$receiver = $_POST['receive']; //incoming msg id
$sender   = $_POST['send']; //outgoing msg id
date_default_timezone_set("Asia/Karachi");
$time = date('h:i:s A');
$date = date("Y/m/d");

$sql = "INSERT INTO chat(incomming_msg_id,outgoing_msg_id,text,msg_time,msg_date)
VALUES ('$receiver','$sender','$msg','$time ','$date')";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "message sent";
} else {
    echo "An error occured.";
}
