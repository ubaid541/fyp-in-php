<?php
include '../../includes/header.php';
include '../../includes/top-bar.php';
include '../../includes/sidebar.php';

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
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Product
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
                        include '../../config/config.php';

                        $cat_id = $_GET["id"];
                        $sql = "SELECT * FROM product_cat where product_cat_id = '{$cat_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="product_form">
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
                        <?php
                        if (isset($_POST['update_category'])) {
                            $category = mysqli_real_escape_string($conn, $_POST['cat_name']);
                            $cat_id = mysqli_real_escape_string($conn, $_POST['cat_id']);
                            // check if input value already exists
                            $sql = "SELECT product_cat_title from product_cat where product_cat_title = '{$category}' AND NOT product_cat_id = '{$cat_id}'";
                            $result1 = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result1)) {
                                // if input value already exists
                                echo '<p class="alert alert-danger" role="alert">Category ' . $category . ' already exists.</p>';
                            } else {
                                // if input value not exists the update category
                                $sql1 = "UPDATE product_cat set product_cat_id = '{$_POST['cat_id']}',
                                product_cat_title = '{$_POST['cat_name']}' where product_cat_id = {$_POST['cat_id']}";

                                if (mysqli_query($conn, $sql1)) {
                                    header("Location: {$hostname}/category.php");
                                }
                            }
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

<?php include '../../includes/footer.php'; ?>