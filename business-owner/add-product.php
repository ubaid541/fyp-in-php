<?php

include "./includes/header.php";
include "./includes/top-bar.php";
include "./includes/sidebar.php";
include "./config/config.php";
?>

<!-- product table starts here -->
<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <?php if (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            } ?>
            <div class="row">
                <div class="
                d-sm-flex
                align-items-center
                justify-content-between
                mb-1
                mt-5
              ">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-plus-circle-fill"></i>Add New Products
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Product
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Add product form starts -->
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <form action="./controller-files/product-controller/insert-product.php" method="post" id="product_form" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="pro_name" class="form-control" type="text" placeholder="Product Name" required />
                                            <label for="floatingInput">Product Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <textarea name="pro_desc" class="form-control" type="text" placeholder="Description" style="height: 100px" required></textarea>
                                            <label for="floatingInput">Description</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="pro_price" type="number" min="1" class="form-control" placeholder="Price" required />
                                            <label for="floatingInput">Price</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <select class="form-select" size="4" aria-label="size 3 select example" name="pro_discount">
                                        <option disabled>Coupon</option>
                                        <?php
                                        $sql = "SELECT * FROM coupon_code where business_id = {$_SESSION['business_id']}";
                                        $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['coupon_id']}'>{$row['coupon_name']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <select class="form-select" size="4" aria-label="size 3 select example" name="pro_addon">
                                        <option disabled>Addons</option>
                                        <?php
                                        $sql = "SELECT * FROM product_addons where business_id = {$_SESSION['business_id']}";
                                        $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['addon_ID']}'>{$row['addon_name']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <select class="form-select" size="4" aria-label="size 3 select example" name="pro_attr">
                                        <option disabled>Attributes</option>
                                        <?php
                                        $sql = "SELECT * FROM product_attributes where business_id = {$_SESSION['business_id']}";
                                        $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                        if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo "<option value='{$row['attr_ID']}'>{$row['attr_Name']}</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <select class="form-select" size="4" aria-label="size 3 select example" name="pro_cat" required>
                                            <option disabled>Category</option>
                                            <?php
                                            $sql = "SELECT * FROM product_cat where business_id = {$_SESSION['business_id']}";
                                            $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['product_cat_id']}'>{$row['product_cat_title']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input id="pro_tax" name="pro_tax" type="number" min="0" class="form-control" placeholder="Tax in %" />
                                            <label for="floatingInput">Enter Tax in percentage (%)</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <label for="">Product Image <span style="color: red;">(500*250)</span></label>
                                        <input class="form-control form-control-lg" type="file" name="pro_image" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <input type="submit" class="btn btn-danger" name="add_new_product" value="Save"></input>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product form ends -->
    </div>
</main>

<?php include './includes/footer.php'; ?>