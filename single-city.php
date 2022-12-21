<?php include 'includes/header.php';  ?>
<?php include 'includes/top-bar.php';  ?>
<section id="featured-products" class="featured-products">
    <div class="container">
        <!-- display searched products -->
        <?php
        include 'config.php';
        if (isset($_GET['cid'])) {
            $city_id = $_GET['cid'];

            $sql1 = "SELECT * FROM city WHERE city_id = {$city_id}";
            $result1 = mysqli_query($conn, $sql1) or die("City title Query Failed.");
            $row1 = mysqli_fetch_assoc($result1);
        ?>
            <div class="row mt-5">
                <div class="heading mt-5">
                    <h4><?php echo ucfirst($row1['city_name']); ?> City </h4>
                    <hr class="mx-5 mb-3">
                </div>
                <?php
                $sql = "SELECT business.*,business_category.business_cat_title,city.city_id from business left join business_category on business.business_category = business_category.business_cat_id left join city on business.city = city.city_id where business.city = {$city_id}";
                $result = mysqli_query($conn, $sql) or die("Business Query Failed.");
                $row  = mysqli_num_rows($result); ?>
                <?php
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
                                    <!-- <img src="business-owner/uploads/<?php //echo $items['product_image']; 
                                                                            ?>" class="card-img-top" alt="product-image"> -->
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $items['business_name']; ?></h5>
                                    </div>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item d-flex justify-content-between">
                                            <p>Category: </p>
                                            <h6 class="fw-bold"><?php echo $items['business_cat_title']; ?></h6>
                                        </li>
                                    </ul>
                                    <div class="card-body">
                                        <!-- <a href="#" class="card-link"></a> -->
                                        <a href="single-business.php?bid=<?php echo $items['business_id']; ?>" class="card-link">Visit</a>
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
            </div><?php
                } else {
                    echo "<h2>No Record Found.</h2>";
                }
                    ?>


    </div>
</section>

<?php include 'includes/footer-script.php';  ?>
<?php include 'includes/footer.php';  ?>