<?php
include 'includes/header.php';
include 'includes/top-bar.php';
include 'includes/sidebar.php';

if ($_SESSION["user_role"] == 1) {
    include "./config/config.php";
    $coupon_id = $_GET['id'];
    $sql2 = "SELECT business_id FROM coupon_code WHERE coupon_id = {$coupon_id}";
    $result2 = mysqli_query($conn, $sql2) or die("First Query Failed.");

    $row2 = mysqli_fetch_assoc($result2);

    if ($row2['business_id'] != $_SESSION["business_id"]) {
        header("location: {$hostname}coupons.php");
    }
}


?>

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
                        <i class="bi bi-pencil-fill me-2"></i>Edit Coupon
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

        <!-- Update coupon form starts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <?php
                        include './config/config.php';
                        $coupon_id = $_GET["id"];
                        $sql = "SELECT * FROM coupon_code where coupon_id = '{$coupon_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/coupon/edit-coupon.php" method="post" id="cat_form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="cpn_id" class="form-control" value="<?php echo $row['coupon_id']; ?>">
                                                    <input name="cpn_name" class="form-control" type="text" placeholder="Coupon Name" value="<?php echo $row['coupon_name']; ?>" required />
                                                    <label for="floatingInput">Coupon Name</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <textarea name="cpn_desc" class="form-control" type="text" placeholder="Description" style="height: 80px" required><?php echo $row['coupon_desc']; ?></textarea>
                                                    <label for="floatingInput">Description</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="cpn_val" class="form-control" type="number" placeholder="Coupon value" value="<?php echo $row['coupon_value']; ?>" required />
                                                    <label for="floatingInput">Value</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="cpn_exp_date" class="form-control" type="date" placeholder="Coupon expiry date" value="<?php echo $row['coupon_expired']; ?>" required />
                                                    <label for="floatingInput">Expiry Date</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="cpn_status">
                                                    <?php if ($row['coupon_status'] == 0) { ?>
                                                        <option value="0" selected>Active</option>
                                                        <option value="1">Disable</option>
                                                    <?php } else { ?>
                                                        <option value="0">Active</option>
                                                        <option value="1" selected>Disable</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" value="Submit" name="update_coupon"></input>
                                        </div>
                                    </div>
                    </div>
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

    <!-- Update coupon form ends -->
    </div>
    <?php

    ?>
</main>




<?php include './includes/footer.php'; ?>