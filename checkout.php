<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php';

$sql = "SELECT * from product_cart where user_ID = {$_SESSION['user_id']}";
$run = mysqli_query($conn, $sql);

$grand_total = 0;
$items = array();

if (mysqli_num_rows($run) > 0) {
    while ($row = mysqli_fetch_assoc($run)) {
        $grand_total += $row['total'];
        $items[$row['cart_ID']]['product_ID'] = $row['product_ID'];
        $items[$row['cart_ID']]['qty'] = $row['qty'];
        $items[$row['cart_ID']]['business_id'] = $row['business_id'];
        // $items[$row['cart_ID']] = array('product_ID' => $row['product_ID']);
    }
}

?>

<section class="h-100 h-custom" style="background-color: #1998be;">

    <?php
    $sql1 = "SELECT COUNT(cart_ID) as id from product_cart where user_ID = {$_SESSION['user_id']}";
    $count = mysqli_query($conn, $sql1);
    $res = mysqli_fetch_assoc($count);

    ?>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12">
                <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                    <div class="card-body p-0">
                        <div class="row g-0">
                            <div class="col-lg-8">
                                <div class="p-5">
                                    <div class="d-flex justify-content-between align-items-center mb-5">
                                        <h1 class="fw-bold mb-0 text-black">Checkout</h1>
                                        <h6 class="mb-0 text-muted"><?php echo $res['id']; ?></h6>
                                    </div>
                                    <hr class="my-4">

                                    <div class="my-4 ">
                                        <h4 class="fw-bold mb-0 text-black text-start">Products</h4>
                                    </div>

                                    <!-- sql command to fetch products in cart -->
                                    <?php
                                    $limit = 3;
                                    if (isset($_GET["page"])) {
                                        $page = $_GET["page"];
                                    } else {
                                        $page = 1;
                                    }
                                    $offset = ($page - 1) * $limit;

                                    $sql = "SELECT product_cart.*,products.*,product_addons.addon_ID,product_addons.addon_name,product_addons.addon_price,product_attributes.attr_ID,product_attributes.attr_Name,product_attributes.attr_price,coupon_code.*,business.business_id,business.business_name
                                    from product_cart 
                                    left join products on product_cart.product_ID = products.pro_id 
                                    left join product_addons on product_cart.addon_ID = product_addons.addon_ID 
                                    left join product_attributes on product_cart.attr_ID = product_attributes.attr_ID 
                                    left join coupon_code on product_cart.discount_ID = coupon_code.coupon_id 
                                    left join business on product_cart.business_id = business.business_id 
                                    where product_cart.user_ID = {$_SESSION['user_id']}
                                    order by product_cart.cart_ID";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                    ?>
                                        <table class="table data-table table-hover table-bordered table-responsive">
                                            <thead>
                                                <tr>
                                                    <th scope='col'>#</th>
                                                    <th scope='col'><i class="bi bi-image-fill"></i></th>
                                                    <th scope='col'>Name</th>
                                                    <th scope='col'>Addon</th>
                                                    <th scope='col'>Attribute</th>
                                                    <th scope='col'>Sub Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $serial = $offset + 1;
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                ?>
                                                    <tr>
                                                        <th scope="row"><?php echo $serial; ?></th>
                                                        <td><img style=" width: 100px;
                            height: 50px;" src="business-owner/uploads/<?php echo $row['product_image']; ?>" class="card-img-top image-size" alt="product-image"></td>
                                                        <td><?php echo $row['product_name']; ?></td>
                                                        <td>
                                                            <?php if (($row['addon_name'] && $row['addon_price']) > 0) {
                                                                echo $row['addon_name']; ?><br>
                                                                <?php
                                                                echo $row['addon_price']; ?>Rs
                                                            <?php } else {
                                                                echo "No Addon";
                                                            } ?>
                                                        </td>
                                                        <td>
                                                            <?php if (($row['attr_Name'] && $row['attr_price']) > 0) {
                                                                echo $row['attr_Name']; ?><br>
                                                                <?php echo $row['attr_price']; ?>Rs
                                                            <?php } else {
                                                                echo "No Attribute";
                                                            } ?>
                                                        </td>

                                                        <input style="width: 80px;" name="qty" class="form-control" type="hidden" id="qty<?php echo $row['product_ID']; ?>" value="<?php echo $row['qty']; ?>" min="1" onclick="update_cart(<?php echo $row['product_ID']; ?>,'update')" required>

                                                        <td>
                                                            <input type="hidden" value="<?php echo $row['product_price']; ?>" id="pprice<?php echo $row['product_ID']; ?>">
                                                            <input type="hidden" value="<?php echo $row['addon_price']; ?>" id="aprice<?php echo $row['product_ID']; ?>">
                                                            <input type="hidden" value="<?php echo $row['attr_price']; ?>" id="atprice<?php echo $row['product_ID']; ?>">
                                                            <input type="hidden" value="<?php echo $row['coupon_value']; ?>" id="discount_val<?php echo $row['product_ID']; ?>">
                                                            <b>
                                                                <?php
                                                                echo $row['sub_total'];
                                                                ?>
                                                            </b>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"> <button class="btn btn-outline-dark" type="submit" onclick="remove_pro(<?php echo $row['product_ID']; ?>,'delete')"><i class="bi bi-trash3"></i>Remove</button>
                                                        </td>
                                                        <td colspan="2">
                                                            <?php if (($row['coupon_name'] && $row['coupon_value']) > 0) {
                                                                echo $row['coupon_name']; ?>
                                                                <?php echo $row['coupon_value']; ?>Rs
                                                            <?php } else {
                                                                echo "No Coupon";
                                                            } ?>
                                                        </td>
                                                        <td colspan="2">
                                                            <?php
                                                            echo $row['business_name'];
                                                            ?>
                                                        </td>
                                                    </tr>

                                                <?php
                                                    $serial++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    <?php

                                    } else {
                                        echo '<h1 class="fw-bold mb-0 text-black">Cart is empty.</h1>';
                                    } ?>
                                    <hr class="my-4">
                                    <!-- select delivery area -->
                                    <?php

                                    $limit = 3;
                                    if (isset($_GET["page"])) {
                                        $page = $_GET["page"];
                                    } else {
                                        $page = 1;
                                    }
                                    $offset = ($page - 1) * $limit;

                                    $sql = "SELECT product_cart.*,products.*,product_addons.addon_ID,product_addons.addon_name,product_addons.addon_price,product_attributes.attr_ID,product_attributes.attr_Name,product_attributes.attr_price,coupon_code.*,business.business_id,business.business_name,user.*
                                    from product_cart 
                                    left join products on product_cart.product_ID = products.pro_id 
                                    left join product_addons on product_cart.addon_ID = product_addons.addon_ID 
                                    left join product_attributes on product_cart.attr_ID = product_attributes.attr_ID 
                                    left join coupon_code on product_cart.discount_ID = coupon_code.coupon_id 
                                    left join business on product_cart.business_id = business.business_id 
                                    left join user on product_cart.user_ID = user.user_id  
                                    where product_cart.user_ID = {$_SESSION['user_id']}
                                    order by product_cart.cart_ID";
                                    $run = mysqli_query($conn, $sql);
                                    $result = mysqli_fetch_assoc($run);
                                    ?>

                                    <form action="./controller-files/process-checkout.php" method="post">
                                        <div class="row mt-2">
                                            <div class="my-4 ">
                                                <h4 class="fw-bold mb-0 text-black text-start">Delivery Address</h4>
                                            </div>
                                            <div class="col-sm-3 col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input name="shipp_address" class="form-control" type="text" placeholder="Shipping Address" value="<?php echo $result['address']; ?>" required />
                                                        <label for="floatingInput">Delivery Address</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-6">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input name="user_phone" class="form-control" type="text" placeholder="Phone Number" value="<?php echo $result['phone']; ?>" required />
                                                        <label for="floatingInput">Contact Number</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-4">
                                            <div class="col-sm-3 col-md-6 mb-5">
                                                <div class="mb-3">
                                                    <div class="form-floating">
                                                        <input name="user_email" class="form-control" type="text" placeholder="Email" value="<?php echo $result['email']; ?>" required />
                                                        <label for="floatingInput">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 col-md-6 mb-5">
                                                <div class="mb-3">
                                                    <div class="text-start mb-3">
                                                        <h5>Payment Method</h5>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="payment_method" checked>
                                                        <label class="form-check-label text-start" for="flexRadioDefault1">
                                                            Cash On Delivery
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <input type="hidden" name="pro_detail" value="<?php echo $items; ?>">
                                            <input type="hidden" name="addon_id" value="<?php echo $result['addon_ID']; ?>" id="addon">
                                            <input type="hidden" name="attr_id" value="<?php echo $result['attr_ID']; ?>" id="attr">
                                            <input type="hidden" value="<?php echo $business_id; ?>" id="business_id">
                                            <input type="hidden" value="<?php echo $qty; ?>" name="qty">
                                            <input type="hidden" name="total_amount" value="<?php echo $grand_total; ?>">

                                            <button type="submit" name="place_order" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Place Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-4 bg-grey">
                                <div class="p-5">
                                    <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                    <hr class="my-4">

                                    <!-- total price -->
                                    <?php
                                    $sql2 = "SELECT sum(total) as total from product_cart where user_ID = {$_SESSION['user_id']}";
                                    $count2 = mysqli_query($conn, $sql2);
                                    $res2 = mysqli_fetch_assoc($count2);
                                    ?>

                                    <div class="d-flex justify-content-between mb-4">
                                        <h5 class="text-uppercase">items:</h5>
                                        <h5>
                                            <?php echo $res['id']; ?>
                                        </h5>
                                    </div>

                                    <hr class="my-4">

                                    <div class="d-flex justify-content-between mb-5">
                                        <h5 class="text-uppercase">Total price</h5>
                                        <h5 id="total_price">RS <?php
                                                                echo $res2['total'];
                                                                ?></h5>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<?php include './includes/footer-script.php'; ?>
<script>
    // delete product
    function remove_pro(id, type) {
        $id = id;
        $type = type;

        jQuery.ajax({
            url: './controller-files/cart-actions.php',
            type: 'post',
            data: 'id=' + id + '&type=' + type,
            success: function(result) {
                location.reload();

            }
        });

    }
</script>
<?php include './includes/footer.php'; ?>