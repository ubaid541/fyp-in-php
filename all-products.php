<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>

<!-- Products-->
<section id="featured-products" class="featured-products">
    <div class="container">
        <div class="row my-5">
            <div class="heading mt-5">
                <h1>Products</h1>
            </div>
        </div>
        <!-- sql command to fetch products -->
        <?php $sql3 = "SELECT products.*,business.business_id,business.business_name,product_addons.addon_name, product_addons.addon_price,product_attributes.attr_Name,product_attributes.attr_price 
        from products left join business on products.business_id = business.business_id 
        left join product_addons on products.product_addons = product_addons.addon_ID 
        left join product_attributes on products.product_attr = product_attributes.attr_ID 
         order by products.pro_id";
        $result3 = mysqli_query($conn, $sql3) or die("Product Query Failed.");
        $row3 = mysqli_num_rows($result3);
        if ($row3 > 0) {
            $cols3 = 3;
            $counter3 = 1;
            $nbsp3 = $cols3 - ($row3 % $cols3);
            while ($product = mysqli_fetch_assoc($result3)) {
                if (($counter3 % $cols3) == 1) { ?>
                    <div class="row">
                    <?php  } ?>
                    <div class="col-sm-4 mb-4 d-flex justify-content-center">
                        <div class="card" style="width: 18rem;">
                            <img src="business-owner/uploads/<?php echo $product['product_image']; ?>" class="card-img-top" alt="product-image">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $product['product_name']; ?></h5>
                                <h5 class="card-title"><?php echo $product['product_price']; ?>Rs</h5>
                                <p class="card-text"><?php echo substr($product['product_description'], 0, 130) . "..."; ?></p>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between">
                                    <?php if (($product['addon_name'] && $product['addon_price']) > 0) { ?>
                                        <p><?php echo $product['addon_name']; ?></p>
                                        <h6 class="fw-bold"><?php echo $product['addon_price']; ?>Rs</h6>
                                </li>
                            <?php } else {
                                        echo "No addons";
                                    } ?>
                            <li class="list-group-item d-flex justify-content-between">
                                <?php if (($product['attr_Name'] && $product['attr_price']) > 0) { ?>
                                    <p><?php echo $product['attr_Name']; ?></p>
                                    <h6 class="fw-bold"><?php echo $product['attr_price']; ?>Rs</h6>
                            </li>
                        <?php } else {
                                    echo "No Attributes";
                                } ?>
                            </ul>
                            <div class="card-body">
                                <a href="single-product.php?pid=<?php echo $product['pro_id']; ?>" class="card-link"><?php echo $product['product_name']; ?></a>
                                <a href="single-business.php?bid=<?php echo $product['business_id']; ?>" class="card-link"><?php echo $product['business_name']; ?></a>
                            </div>
                        </div>
                    </div>
                    <?php if (($counter3 % $cols3) == 0) { ?>
                    </div>
        <?php }
                    $counter3++;
                }
                if ($nbsp3 > 0) {
                    for ($i = 0; $i < $nbsp3; $i++) {
                        echo '<td>&nbsp;</td>';
                    }
                }
            } ?>
    </div>
    </div>
</section>
<!-- End Products -->

<?php include './includes/footer-script.php';
include './includes/footer.php'; ?>