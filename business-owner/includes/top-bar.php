<?php
require './config/config.php';
if (!isset($_SESSION)) {
    session_start();
}
if ($_SESSION['user_role'] == 1) {
    $order_notify = mysqli_query($conn, "SELECT distinct product_order.user_id,product_order.business_id,product_order.notify,user.*
                            from product_order 
                            left join user on product_order.user_id = user.user_id
                            where  product_order.business_id = {$_SESSION['business_id']} and 
                            product_order.notify = 0
                            ORDER BY product_order.order_ID DESC");
    $unread_count = mysqli_num_rows($order_notify);
}
?>


<body>
    <!-- topbar starts -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- offcanvas trigger -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- offcanvas trigger ends -->
            <a class="navbar-brand fw-bold text-uppercase me-auto" href="./admin.php">Fatafut Mangwaen</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex ms-auto">

                </form>
                <?php if ($_SESSION['user_role'] == 1) { ?>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link notify" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-alarm-fill"></i>
                                <span class="position-absolute top-3 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php echo $unread_count; ?>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <?php if ($unread_count > 0) {
                                    while ($row = mysqli_fetch_assoc($order_notify)) { ?>
                                        <li><a id="message" class="dropdown-item" href='./single-order.php?id=<?php echo $row['user_id']; ?>&b_id=<?php echo $row['business_id']; ?>'> <b><?php echo ucfirst($row['cust_username']); ?> </b> &nbsp;&nbsp; placed an order</a></li>
                                    <?php }
                                } else { ?>
                                    <li class="ps-3">No notifications.</li>
                                <?php } ?>
                            </ul>
                        </li>
                    </ul>
                <?php } ?>
                <ul class="navbar-nav mb-2 mb-lg-0 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-people-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./update-business-details.php">Profile</a></li>
                            <li><a class="dropdown-item" href="./user-authentication/logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- topbar ends here -->