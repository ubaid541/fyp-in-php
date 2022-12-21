<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php';
?>

<!--Wallpaper-->
<?php

$business_id = $_GET['bid'];
$sql = "SELECT * from business where business_id = {$business_id}";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<div class="alert alert-danger alert-dismissible fade show mt-5" role="alert">
    <strong><?php echo ucfirst($row['business_name']); ?></strong> We encourage you to buy the products online. <strong>Order Now...</strong>
</div>
<!-- <section id="#wallpaper" class="wallpaper">
    <div class="container-fluid">
        <div class="row">
            <img src="assets/Images/karachiWallpaper.jpg" class="img-fluid" alt="Responsive image">
        </div>
    </div>
</section> -->
<!--Navigation Bar-->
<section id="#navigation" class="navigation my-5">
    <div class="container">
        <div class="row">
            <ul class="nav nav-tabs ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#category">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#featured-products">Featured</a>
                </li>
            </ul>
        </div>
    </div>
</section>
<!--Categories etc-->
<section id="category" class="category my-5">
    <div class="container">
        <div class="row">
            <div class="heading">
                <h1>Category</h1>
            </div>
        </div>
        <!-- sql command to fetch product category -->
        <?php
        $sql1 = "SELECT * from product_cat where product_cat.business_id = {$business_id} order by product_cat_id";
        $result1 = mysqli_query($conn, $sql1) or die("Category Query Failed.");
        $row1 = mysqli_num_rows($result1);
        if ($row1 > 0) {
            $cols1 = 3;
            $counter1 = 1;
            $nbsp1 = $cols1 - ($row1 % $cols1);
            while ($categories = mysqli_fetch_assoc($result1)) {
                if (($counter1 % $cols1) == 1) { ?>
                    <div class="row">
                    <?php  } ?>
                    <div class="card card-style" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $categories['product_cat_title']; ?></h5>
                            <a href="single-category.php?caid=<?php echo $categories['product_cat_id']; ?>" class="btn btn-outline-primary">Explore</a>

                        </div>
                    </div>
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
    <!-- <div class="mx-auto">
        <a href="" class="btn btn-primary">All Categories</a>
    </div> -->
</section>
<!--Products-->
<section id="featured-products" class="featured-products">
    <div class="container">
        <div class="row">
            <div class="heading mb-4">
                <h1>Products</h1>
            </div>
        </div>
        <!-- sql command to fetch products -->
        <?php $sql3 = "SELECT products.*,business.business_id,product_addons.addon_name, product_addons.addon_price,product_attributes.attr_Name,product_attributes.attr_price from products left join business on products.business_id = business.business_id left join product_addons on products.product_addons = product_addons.addon_ID left join product_attributes on products.product_attr = product_attributes.attr_ID where products.business_id = {$business_id} order by products.pro_id";
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

<?php include './includes/footer-script.php';
include './includes/footer.php'; ?>