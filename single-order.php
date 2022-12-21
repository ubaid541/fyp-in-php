<?php

include "./includes/header.php";
include "./includes/top-bar.php";
include "./config.php";
?>


<style>
    .whatsapp_float {
        position: fixed;
        bottom: 40px;
        right: 20px;
    }

    .whatsapp_float:hover {
        transform: scale(1.5);
        transition: transform .5s ease;
        /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
    }
</style>


<main class="mt-5 mx-5 col-sm-10 pt-3">

    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <div class="row align-items-center">
                <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-5">
                    <?php
                    $user_id = $_GET['id'];
                    $business_id = $_GET['b_id'];
                    // calculate offset 
                    $limit = 3;
                    if (isset($_GET["page"])) {
                        $page = $_GET["page"];
                    } else {
                        $page = 1;
                    }
                    $offset = ($page - 1) * $limit;

                    /* select query of order  for seller user */
                    $sql = "SELECT product_order.*,user.*,business.*,rider.* 
                        from product_order
                        left join user on product_order.user_id = user.user_id
                        left join business on product_order.business_id = business.business_id
                        left join rider on product_order.rider = rider.rider_ID
                        where  product_order.business_id = '$business_id' and product_order.user_id = '$user_id'
                        ORDER BY product_order.order_id DESC LIMIT {$offset},{$limit}";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                    ?>
                        <div class="d-sm-flex align-items-center justify-content-between">
                            <h1 class="h3 mb-0 text-gray-800">
                                <i class="bi bi-filter"></i>Order<span class="badge bg-secondary mx-1"><?php echo $row['order_ID']; ?></span>
                            </h1>

                            <?php if ($row['product_payment_status'] == 0) { ?>
                                <span class="badge rounded-pill bg-danger text-capitalize mx-3">
                                    unpaid
                                </span>
                            <?php } else { ?>
                                <span class="badge rounded-pill bg-success text-capitalize margin-left">
                                    paid
                                </span>
                            <?php } ?>
                            <?php if ($row['product_order_status'] == 0) { ?>
                                <span class="badge rounded-pill bg-primary text-capitalize margin-left"> Processing </span>
                            <?php } else if ($row['product_order_status'] == 1) { ?>
                                <span class="badge rounded-pill bg-success text-capitalize margin-left">
                                    Completed
                                </span>
                            <?php } else if ($row['product_order_status'] == 2) { ?>
                                <span class="badge rounded-pill bg-danger text-capitalize margin-left">
                                    Cancelled
                                </span>
                            <?php }  ?>

                            <span class="ms-2 ms-sm-3 margin-left"><i class="bi bi-calendar-fill"></i> <?php echo $row['product_order_date']; ?>
                            </span>
                        </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="d-sm-flex align-items-center justify-content-between mb-1 my-2">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <div class="ms-1">
                            <h5 class="text-capitalize">
                                Assigned To :
                                <?php if ($row['rider'] != 0) { ?>
                                    <div class="whatsapp_float">
                                        <a href="https://wa.me/<?php echo $row['phone']; ?>" target="_blank"><img src="whatsapp-icon.png" alt="whatsapp-icon" width="50px" class="w_float_btn"></a>
                                    </div>
                                    <button class="border border-1 p-1" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        <?php echo $row['name']; ?>

                                    </button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Rider Contact Info</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex flex-row">
                                                        <div class="p-2">
                                                            <h5>Name: </h5>
                                                        </div>
                                                        <div class="p-2">
                                                            <p class="text-secondary"><?php echo $row['name']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="p-2">
                                                            <h5>Phone: </h5>
                                                        </div>
                                                        <div class="p-2">
                                                            <p class="text-secondary"><?php echo $row['phone']; ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-row">
                                                        <div class="p-2">
                                                            <h5>Email: </h5>
                                                        </div>
                                                        <div class="p-2">
                                                            <p class="text-secondary"><?php echo $row['email']; ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php } else { ?>
                                    <?php  ?>
                                    No rider assigned
                                <?php }
                                ?>
                            </h5>
                        </div>

                    </div>
                    <span class="ms-2 my-4 ms-sm-3">
                        <div class="dropdown float-end ps-2">
                            <button class="btn dropdown-toggle border border-1" type="button" id="dropDownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Status
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <form action="./controller-files/order-controller/process-order.php" method="post">
                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                        <input type="hidden" name="b_id" value="<?php echo $business_id; ?>">
                                        <button type="submit" name="cancel" class="dropdown-item">Cancel</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </span>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- page heading ends  -->
    <!-- Single Invoice starts here -->
    <div class="row">
        <!-- Invoice Details column -->
        <div class="col-lg-8 mb-4">
            <!-- Order Details Card -->
            <div class="card shadow mb-4 h-100">
                <?php
                // sql query for admin

                // $sql2 = "SELECT product_order.*,products.*,user.*,business.*,rider.*,product_addons.*,product_attributes.*,coupon_code.*
                //      from product_order
                //      left join products on product_order.product_ID = products.pro_id 
                //      left join product_addons on product_order.addon_ID = product_addons.addon_ID 
                //      left join product_attributes on product_order.attr_ID = product_attributes.attr_ID 
                //      left join user on product_order.user_id = user.user_id
                //      left join business on product_order.business_id = business.business_id
                //      left join rider on product_order.rider = rider.rider_ID
                //      left join coupon_code on product_order.discount = coupon_code.coupon_id 
                //      where product_order.user_id = '$user_id'
                //      ORDER BY product_order.order_id DESC LIMIT {$offset},{$limit}";

                /* select query of order  for seller user */
                $sql2 = "SELECT product_order.*,products.*,user.*,business.*,rider.*,product_addons.*,product_attributes.*
                     from product_order
                     left join products on product_order.product_ID = products.pro_id 
                     left join product_addons on product_order.addon_ID = product_addons.addon_ID 
                     left join product_attributes on product_order.attr_ID = product_attributes.attr_ID 
                     left join user on product_order.user_id = user.user_id
                     left join business on product_order.business_id = business.business_id
                     left join rider on product_order.rider = rider.rider_ID
                     where  product_order.business_id = '$business_id' and product_order.user_id = '$user_id'
                     ORDER BY product_order.order_id DESC LIMIT {$offset},{$limit}";

                $result2 = mysqli_query($conn, $sql2);
                if (mysqli_num_rows($result2) > 0) {

                ?>
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary text-capitalize">
                            Order details
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table class="table data-table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-center">#</th>
                                            <th scope="col" class="text-center"><i class="bi bi-image-fill"></i></th>
                                            <th scope="col" class="text-center">Name</th>
                                            <th scope="col" class="text-center">Addon</th>
                                            <th scope="col" class="text-center">Attribute</th>
                                            <th scope="col" class="text-center">Quantity</th>
                                            <th scope="col" class="text-center">Pyament Method</th>
                                            <th scope="col" class="text-center">Total</th>
                                            <th scope="col" class="text-center">Business</th>
                                            <th scope="col" class="text-center">New Column</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $serial = $offset + 1;
                                        while ($order = mysqli_fetch_assoc($result2)) {
                                        ?>
                                            <tr class="text-center">
                                                <th scope="row"><?php echo $serial; ?></th>
                                                <td>
                                                    <img style=" height: 35px;
    border-radius: 5px;
    margin-right: 5px;" src="business-owner/uploads/<?php echo $order['product_image']; ?>" alt="food image" />
                                                </td>

                                                <td><a href='./single-product.php?pid=<?php echo $order['pro_id']; ?>'><?php echo $order['product_name']; ?></a></td>

                                                <td>
                                                    <?php
                                                    if ($order['addon_ID'] != 0) {
                                                        echo $order['addon_name'];
                                                    } else { ?>
                                                        No addon
                                                    <?php } ?>
                                                </td>
                                                <td><?php
                                                    if ($order['attr_ID'] != 0) {
                                                        echo $order['attr_Name'];
                                                    } else { ?>
                                                        No attribute
                                                    <?php } ?></td>
                                                <td><?php echo $order['product_quantity']; ?></td>
                                                <td><?php
                                                    if ($row['product_payment_method'] == 0) {
                                                    ?>
                                                        COD
                                                    <?php } ?></td>
                                                <td>
                                                    <?php
                                                    $pprice = $order['product_price'];
                                                    $qty = $order['product_quantity'];
                                                    $aprice = $order['addon_price'];
                                                    $atprice = $order['attr_price'];
                                                    $shipping_charges = $order['product_tax'];

                                                    $count_qty = $pprice * $qty;
                                                    $add_prices = $count_qty + $aprice + $atprice + $shipping_charges;
                                                    $sub_total = $add_prices;
                                                    $amount = $order['total_amount'];
                                                    $tamount = $amount - $sub_total;

                                                    echo $sub_total;
                                                    ?> Rs
                                                </td>

                                                <td><?php echo $order['business_name']; ?></td>

                                            <?php
                                            $serial++;
                                        }
                                            ?>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5"></div>
                                <div class="col-lg-4 col-sm-5 ms-auto">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td class="text-start">
                                                    <strong>Total</strong>
                                                </td>
                                                <td class=" text-center">
                                                    <?php
                                                    echo $row['total_amount']; ?>/Rs
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        <?php

                } ?>
        </div>
        <!-- Customer Details column -->
        <div class="col-lg-4 mb-4">
            <!-- Customer Details Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="dataTable" width="100%" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td>
                                        <img class="avatar" style="height: 2.65rem;
    width: 2.65rem;
    border-radius: 50%;" src="business-owner/assets/images/avatar/male-avatar.png" alt="Avatar" />
                                        <span class="ms-2"><?php echo $row['cust_username']; ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="icon-info icon-circle">
                                            <i class="bi bi-basket2-fill"></i>
                                        </div>
                                        <?php
                                        $query =  mysqli_query($conn, "SELECT count(order_ID) as orders from product_order where business_id = '$business_id' and user_id = '$user_id'");
                                        $order_count = mysqli_fetch_assoc($query);
                                        ?>
                                        <span class="ms-2"><?php echo $order_count['orders']; ?> Orders </span>
                                    </td>
                                </tr>
                                <tr>
                                    <?php
                                    $sql3 = "SELECT * from product_order                     
                                    where  product_order.business_id = '$business_id' and product_order.user_id = '$user_id'
                                    ORDER BY product_order.order_id DESC LIMIT {$offset},{$limit}";
                                    $result3 = mysqli_query($conn, $sql3);
                                    $row3 = mysqli_fetch_assoc($result3);
                                    ?>
                                    <td>
                                        <h5 class="text-capitalize mb-2">Contact</h5>
                                        <i class="bi bi-envelope"></i>
                                        <span class="ms-2"> <?php echo $row3['email']; ?> </span><br />
                                        <i class="bi bi-phone"></i>
                                        <span class="ms-2"> <?php echo $row3['contact_num']; ?> </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h5 class="text-capitalize mb-2">Delivery address</h5>
                                        <span class="ms-2"> <?php echo $row3['address']; ?> </span><br />
                                        <!-- <span class="ms-2">
                                            <button type="button" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Cusotmer Location">
                                                <i class="bi bi-map-fill"></i></button></span> -->
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Single Invoice ends here -->
    </div>
</main>

<?php include './includes/footer.php'; ?>