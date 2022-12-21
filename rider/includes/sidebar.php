<?php
include 'header.php';
include "../config.php";

?>

<!-- sidebar starts here -->
<div class="offcanvas offcanvas-start bg-danger text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav">
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        CORE
                    </div>
                </li>
                <li>
                    <a href="../rider/rider.php" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                        <span>Rider's Dashboard</span>
                    </a>
                </li>
                <li class="my-4">
                    <hr class="drop-divider" />
                </li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        Interface
                    </div>
                </li>
                <li class="mt-2">
                    <a href="./shifts.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-calendar2-check-fill fa-sm text-white-100 me-2"></i></span>
                        <span> Shifts </span>
                    </a>
                </li>
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        <span class="me-2"><i class="bi bi-box"></i></span>
                        <span>Orders</span>
                        <span class="right-icon ms-auto">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <?php
                                $sql = "SELECT count(order_ID) as p_orders from product_order";
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="orders.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>All Orders</span>
                                        <span class="badge bg-info"><?php echo $result['p_orders']; ?></span>
                                    </a>
                                </li>
                                <?php
                                $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 0 and rider = {$_SESSION['rider_ID']}";
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="processing-order.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>Pending Orders</span>
                                        <span class="badge bg-primary"><?php echo $result['p_orders']; ?></span>
                                    </a>
                                </li>
                                <?php
                                $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 1 and rider = {$_SESSION['rider_ID']}";
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="completed-orders.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>Completed Orders</span>
                                        <span class="badge bg-success"><?php echo $result['p_orders']; ?></span>
                                    </a>
                                </li>
                                <?php
                                $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 2 and rider = {$_SESSION['rider_ID']}";
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="cancel-order.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>Canceled Orders</span>
                                        <span class="badge bg-danger"><?php echo $result['p_orders']; ?></span>
                                    </a>
                                </li>
                            </ul>
                <li>
                    <a href="chat.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-chat-dots-fill"></i></span>
                        <span>Chats</span>
                    </a>
                </li>
                <li>
                    <a href="location.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-map-fill"></i></span>
                        <span>Share Location</span>
                    </a>
                </li>
    </div>
</div>
</li>
</ul>
</nav>
</div>
</div>
<!-- sidebar ends here -->