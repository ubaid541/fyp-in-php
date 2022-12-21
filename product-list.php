<?php include 'includes/header.php';  ?>
<?php include 'includes/top-bar.php';  ?>
<section id="featured-products" class="featured-products">
    <div class="container">
        <!-- display searched products -->
        <?php
        include 'config.php';
        if (isset($_POST['search_product'])) {
            $product_name = $_POST['pro_box'];
        ?>
            <div class="row mt-5">
                <div class="heading mt-5">
                    <h4>Search results for <?php echo $product_name; ?></h4>
                </div>
                <?php

                $sql = "SELECT products.*,business.business_id,business.business_name,product_addons.addon_name, product_addons.addon_price,product_attributes.attr_Name,product_attributes.attr_price from products left join business on products.business_id = business.business_id left join product_addons on products.product_addons = product_addons.addon_ID left join product_attributes on products.product_attr = product_attributes.attr_ID where products.product_name like '%{$product_name}%' order by products.pro_id desc";

                $result = mysqli_query($conn, $sql) or die("Products Query Failed.");
                $row  = mysqli_num_rows($result);
                if ($row > 0) {
                    $cols = 3;
                    $counter = 1;
                    $nbsp = $cols - ($row % $cols);
                    while ($items = mysqli_fetch_assoc($result)) {

                        if (($counter % $cols) == 1) { ?>
                            <div class="row">
                            <?php  } ?>
                            <div class="col-sm-4 mb-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="business-owner/uploads/<?php echo $items['product_image']; ?>" class="card-img-top" alt="product-image">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $items['product_name']; ?></h5>
                                        <h5 class="card-title"><?php echo $items['product_price']; ?>Rs</h5>
                                        <p class="card-text"><?php echo substr($items['product_description'], 0, 130) . "..."; ?></p>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <?php if (($items['addon_name'] && $items['addon_price']) > 0) { ?>
                                                <p><?php echo $items['addon_name']; ?></p>
                                                <h6 class="fw-bold"><?php echo $items['addon_price']; ?>Rs</h6>
                                        </li>
                                    <?php } else {
                                                echo "No addons";
                                            } ?>
                                    <li class="list-group-item d-flex justify-content-between">
                                        <?php if (($items['attr_Name'] && $items['attr_price']) > 0) { ?>
                                            <p><?php echo $items['attr_Name']; ?></p>
                                            <h6 class="fw-bold"><?php echo $items['attr_price']; ?>Rs</h6>
                                    </li>
                                <?php } else {
                                            echo "No Attributes";
                                        } ?>
                                    </ul>
                                    <div class="card-body">
                                        <a href="single-product.php?pid=<?php echo $items['pro_id']; ?>" class="card-link"><?php echo $items['product_name']; ?></a>
                                        <a href="single-business.php?bid=<?php echo $items['business_id']; ?>" class="card-link"><?php echo $items['business_name']; ?></a>
                                    </div>
                                </div>
                            </div>
                            <?php if (($counter % $cols) == 0) { ?>
                            </div>
                        <?php }
                            $counter++; ?>

                <?php }
                    if ($nbsp > 0) {
                        for ($i = 0; $i < $nbsp; $i++) {
                            echo '<td>&nbsp;</td>';
                        }
                    }
                } else {
                    echo "No record found.";
                }
                ?>
            </div>
        <?php
        } else {
            echo "<h2>No Record Found.</h2>";
        }
        ?>


    </div>
</section>

<?php include 'includes/footer-script.php';  ?>
<?php include 'includes/footer.php';  ?>