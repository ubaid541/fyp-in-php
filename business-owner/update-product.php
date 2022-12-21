<?php
include './includes/header.php';
include './includes/top-bar.php';
include './includes/sidebar.php';

if ($_SESSION["user_role"] == 1) {
    include "./config/config.php";
    $pro_id = $_GET['id'];
    $sql2 = "SELECT business_id FROM products WHERE pro_id = {$pro_id}";
    $result2 = mysqli_query($conn, $sql2) or die("Query Failed.");

    $row2 = mysqli_fetch_assoc($result2);

    if ($row2['business_id'] != $_SESSION["business_id"]) {
        header("location: {$hostname}products.php");
    }
}

?>

<!-- Product form starts here -->
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
                        <i class="bi bi-pencil-fill me-2"></i>Edit Product
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Product
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Update Product form starts -->
        <div class="row">
            <div class="col-md-12 mb-5">
                <div class="card">
                    <div class="card-body">
                        <?php
                        include './config/config.php';

                        $pro_id = $_GET["id"];
                        $sql = "SELECT products.*,product_cat.product_cat_title,business.business_name FROM products
                        LEFT JOIN product_cat ON products.product_category = product_cat.product_cat_id
                        LEFT JOIN business ON products.business_id = business.business_id where products.pro_id = {$pro_id}";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/product-controller/edit-product.php" method="post" id="product_form" enctype="multipart/form-data">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="pro_id" class="form-control" type="hidden" value="<?php echo $row['pro_id']; ?>" placeholder="Product ID" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="pro_name" class="form-control" type="text" placeholder="Product Name" value="<?php echo $row['product_name']; ?>" required />
                                                    <label for="floatingInput">Product Name</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <textarea name="pro_desc" class="form-control" type="text" placeholder="Description" style="height: 100px" required><?php echo $row['product_description']; ?></textarea>
                                                    <label for="floatingInput">Description</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="pro_price" type="number" min="1" class="form-control" placeholder="Price" value="<?php echo $row['product_price']; ?>" required />
                                                    <label for="floatingInput">Price</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-select" size="4" aria-label="size 3 select example" name="pro_discount">
                                                    <option disabled>Coupon</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM coupon_code where business_id = {$_SESSION['business_id']}";
                                                    $result1 = mysqli_query($conn, $sql1) or die("Coupon Query Failed.");

                                                    if (mysqli_num_rows($result1) > 0) {
                                                        while ($row1 = mysqli_fetch_assoc($result1)) {
                                                            if ($row['discount'] == $row1['coupon_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option {$selected} value='{$row1['coupon_id']}'>{$row1['coupon_name']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="old_discount" value="<?php echo $row['discount']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <select class="form-select" size="4" aria-label="size 3 select example" name="pro_addon">
                                                <option disabled>Addons</option>
                                                <?php
                                                $sql1 = "SELECT * FROM product_addons where business_id = {$_SESSION['business_id']}";
                                                $result3 = mysqli_query($conn, $sql1) or die("Query Failed.");

                                                if (mysqli_num_rows($result3) > 0) {
                                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                                        if ($row['product_addons'] == $row3['addon_ID']) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "<option {$selected} value='{$row3['addon_ID']}'>{$row3['addon_name']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="old_addon" value="<?php echo $row['product_addons']; ?>">
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <select class="form-select" size="4" name="pro_attr">
                                                <option disabled>Attributes</option>
                                                <?php
                                                $sql3 = "SELECT * FROM product_attributes where business_id = {$_SESSION['business_id']}";
                                                $result4 = mysqli_query($conn, $sql3) or die("Query Failed.");

                                                if (mysqli_num_rows($result4) > 0) {
                                                    while ($row4 = mysqli_fetch_assoc($result4)) {
                                                        if ($row['product_attr'] == $row4['attr_ID']) {
                                                            $selected = "selected";
                                                        } else {
                                                            $selected = "";
                                                        }
                                                        echo "<option {$selected} value='{$row4['attr_ID
                                                            ']}'>{$row4['attr_Name']}</option>";
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="old_attr" value="<?php echo $row['product_attr']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-select" size="4" aria-label="size 3 select example" name="pro_cat" required>
                                                    <option disabled>Category</option>
                                                    <?php
                                                    $sql4 = "SELECT * FROM product_cat where business_id = {$_SESSION['business_id']}";
                                                    $result5 = mysqli_query($conn, $sql4) or die("Query Failed.");

                                                    if (mysqli_num_rows($result5) > 0) {
                                                        while ($row5 = mysqli_fetch_assoc($result5)) {
                                                            if ($row['product_category'] == $row5['product_cat_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option {$selected} value='{$row5['product_cat_id']}'>{$row5['product_cat_title']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="old_cat" value="<?php echo $row['product_category']; ?>">
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input id="pro_tax" name="pro_tax" type="number" min="0" class="form-control" placeholder="Tax in %" value="<?php echo $row['product_tax'];  ?>" />
                                                    <label for="floatingInput">Enter Tax in percentage (%)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <label for="">Product Image <span style="color: red;">(500*250)</span></label>
                                                <input class="form-control form-control-lg" type="file" name="new_pro_image" required>
                                                <img src="uploads/<?php echo $row['product_image']; ?>" alt="product image" style="width:500px;height:250px;">
                                            </div>
                                            <input class="form-control form-control-lg" type="hidden" name="old_pro_image" value="<?php echo $row['product_image']; ?>">
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" name="update_product" value="Update"></input>
                                        </div>
                                    </div>
                                </form>
                        <?php }
                        } else {
                            echo "Result Not Found.";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Product form ends -->
    </div>
    <?php

    ?>
</main>
<!-- Product form ends here -->

<?php include './includes/footer.php'; ?>