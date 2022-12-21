<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php';
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
                                        <h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>
                                        <h6 class="mb-0 text-muted"><?php echo $res['id']; ?></h6>
                                    </div>
                                    <hr class="my-4">
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
                                                    <th scope='col'>Qty.</th>
                                                    <th scope='col'>Sub Total.</th>
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
                                                        <td>
                                                            <input style="width: 80px;" name="qty" class="form-control" type="number" id="qty<?php echo $row['product_ID']; ?>" value="<?php echo $row['qty']; ?>" min="1" onclick="update_cart(<?php echo $row['product_ID']; ?>,'update')" required>
                                                        </td>
                                                        <td>
                                                            <input type="hidden" value="<?php echo $row['product_price']; ?>" id="pprice<?php echo $row['product_ID']; ?>">
                                                            <input type="hidden" value="<?php echo $row['addon_price']; ?>" id="aprice<?php echo $row['product_ID']; ?>">
                                                            <input type="hidden" value="<?php echo $row['attr_price']; ?>" id="atprice<?php echo $row['product_ID']; ?>">
                                                            <input type="hidden" value="<?php echo $row['coupon_value']; ?>" id="discount_val<?php echo $row['product_ID']; ?>">
                                                            <?php
                                                            echo $row['sub_total'];
                                                            ?>
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

                                    <div class="pt-5">
                                        <a class="btn btn-outline-dark" href="all-products.php">Back to Shop</a>
                                    </div>
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

                                    <?php if ($res2['total'] != 0) { ?>
                                        <a type="button" href="checkout.php" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Proceed to checkout</a>
                                    <?php } ?>

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
    // update cart
    function update_cart(id, type) {
        var qty = jQuery("#qty" + id).val();
        var pprice = jQuery("#pprice" + id).val();
        var aprice = jQuery("#aprice" + id).val();
        var atprice = jQuery("#atprice" + id).val();
        var discount_val = jQuery("#discount_val" + id).val();

        jQuery.ajax({
            url: './controller-files/cart-actions.php',
            type: 'post',
            data: '&type=' + type + '&id=' + id + '&qty=' + qty + '&pprice=' + pprice + '&aprice=' + aprice + '&atprice=' + atprice + '&discount=' + discount_val,
            success: function(result) {
                location.reload();
            }
        });

    }

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