<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>

<section id="single-category" class="featured-products">
    <div class="container">
        <!-- display Single category -->
        <?php
        include 'config.php';
        if (isset($_GET['caid'])) {
            $pro_cat_id = $_GET['caid'];

            $sql1 = "SELECT * FROM product_cat WHERE product_cat_id = {$pro_cat_id}";
            $result1 = mysqli_query($conn, $sql1) or die("Category title Query Failed.");
            $row1 = mysqli_fetch_assoc($result1);
        ?>
            <div class="row mt-5">
                <div class="heading my-5">
                    <h4>Category: <?php echo ucfirst($row1['product_cat_title']); ?></h4>
                </div>
                <?php
                $sql = "SELECT products.*,business.business_id,business.business_name,product_addons.addon_name, product_addons.addon_price,product_attributes.attr_Name,product_attributes.attr_price from products left join business on products.business_id = business.business_id left join product_addons on products.product_addons = product_addons.addon_ID left join product_attributes on products.product_attr = product_attributes.attr_ID where products.product_category = {$pro_cat_id}";
                $result = mysqli_query($conn, $sql) or die("Products Query Failed.");
                $row  = mysqli_num_rows($result); ?>
                <?php
                if ($row > 0) {
                    $cols = 3;
                    $counter = 1;
                    $nbsp = $cols - ($row % $cols);
                    while ($product = mysqli_fetch_assoc($result)) {

                        if (($counter % $cols) == 1) { ?>
                            <div class="row">
                            <?php  } ?>
                            <div class="col-sm-4 mb-4">
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
                    echo "<h1>No record found.</h1>";
                }
                ?>
            </div><?php
                } else {
                    echo "<h2>No Record Found.</h2>";
                }
                    ?>


    </div>
</section>

<?php include './includes/footer-script.php';
include './includes/footer.php'; ?>