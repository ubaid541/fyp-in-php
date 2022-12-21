<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>

<section id="product" class="product ">
    <div class="container my-5">
        <div class="card card-css my-5">
            <?php include 'config.php';
            $product_id = $_GET['pid'];
            $sql = "SELECT products.*,product_addons.*,product_attributes.*,business.*,coupon_code.* from products 
            left join product_addons on products.product_addons = product_addons.addon_ID 
            left join product_attributes on products.product_attr = product_attributes.attr_ID 
            left join business on products.business_id = business.business_id 
            left join coupon_code on products.discount = coupon_code.coupon_id 
            where products.pro_id = {$product_id} ";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="row my-5">
                        <div class="col-md-5 col-sm-12 col-xs-12">
                            <div class="product-images">
                                <img src="business-owner/uploads/<?php echo $row['product_image']; ?>" alt="product-image" width="430px" height="350px">
                            </div>
                        </div>
                        <div class="col-md-6 col-md-offset-1 col-sm-12 col-xs-12">
                            <input type="hidden" name="business_ID" class="form-control" value="<?php echo $row['business_id']; ?>" id="business<?php echo $product_id; ?>">
                            <input type="hidden" name="shipping_charges" class="form-control" value="<?php echo $row['product_tax']; ?>" id="shipping_charges<?php echo $product_id; ?>">
                            <div class="content">
                                <div class="h1">
                                    <h1><?php echo $row['product_name']; ?></h1>
                                </div>
                                <div class="p">
                                    <p><strong>Description</strong><br><?php echo $row['product_description']; ?></p>
                                </div>
                                <div class="h2">
                                    <h2 style="color: gray;">
                                        <input type="hidden" value="<?php echo $row['product_price']; ?>" id="pprice<?php echo $product_id; ?>">
                                        <?php echo $row['product_price']; ?> Rs
                                    </h2>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item d-flex justify-content-between">
                                        <?php if (($row['addon_name'] && $row['addon_price']) > 0) { ?>
                                            <div class="form-check">
                                                <input class="form-check-input" name="addon<?php echo $product_id; ?>" type="checkbox" value="<?php echo $row['addon_ID'] ?>" id="addon<?php echo $product_id; ?>">
                                                <label class="form-check-label">
                                                    <?php echo $row['addon_name']; ?>
                                                </label>
                                            </div>
                                            <div>
                                                <input type="hidden" value="<?php echo $row['addon_price']; ?>" id="aprice<?php echo $product_id; ?>">
                                                <p><?php echo $row['addon_price']; ?>Rs</p>
                                            </div>
                                    </li>
                                <?php } else {
                                            echo "No addons";
                                        } ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <?php if (($row['attr_Name'] && $row['attr_price']) > 0) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" name="attr<?php echo $product_id; ?>" type="checkbox" value="<?php echo $row['attr_ID'] ?>" id="attr<?php echo $product_id; ?>">
                                            <label class="form-check-label">
                                                <?php echo $row['attr_Name']; ?>
                                            </label>
                                        </div>
                                        <div>
                                            <input type="hidden" value="<?php echo $row['attr_price']; ?>" id="atprice<?php echo $product_id; ?>">
                                            <p><?php echo $row['attr_price']; ?>Rs</p>
                                        </div>

                                </li>
                            <?php } else {
                                        echo "No Attributes";
                                    } ?>
                            <li class=" list-group-item d-flex justify-content-between">
                                <?php if ($row['coupon_value'] > 0 && $row['coupon_status'] == 0) { ?>
                                    <div>
                                        <p>
                                            <?php echo "Discount"; ?>
                                        </p>
                                    </div>
                                    <div>
                                        <input type="hidden" name="discount_ID" class="form-control" value="<?php echo $row['coupon_id']; ?>" id="discount<?php echo $product_id; ?>">
                                        <input type="hidden" value="<?php echo $row['coupon_value']; ?>" id="discount_val<?php echo $product_id; ?>">
                                        <p><?php echo $row['coupon_name']; ?> &nbsp; (<?php echo $row['coupon_value']; ?>Rs)</p>
                                    </div>
                            </li>
                        <?php } else {
                                    echo "No Discount";
                                } ?>
                        <li class="list-group-item d-flex justify-content-between">
                            <div>
                                <div class="form-floating">
                                    <input name="qty" class="form-control" type="number" placeholder="Product Quantity" value="1" min="1" id="qty<?php echo $product_id; ?>" required>
                                    <label for=" floatingInput">Quantity</label>
                                </div>
                            </div>
                        </li>
                                </ul>
                                <br>
                                <?php if (!isset($_SESSION['username'])) { ?>
                                    <a class="btn btn-outline-primary" href="login.php">Login to add to cart</a>
                                <?php } else { ?>
                                    <Button class="btn btn-outline-primary" type="submit" name="add_to_cart" onclick="add_to_cart(<?php echo $product_id; ?>,'add')">Add to cart</Button>
                                <?php  }
                                ?>

                            </div>
                        </div>
                    </div>
            <?php }
            } ?>
        </div>
    </div>
</section>

<?php include './includes/footer-script.php'; ?>

<script>
    // add to cart
    function add_to_cart(id, type) {

        var business = jQuery("#business" + id).val();
        var discount = jQuery("#discount" + id).val();
        var qty = jQuery("#qty" + id).val();
        var addon = jQuery('input[name="addon' + id + '"]:checked').val();
        var attr = jQuery('input[name="attr' + id + '"]:checked').val();
        var pprice = jQuery("#pprice" + id).val();
        var aprice = jQuery("#aprice" + id).val();
        var atprice = jQuery("#atprice" + id).val();
        var discount_val = jQuery("#discount_val" + id).val();
        var shipping_charges = jQuery("#shipping_charges" + id).val();

        jQuery.ajax({
            url: './controller-files/cart-actions.php',
            type: 'post',
            data: 'addon=' + addon + '&attr=' + attr + '&type=' + type + '&id=' + id + '&qty=' + qty + '&discount=' + discount + '&business=' + business + '&pprice=' + pprice + '&aprice=' + aprice + '&atprice=' + atprice + '&discount_val=' + discount_val + '&shipping_charges=' + shipping_charges,
            success: function(result) {
                swal("Good job!", "Product added successfully.", "success");
            }
        });

    }
</script>



<?php
include './includes/footer.php';

?>