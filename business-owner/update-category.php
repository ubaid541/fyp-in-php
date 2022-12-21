<?php
include 'includes/header.php';
include 'includes/top-bar.php';
include 'includes/sidebar.php';

if ($_SESSION["user_role"] == 1) {
    include "./config/config.php";
    $cat_id = $_GET['id'];
    $sql2 = "SELECT business_id FROM product_cat WHERE product_cat_id = {$cat_id}";
    $result2 = mysqli_query($conn, $sql2) or die("First Query Failed.");

    $row2 = mysqli_fetch_assoc($result2);

    if ($row2['business_id'] != $_SESSION["business_id"]) {
        header("location: {$hostname}category.php");
    }
}

?>

<!-- Category form starts here -->
<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <div class="row">
                <div class="
                d-sm-flex
                align-items-center
                justify-content-between
                mb-1
                mt-5
              ">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-pencil-fill me-2"></i>Edit Category
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Coupon
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Update category form starts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        include './config/config.php';

                        $cat_id = $_GET["id"];
                        $sql = "SELECT * FROM product_cat where product_cat_id = '{$cat_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/category-controller/edit-category.php" method="post" id="product_form">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="cat_id" class="form-control" value="<?php echo $row['product_cat_id']; ?>">
                                                    <input name="cat_name" class="form-control" type="text" placeholder="Category Name" value="<?php echo $row['product_cat_title']; ?>" required />
                                                    <label for="floatingInput">Category Name</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" value="Submit" name="update_category"></input>
                                        </div>
                                    </div>
                                </form>
                        <?php    }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- edit category form ends -->
    </div>
    <?php

    ?>
</main>
<!-- Category form ends here -->

<?php include './includes/footer.php'; ?>