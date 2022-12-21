<?php

include "./includes/header.php";
include "./includes/top-bar.php";
include "./includes/sidebar.php";
include "config.php";
?>

<!-- main page content starts here -->
<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page headings starts -->
        <div class="page-heading">
            <div class="row">
                <div class="
                d-sm-flex
                align-items-center
                justify-content-between
                mb-1
                mt-5
              ">
                    <div>
                        <h1 class="h3 mb-0 text-gray-800">Welcome, <?php echo $_SESSION["username"]; ?></h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- page headings ends -->
        <!-- cards starts here -->
        <div class="row">
            <!-- Earnings (Monthly) Card  -->
            <!-- <div class="col-xl-3 col-md-6 mb-4">
                <div class="card bi-border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="
                        text-xs
                        font-weight-bold
                        text-primary text-uppercase
                        mb-1
                      ">
                                    Earnings (Monthly)
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    $400
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                <i class="bi bi-calendar4"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- Pending orders Card  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <?php
                            $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 0 and rider = {$_SESSION['rider_ID']}";
                            $p_orders = mysqli_query($conn, $sql);
                            $result = mysqli_fetch_assoc($p_orders);
                            ?>
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Pending Orders
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['p_orders']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-cart-check"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Completed Card  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $sql = "SELECT count(order_ID) as c_orders from product_order where product_order_status = 1 and rider = {$_SESSION['rider_ID']}";
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?>
                                <div class="
                        text-xs
                        font-weight-bold
                        text-success text-uppercase
                        mb-1
                      ">
                                    Completed Orders
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['c_orders']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-check-circle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancel Card  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $sql = "SELECT count(order_ID) as ca_orders from product_order where product_order_status = 2 and rider = {$_SESSION['rider_ID']}";
                                $p_orders = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($p_orders);
                                ?> <div class="
                            text-xs
                            font-weight-bold
                            text-danger text-uppercase
                            mb-1
                          ">
                                    Cancelled Orders
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $result['ca_orders']; ?></div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-bicycle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Shifts Card  -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <?php
                                $sql = "SELECT shift from rider where rider_ID = {$_SESSION['rider_ID']}";
                                $shift = mysqli_query($conn, $sql);
                                $result = mysqli_fetch_assoc($shift);
                                ?>
                                <div class="
                            text-xs
                            font-weight-bold
                            text-success text-uppercase
                            mb-1
                          ">
                                    Shift
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <?php if ($result['shift'] != 0) { ?>
                                        <p class="text-success">Active</p>
                                    <?php } else { ?>
                                        <p class="text-danger">Not Active</p>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="bi bi-bicycle"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- main page content ends here -->

<?php include './includes/footer.php'; ?>