<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>

<section id="category" class="category my-5">
    <div class="container">
        <div class="row">
            <div class="heading mt-5">
                <h1>Business</h1>
            </div>
        </div>
        <!-- sql command to fetch product category -->
        <?php
        // if (isset($_SESSION['username'])) {
        //     $sql2 = "SELECT business.*,business_category.*,business_type.*,city.*,user.* 
        //     from business 
        //     left join business_category on business.business_category = business_category.business_cat_id 
        //     left join business_type on business.business_Type = business_type.business_type_id 
        //     left join city on business.city = city.city_id 
        //     left join user on business.city = user.city 
        //     where business.city = user.city order by business_id";
        // } else {
        $sql2 = "SELECT business.*,business_category.*,business_type.*,city.* 
            from business 
            left join business_category on business.business_category = business_category.business_cat_id 
            left join business_type on business.business_Type = business_type.business_type_id
             left join city on business.city = city.city_id 
             order by business_id";
        //}
        $result2 = mysqli_query($conn, $sql2) or die("Business Query Failed.");
        $row2 = mysqli_num_rows($result2);
        if ($row2 > 0) {
            $cols2 = 3;
            $counter2 = 1;
            $nbsp2 = $cols2 - ($row2 % $cols2);
            while ($business = mysqli_fetch_assoc($result2)) {
                if (($counter2 % $cols2) == 1) { ?>
                    <div class="row">
                    <?php  } ?>
                    <div class="card card-style" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $business['business_name']; ?></h5>
                            <ul class="list-group list-group-flush my-4">
                                <li class="list-group-item d-flex justify-content-between">
                                    <h6 class="fw-bold">City</h6>
                                    <p><?php echo $business['city_name']; ?></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <h6 class="fw-bold">Type</h6>
                                    <p><?php echo $business['business_type_name']; ?></p>
                                </li>
                                <li class="list-group-item d-flex justify-content-between">
                                    <h6 class="fw-bold">Category </h6>
                                    <p><?php echo $business['business_cat_title']; ?></p>
                                </li>
                            </ul>
                            <a href="single-business.php?bid=<?php echo $business['business_id']; ?>" class="btn btn-outline-primary">Explore</a>
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
</section>

<?php include './includes/footer-script.php';
include './includes/footer.php'; ?>