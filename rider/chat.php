<?php

include './includes/header.php';
include './includes/top-bar.php';
include './includes/sidebar.php';


if (!isset($_GET['sender']) && $_GET['reciever'] == null) {
    echo "no chat";
} else {
    $sender   = $_GET['sender'];
    $receiver = $_GET['reciever'];;
}


?>


<!-- main page content starts here -->
<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <!-- Getting Sender & Receiver Id through hidden inputs -->
    <input type="hidden" id="receive" value="<?php echo $receiver; ?>">
    <input type="hidden" id="send" value="<?php echo $sender; ?>">
    <div class="container-fluid">
        <!-- page headings starts -->
        <div class="page-heading">
            <div class="row">
                <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-5">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-filter"></i>Chats
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Chats
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page headings ends -->

        <!-- chat area starts here -->
        <div class="row">
            <div class="row">
                <!-- Senders area starts -->
                <div class="col-lg-4 mb-4">
                    <!-- Chats Card -->
                    <div class="card shadow mb-4 h-100">
                        <div class="card-header py-3">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-customer-tab" data-bs-toggle="pill" data-bs-target="#pills-customer" type="button" role="tab" aria-controls="pills-customer" aria-selected="false"> <i class="bi bi-people me-2"></i>Customer</button>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-rider" role="tabpanel" aria-labelledby="pills-rider-tab">
                                    <div class="list-group list-group-flush chat-list">
                                        <?php
                                        $customer = mysqli_query($conn, "SELECT distinct product_order.user_id,product_order.rider,user.*,rider.* 
                                        from product_order
                                        left join user on product_order.user_id = user.user_id
                                        left join rider on product_order.rider = rider.rider_ID
                                        where product_order.rider = {$_SESSION['rider_ID']} and product_order_status = 0");
                                        if (mysqli_num_rows($customer) > 0) {
                                            while ($row = mysqli_fetch_assoc($customer)) {
                                        ?>
                                                <a href="chat.php?sender=<?php echo $row['rider_ID'] ?>&reciever=<?php echo $row['user_id']; ?>" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                                    <div>
                                                        <h6 class="mt-2"><?php echo $row['cust_username']; ?></h6>
                                                    </div>
                                                    <div>
                                                        <?php if ($row['status'] == 1) { ?>
                                                            <h6 class="mt-2 text-success">Online</h6>
                                                        <?php } else { ?>
                                                            <h6 class="mt-2 text-danger">Offline</h6>
                                                        <?php } ?>
                                                    </div>
                                                </a>
                                        <?php }
                                        } ?>
                                    </div>
                                </div>
                                <!-- <div class="tab-pane fade" id="pills-customer" role="tabpanel" aria-labelledby="pills-customer-tab">
                                    <div class="list-group list-group-flush chat-list">
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                        <a href="#" class="list-group-item list-group-item-action  d-flex justify-content-between" aria-current="true">
                                            <div>
                                                <img class="avatar" src="/assets/images/avatar/male-avatar.png" alt="avatar">
                                            </div>
                                            <div>
                                                <h6 class="mt-2">Hassan</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Senders area ends -->

                <!-- Messages column -->
                <div class="col-lg-8 mb-2">
                    <div class="card shadow mb-4 h-100">
                        <div class="card-header py-3">
                            <?php
                            $name = mysqli_query($conn, "SELECT * from user where user_id = '$receiver'");
                            $exec = mysqli_fetch_assoc($name);
                            ?>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="mt-2"><?php echo $exec['cust_username']; ?></h6>
                                </div>
                                <div>
                                    <?php if ($exec['status'] == 1) { ?>
                                        <h6 class="mt-2 text-success">Online</h6>
                                    <?php } else { ?>
                                        <h6 class="mt-2 text-success">Offline</h6>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div id="chat_load"></div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Messages column ends -->
        </div>
    </div>
    <!-- reply starts -->
    <div class="row">
        <div class="col-lg-4 mb-4 ">
        </div>
        <div class="col-lg-8 mb-4">
            <div class="card shadow">
                <div class="card-body">
                    <form method="POST" id="chatForm">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="message" placeholder="Type message here">
                            <label for="floatingInput">Reply</label>
                        </div>
                        <button id="send_msg" type="submit" class="btn btn-primary" autocomplete="off">Send</button>
                    </form>
                    <div id="msg"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- reply ends -->
</main>
<!-- main page content ends here -->


<?php include './includes/footer.php'; ?>

<script type="text/javascript">
    $(function() {
        const receive = $('#receive').val();
        const send = $('#send').val();
        const dataStr = 'receive=' + receive + '&send=' + send;
        setInterval(function() {
            $.ajax({
                type: 'GET',
                url: './response/chat_loader.php',
                data: dataStr,
                success: function(e) {
                    $('#chat_load').html(e);
                }
            });
        }, 100);
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $("#send_msg").on("click", function(e) {
            e.preventDefault()

            const txtmsg = $("#message").val();
            const receive = $("#receive").val();
            const send = $("#send").val();

            if (txtmsg == '') {
                alert('Type message....')
                return false;
            }
            const datastr = 'message=' + txtmsg + '&receive=' + receive + '&send=' + send;

            $.ajax({
                url: './response/chatlog.php',
                type: 'post',
                data: datastr,
                success: function(response) {
                    $('#msg').html(response);
                }
            });
            document.getElementById('chatForm').reset();
            return false;

        });
    });
</script>