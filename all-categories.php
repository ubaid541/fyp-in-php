<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>

<section id="category" class="category my-5">
    <div class="container">
        <div class="row">
            <div class="heading mt-5">
                <h1>Categories</h1>
            </div>
        </div>
        <!-- sql command to fetch product category -->
        <?php $sql2 = "SELECT * from product_cat order by product_cat_id";
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
                    <?php if (($counter2 % $cols2) == 0) {
                         ?>;
                    </div>
        <?php  }
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