<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>


<!--Carousel-->
<section id="home" class="home pt-5 overflow-hidden main">
    <div class="row mt-3 col-sm-8">
        <?php if (isset($_SESSION['status'])) {
            echo "<div class='alert alert-success' role='alert'>" . $_SESSION['status'] . "</div>";
            unset($_SESSION['status']);
        } elseif (isset($_SESSION['error'])) {
            echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
            unset($_SESSION['error']);
        } ?>
    </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="home-banner home-banner-1">
                    <div class="home-banner-text">
                        <h1>Fatafut Mangwaen</h1>
                        <h2>Home delivery application</h2>
                        <a href="all-products.php" class="btn btn-danger text-uppercase mt-4">Our Product</a>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="home-banner home-banner-2">
                    <div class="home-banner-text">
                        <h1>E-Shop</h1>
                        <h2>With Working Card & PayPal</h2>
                        <a href="all-business.php" class="btn btn-danger text-uppercase mt-4">Our Businesses</a>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true">
                <span class="ti-angle-left slider-icon"></span>
            </span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true">
                <span class="ti-angle-right slider-icon"></span>
            </span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<br>
<!--Cities Section-->
<div class="offers">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="headline text-center mb5">
                    <h2 class="pb-3 position-relative d-inline-block">Cities</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <!-- sql command to fetch cities -->
        <?php $sql1 = "SELECT * from city order by city_id limit 0, 3";
        $result1 = mysqli_query($conn, $sql1) or die("City Query Failed.");
        $row1  = mysqli_num_rows($result1);
        if ($row1 > 0) {
            $cols1 = 3;
            $counter1 = 1;
            $nbsp1 = $cols1 - ($row1 % $cols1);
            while ($cities = mysqli_fetch_assoc($result1)) {
                if (($counter1 % $cols1) == 1) { ?>
                    <div class="row">
                    <?php  } ?>
                    <!--OfferBox-->
                    <div class="col-sm-6 col-lg-4 mb-lg-0 mb-4">
                        <a href="#"></a>
                        <div class="offer-box text-center position-relative">
                            <div class="offer-inner">
                                <div class="offer-image position-relative overflow-hidden">
                                    <img src="assets/Images/karachi.jpg" alt="offers" class="img-fluid">
                                    <div class="offer-overlay"></div>
                                </div>
                                <div class="offer-info">
                                    <div class="offer-info-inner">
                                        <p class="heading-bigger text-capitalize"><?php echo $cities['city_name']; ?></p>
                                        <p class="offer-title-1 text-uppercase font-weight-bold"><?php echo $cities['city_tagline']; ?>The city of Quaid</p>
                                        <a href="single-city.php?cid=<?php echo $cities['city_id']; ?>" class="btn btn-outline-danger " role="button" aria-pressed="true"><?php echo $cities['city_name']; ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--End-->
                    <?php if (($counter1 % $cols1) == 0) { ?>
                    </div>
        <?php }
                    $counter1++;
                }
                if ($nbsp1 > 0) {
                    for ($i = 0; $i < $nbsp1; $i++) {
                        echo '<td>&nbsp;</td>';
                    }
                }
            } ?>
    </div>
</div>
<!--Category Sec-->
<section id="category" class="category my-5 ">
    <div class="container">
        <div class="row">
            <div class="heading">
                <h1>Category</h1>
            </div>
        </div>
        <!-- sql command to fetch product category -->
        <?php $sql2 = "SELECT * from product_cat order by product_cat_id limit 6";
        $result2 = mysqli_query($conn, $sql2) or die("Category Query Failed.");
        $row2 = mysqli_num_rows($result2);
        if ($row2 > 0) {
            $cols2 = 3;
            $counter2 = 1;
            $nbsp2 = $cols2 - ($row2 % $cols2);
            while ($categories = mysqli_fetch_assoc($result2)) {
                if (($counter2 % $cols2) == 1) { ?>
                    <div class="row d-flex justify-content-center">
                    <?php  } ?>
                    <div class="card card-style" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $categories['product_cat_title']; ?></h5>
                            <a href="single-category.php?caid=<?php echo $categories['product_cat_id']; ?>" class="btn btn-outline-primary">Explore</a>

                        </div>
                    </div>
                    <?php if (($counter2 % $cols2) == 0) { ?>
                    </div>
        <?php }
                    $counter2++;
                }
                if ($nbsp2 > 0) {
                    for ($i = 0; $i < $nbsp2; $i++) {
                        echo '<td>&nbsp;</td>';
                    }
                }
            } ?>
    </div>
    <div class="d-flex justify-content-center">
        <a href="all-categories.php" class="btn btn-primary">All Categories</a>
    </div>
</section>

<!-- Products-->
<section id="featured-products" class="featured-products">
    <div class="container">
        <div class="row">
            <div class="heading mb-4">
                <h1>Products</h1>
            </div>
        </div>
        <!-- sql command to fetch products -->
        <?php $sql3 = "SELECT products.*,business.business_id,business.business_name,product_addons.addon_name, product_addons.addon_price,product_attributes.attr_Name,product_attributes.attr_price from products left join business on products.business_id = business.business_id left join product_addons on products.product_addons = product_addons.addon_ID left join product_attributes on products.product_attr = product_attributes.attr_ID  order by products.pro_id limit 6";
        $result3 = mysqli_query($conn, $sql3) or die("Product Query Failed.");
        $row3 = mysqli_num_rows($result3);
        if ($row3 > 0) {
            $cols3 = 3;
            $counter3 = 1;
            $nbsp3 = $cols3 - ($row3 % $cols3);
            while ($product = mysqli_fetch_assoc($result3)) {
                if (($counter3 % $cols3) == 1) { ?>
                    <div class="row d-flex justify-content-center">
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
    <div class="mx-auto mb-4">
        <a href="all-products.php" class="btn btn-primary">All Products</a>
    </div>
</section>
<!-- End Products -->
<!--Contact Sec-->
<section id="contact" class="contact">
    <div class="container-fluid bg-grey col-sm-9">
        <h2 class="text-center mb-4">CONTACT</h2>
        <div class="row">
            <div class="col-md-6">
                <p>Contact us and we'll get back to you within 24 hours.</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> Pakistan</p>
                <!-- <p><span class="glyphicon glyphicon-phone"></span> +00 1515151515</p> -->
                <p><span class="glyphicon glyphicon-envelope"></span> admin@gmail.com</p>
            </div>

            <div class="col-md-6">
                <form action="./controller-files/contact.php" method="post">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <input class="form-control mb-4" id="name" name="name" placeholder="Name" type="text" required>
                        </div>
                        <div class="col-sm-6 form-group">
                            <input class="form-control mb-4" id="email" name="email" placeholder="Email" type="email" required>
                        </div>
                    </div>
                    <textarea class="form-control mb-2" id="comments" name="comment" placeholder="Comment" rows="5"></textarea><br>
                    <div class="row">
                        <div class="col-sm-12 form-group">
                            <button type="submit" class="btn btn-primary pull-right" name="contact">Contact</button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</section>

<?php include './includes/footer-script.php';
include './includes/footer.php'; ?>