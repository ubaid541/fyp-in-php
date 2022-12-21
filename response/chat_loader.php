<?php

include "../config.php";
include "../includes/header.php"
?>

<?php
$receiver = $_GET['receive'];
$sender   = $_GET['send'];
$sql = "SELECT * FROM chat 
left join user on chat.outgoing_msg_id = user.user_id
left join rider on chat.outgoing_msg_id = rider.rider_ID
WHERE incomming_msg_id='$receiver' AND outgoing_msg_id='$sender' || outgoing_msg_id='$receiver' AND 
incomming_msg_id='$sender' ORDER BY msg_id ASC";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
        <div class="row message-scroll">
            <?php if ($receiver = $row['user_id']) { ?>
                <div class="col-12 pt-1 pb-1">
                    <div class="p-3 bg-success text-black mb-1 w-75 rounded-3">
                        <h6 class="text-white"><?php echo $row['text']; ?></h6>
                    </div>
                </div>
            <?php } ?>
        </div>

    <?php
    }
} else { ?>
    <h5>No message.</h5>
<?php } ?>