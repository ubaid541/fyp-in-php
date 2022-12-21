<?php
include 'header.php';
include "./config/config.php";

?>

<!-- sidebar starts here -->
<div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
            <ul class="navbar-nav mb-5">
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        CORE
                    </div>
                </li>
                <li>
                    <a href="./index.php" class="nav-link px-3 active">
                        <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="">
                    <hr class="drop-divider" />
                </li>
                <li>
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        Product Section
                    </div>
                </li>
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseProducts" role="button" aria-expanded="false" aria-controls="collapseProducts">
                        <span class="me-2"><i class="bi bi-box"></i></span>
                        <span>Products</span>
                        <span class="right-icon ms-auto">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="collapse" id="collapseProducts">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="./products.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>All Products</span>
                                    </a>
                                </li>
                                <?php
                                if ($_SESSION["user_role"] == '1') {
                                ?>
                                    <li>
                                        <a href="./add-product.php" class="nav-link px-3">
                                            <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                            <span>Add New</span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="mt-3">
                    <a href="category.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-list"></i></span>
                        <span> Categories </span>
                    </a>
                </li>
                <li class="mt-3">
                    <a href="./addons.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-plus-circle-fill"></i></span>
                        <span> Addons </span>
                    </a>
                </li>
                <li class="mt-2">
                    <a href="./attributes.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-three-dots"></i></span>
                        <span> Attributes </span>
                    </a>
                </li>
                <li class="mt-3">
                    <div class="text-muted small fw-bold text-uppercase px-3 mt-3">
                        Reservation Section
                    </div>
                </li>
                <li>
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseTable" role="button" aria-expanded="false" aria-controls="collapseTable">
                        <span class="me-2"><i class="bi bi-box"></i></span>
                        <span>Tables</span>
                        <span class="right-icon ms-auto">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="collapse" id="collapseTable">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="./table.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>All Tables</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="./reservations.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>Reservations</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="mt-3">
                    <div class="text-muted small fw-bold text-uppercase px-3 ">
                        Order Section
                    </div>
                </li>
                <li class="mt-3">
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseOrder" role="button" aria-expanded="false" aria-controls="collapseOrder">
                        <span class="me-2"><i class="bi bi-cart"></i></span>
                        <span>Orders</span>
                        <span class="right-icon ms-auto">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="collapse" id="collapseOrder">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <?php
                                if ($_SESSION['user_role'] == 1) {
                                    $sql = "SELECT count(order_ID) as p_orders from product_order where business_id = {$_SESSION['business_id']}";
                                } else if ($_SESSION['user_role'] == 0) {
                                    $sql = "SELECT count(order_ID) as p_orders from product_order";
                                }
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="orders.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>
                                            All Order
                                            <span class="badge bg-info m-lg-1"><?php echo $result['p_orders']; ?></span>
                                        </span>
                                    </a>
                                </li>
                                <?php
                                if ($_SESSION['user_role'] == 1) {
                                    $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 1 and business_id = {$_SESSION['business_id']}";
                                } else if ($_SESSION['user_role'] == 0) {
                                    $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 1";
                                }
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="completed-orders.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>
                                            Completed
                                            <span class="badge bg-success m-lg-1"><?php echo $result['p_orders']; ?></span>
                                        </span>
                                    </a>
                                </li>
                                <?php
                                if ($_SESSION['user_role'] == 1) {
                                    $sql = "SELECT count(order_ID) as co_orders from product_order where product_order_status = 0 and business_id = {$_SESSION['business_id']}";
                                } else if ($_SESSION['user_role'] == 0) {
                                    $sql = "SELECT count(order_ID) as co_orders from product_order where product_order_status = 0 ";
                                }
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="processing-order.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>
                                            Processing
                                            <span class="badge bg-warning m-lg-1"><?php echo $result['co_orders']; ?></span>
                                        </span>
                                    </a>
                                </li>
                                <?php
                                if ($_SESSION['user_role'] == 1) {
                                    $sql = "SELECT count(order_ID) as c_orders from product_order where product_order_status = 2 and business_id = {$_SESSION['business_id']}";
                                } else if ($_SESSION['user_role'] == 0) {
                                    $sql = "SELECT count(order_ID) as c_orders from product_order where product_order_status = 2";
                                }
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <li>
                                    <a href="cancel-order.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></i></span>
                                        <span>
                                            Cancel
                                            <span class="badge bg-danger m-lg-1"><?php echo $result['c_orders']; ?></span>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="mt-3">
                    <div class="text-muted small fw-bold text-uppercase px-3">
                        Business section
                    </div>
                </li>
                <?php
                if ($_SESSION["user_role"] == '0') {
                ?>
                    <li>
                        <a href="./business-type.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-asterisk"></i></span>
                            <span> Business Type </span>
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="./business-category.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-list"></i></span>
                            <span> Business Category </span>
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="./cities.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-building"></i></span>
                            <span> Cities </span>
                        </a>
                    </li>
                    <li class="mt-2">
                        <a href="./shifts.php" class="nav-link px-3">
                            <span class="me-2"><i class="bi bi-calendar2-check-fill fa-sm text-white-100 me-2"></i></span>
                            <span> Shifts </span>
                        </a>
                    </li>
                <?php } ?>
                <li class="mt-2">
                    <a href="./coupons.php" class="nav-link px-3">
                        <span class="me-2"><i class="bi bi-gift"></i></span>
                        <span> Coupon </span>
                    </a>
                </li>
                <li class="mt-3">
                    <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseSetting" role="button" aria-expanded="false" aria-controls="collapseSetting">
                        <span class="me-2"><i class="bi bi-gear-fill"></i></span>
                        <span>Setting</span>
                        <span class="right-icon ms-auto">
                            <i class="bi bi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="collapse" id="collapseSetting">
                        <div>
                            <ul class="navbar-nav ps-3">
                                <li>
                                    <a href="./update-business-details.php" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>Update Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="" class="nav-link px-3">
                                        <span class="me-2"><i class="bi bi-arrow-right"></i></span>
                                        <span>Delete Business</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- sidebar ends here -->