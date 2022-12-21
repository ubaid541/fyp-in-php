<?php

include "./includes/header.php";
include "./includes/top-bar.php";
include "./includes/sidebar.php";
?>
<!-- main page content starts here -->
<main class="mt-5 pt-3 main" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page headings starts -->
        <div class="page-heading">
            <div class="row">
                <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-5">
                    <h1 class="h3 mb-0 text-gray-800">Welcome, <?php echo $_SESSION["username"]; ?></h1>
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="bi bi-download fa-sm text-white-50"></i>Generate
                        Report</a> -->
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
                            if ($_SESSION['user_role'] == 1) {
                                $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 0 and business_id = {$_SESSION['business_id']}";
                            } else if ($_SESSION['user_role'] == 0) {
                                $sql = "SELECT count(order_ID) as p_orders from product_order where product_order_status = 0 ";
                            }
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
                                if ($_SESSION['user_role'] == 1) {
                                    $sql = "SELECT count(order_ID) as c_orders from product_order where product_order_status = 1 and business_id = {$_SESSION['business_id']}";
                                } else if ($_SESSION['user_role'] == 0) {
                                    $sql = "SELECT count(order_ID) as c_orders from product_order where product_order_status = 1";
                                }
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
                                if ($_SESSION['user_role'] == 1) {
                                    $sql = "SELECT count(order_ID) as ca_orders from product_order where product_order_status = 2 and business_id = {$_SESSION['business_id']}";
                                } else if ($_SESSION['user_role'] == 0) {
                                    $sql = "SELECT count(order_ID) as ca_orders from product_order where product_order_status = 2";
                                }
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
        </div>


        <!-- order status table starts (6 - order) -->
        <?php
        include './config/config.php';
        // calculate offset 
        $limit = 3;
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $offset = ($page - 1) * $limit;

        // select query with offset and limit
        if ($_SESSION["user_role"] == '0') {
            /* select query of order for admin user */
            $sql = "SELECT product_order.*,products.*,product_addons.*,product_attributes.*,user.*,business.*,rider.* 
                            from product_order
                            left join products on product_order.product_ID = products.pro_id 
                            left join product_addons on product_order.addon_ID = product_addons.addon_ID
                            left join product_attributes on product_order.attr_ID = product_attributes.attr_ID
                            left join user on product_order.user_id = user.user_id
                            left join business on product_order.business_id = business.business_id
                            left join rider on product_order.rider = rider.rider_ID
                            ORDER BY product_order.order_id DESC LIMIT {$offset},{$limit}";
        } elseif ($_SESSION["user_role"] == '1') {
            /* select query of order  for seller user */
            $sql = "SELECT product_order.order_ID,product_order.total_amount,product_order.product_payment_method,product_order.product_payment_status,product_order.product_order_status,product_order.product_order_date,product_order.contact_num,product_order.business_id,product_order.rider,products.*,user.*,business.*,rider.* 
                            from product_order
                            left join products on product_order.product_ID = products.pro_id 
                            left join user on product_order.user_id = user.user_id
                            left join business on product_order.business_id = business.business_id
                            left join rider on product_order.rider = rider.rider_ID
                            where  product_order.business_id = {$_SESSION['business_id']}
                            ORDER BY product_order.order_id DESC LIMIT {$offset},{$limit}";
        }
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { ?>
            <div class="row mb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">Orders</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table data-table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center">Order Number</th>
                                            <th scope="col" class="text-center">Username</th>
                                            <th scope="col" class="text-center">Payment Method</th>
                                            <th scope="col" class="text-center">Status</th>
                                            <th scope="col" class="text-center">Assigned To</th>
                                            <th scope="col" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $serial = $offset + 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr class="text-center">
                                                <th scope="row" class="text-center"><?php echo $serial; ?></th>
                                                <td class="text-center"><?php echo $row['order_ID']; ?></td>
                                                <td><?php echo $row['cust_username']; ?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['product_payment_method'] == 0) {
                                                    ?>
                                                        COD
                                                    <?php } ?>
                                                </td>
                                                <td class=" text-center">
                                                    <?php
                                                    if ($row['product_order_status'] == 0) { ?>
                                                        <p class="text-primary">Processing</p>
                                                    <?php } else if ($row['product_order_status'] == 1) { ?>
                                                        <p class="text-success">Completed</p>
                                                    <?php } else if ($row['product_order_status'] == 2) { ?>
                                                        <p class="text-danger">Canceled</p>
                                                    <?php  }
                                                    ?>
                                                </td>

                                                <?php
                                                if ($row['rider'] != 0) {
                                                ?>
                                                    <td class=" text-center"><?php echo $row['name']; ?></td>
                                                <?php } else { ?>
                                                    <td>No rider assigned</td>
                                                <?php } ?>
                                                <td class=" text-center">
                                                    <div class="dropdown">

                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu shadow-lg rounded mt-1" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item btn" href='./single-order.php?id=<?php echo $row['user_id']; ?>&b_id=<?php echo $row['business_id']; ?>'>View</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href='./controller-files/order-controller/delete-order.php?id=<?php echo $row['user_id']; ?>&b_id=<?php echo $row['business_id']; ?>'>Delete</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $serial++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                    } else {

                        echo '<h3 class="text-center">No results found.</h3>';
                    }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- order status table ends (6 - orders) -->
    </div>
</main>
<!-- main page content ends here -->

<?php include './includes/footer.php'; ?>