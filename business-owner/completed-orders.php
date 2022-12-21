<?php

include "./includes/header.php";
include "./includes/top-bar.php";
include "./includes/sidebar.php";
include "./config/config.php";

?>


<main class="mt-5 pt-3">
    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <?php if (isset($_SESSION['status'])) {
                echo "<div class='alert alert-success' role='alert'>" . $_SESSION['status'] . "</div>";
                unset($_SESSION['status']);
            } elseif (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            } ?>
            <div class="row">
                <div class="
                d-sm-flex
                align-items-center
                justify-content-between
                mb-1
                mt-5
              ">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-filter"></i>Orders<span class="badge bg-secondary" style="margin-left: 0.5rem"></span>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Orders
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->
        <!-- Product table starts here -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row" style="width: 100%">
                            <div class="col-8 mb-4 mb-lg-1">
                                <form class="d-flex ms-auto">
                                    <div class="input-group my-3 my-lg-0">
                                        <input type="text" id="searchPro" onkeyup="myFunction()" class="form-control" placeholder="Search Order" aria-label="Search Order" aria-describedby="button-addon2" />
                                        <button class="btn btn-primary" type="button" id="button-addon2">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 mb-3 mb-lg-0">
                                <div class="d-grid gap-2">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
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
                            where product_order_status = 1
                            ORDER BY product_order.order_ID DESC LIMIT {$offset},{$limit}";
                        } elseif ($_SESSION["user_role"] == '1') {
                            /* select query of order  for seller user */
                            $sql = "SELECT product_order.*,products.*,product_addons.*,product_attributes.*,user.*,business.*,rider.*
                            from product_order
                            left join products on product_order.product_ID = products.pro_id 
                            left join user on product_order.user_id = user.user_id
                            left join business on product_order.business_id = business.business_id
                            left join product_addons on product_order.addon_ID = product_addons.addon_ID
                            left join product_attributes on product_order.attr_ID = product_attributes.attr_ID
                            left join rider on product_order.rider = rider.rider_ID
                            where  product_order.business_id = {$_SESSION['business_id']} and product_order_status = 1
                            ORDER BY product_order.order_ID DESC LIMIT {$offset},{$limit}";
                        }
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) { ?>
                            <div class="table-responsive" id="proTable">
                                <table class="table data-table table-striped table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th scope='col'>#</th>
                                            <th scope='col' class="text-center">Order Number</th>
                                            <th scope='col' class=" text-center">Username</th>
                                            <th scope='col' class=" text-center">Phone</th>
                                            <th scope='col' class=" text-center">Payment Type</th>
                                            <th scope='col' class=" text-center">Payment Status</th>
                                            <th scope='col' class=" text-center">Order Status</th>
                                            <th scope='col' class=" text-center">Rider</th>
                                            <th scope='col' class=" text-center">Rider Phone</th>
                                            <th scope='col' class=" text-center">Date</th>
                                            <th scope='col' class=" text-center">Total</th>
                                            <?php if ($_SESSION["user_role"] == '1') { ?>
                                                <th scope='col'>Action</th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $serial = $offset + 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <th scope="row" class=" text-center"><?php echo $serial; ?></th>
                                                <td class=" text-center">
                                                    <?php echo $row['order_ID']; ?>
                                                </td>
                                                <td class=" text-center">
                                                    <?php echo $row['cust_username']; ?>
                                                </td>
                                                <td class=" text-center">
                                                    <?php echo $row['contact_num']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    if ($row['product_payment_method'] == 0) {
                                                    ?>
                                                        COD
                                                    <?php } ?>
                                                </td>
                                                <?php if ($row['product_payment_status'] == 0) { ?>
                                                    <td class=" text-center text-danger">unpaid
                                                    </td>
                                                <?php
                                                } else { ?>
                                                    <td class="text-center text-success">paid</td>
                                                <?php } ?>
                                                <td class="text-center">

                                                    <?php
                                                    if ($row['product_order_status'] == 0) { ?>
                                                        <p class="text-primary">Processing</p>
                                                    <?php } else if ($row['product_order_status'] == 1) { ?>
                                                        <p class="text-success">Completed</p>
                                                    <?php } else if ($row['product_order_status'] == 2) { ?>
                                                        <p class="text-danger">Canceled</p>
                                                    <?php  } ?>
                                                </td>
                                                <?php
                                                if ($row['rider'] != 0) {
                                                ?>
                                                    <td class=" text-center"><?php echo $row['name']; ?></td>
                                                    <td class=" text-center"><?php echo $row['phone']; ?></td>
                                                <?php } else { ?>
                                                    <td colspan="2">No rider assigned</td>
                                                <?php } ?>
                                                <td class=" text-center"><?php echo $row['product_order_date']; ?></td>
                                                <td class=" text-center">
                                                    <?php
                                                    if ($_SESSION['user_role'] == 1) {

                                                        $pprice = $row['product_price'];
                                                        $qty = $row['product_quantity'];
                                                        $aprice = $row['addon_price'];
                                                        $atprice = $row['attr_price'];
                                                        // $discount_val = $row['coupon_value'];
                                                        $shipping_charges = $row['product_tax'];
                                                        $count_qty = $pprice * $qty;
                                                        $add_prices = $count_qty + $aprice + $atprice + $shipping_charges;
                                                        $total = $row['total_amount'];
                                                        $sub_total = $total - $add_prices;
                                                        echo $sub_total;
                                                    } else {
                                                        echo $row['total_amount']; ?>/Rs
                                                <?php  } ?>
                                                </td>
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

                        <!-- select query for pagination -->
                        <?php
                        if ($_SESSION["user_role"] == '1') {
                            $sql1 = "SELECT * FROM product_order where business_id = {$_SESSION['business_id']} and product_order_status = 1";
                        } else if ($_SESSION["user_role"] == '0') {
                            $sql1 = "SELECT * FROM product_order where product_order_status = 1 ";
                        }
                        $result_1 = mysqli_query($conn, $sql1) or die("Pagination query failed.");
                        if (mysqli_num_rows($result_1)) {
                            $total_record = mysqli_num_rows($result_1);
                            $total_page = ceil($total_record / $limit);
                        ?>
                            <div class="row mt-2">
                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1) {
                                        echo " <li class='page-item'>
                                    <a class='page-link' href='completed-orders.php?page=" . ($page - 1) . "' aria-label='Previous'>
                                        <span aria-hidden='true'>&laquo;</span>
                                    </a>
                                </li>";
                                    }

                                    if ($total_record > $limit) {
                                        for ($i = 1; $i <= $total_page; $i++) {
                                            if ($i == $page) {
                                                $cls = 'active';
                                            } else {
                                                $cls = '';
                                            }
                                            echo "<li class='page-item {$cls}'>
                                        <a class='page-link' href='completed-orders.php?page=" . $i . "'>$i</a>
                                    </li>";
                                        }
                                    }

                                    if ($total_page > $page) {
                                        echo " <li class='page-item'>
                                    <a class='page-link' href='completed-orders.php?page=" . ($page + 1) . "' aria-label='Next'>
                                        <span aria-hidden='true'>&raquo;</span>
                                    </a>
                                </li>";
                                    }
                                    ?>
                                </ul>
                            <?php } ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Order table ends here -->
    </div>
</main>

<?php include './includes/footer.php'; ?>

<script>
    // search inside product table
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchPro");
        filter = input.value.toUpperCase();
        table = document.getElementById("proTable");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>