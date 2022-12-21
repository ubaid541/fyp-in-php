<?php
include 'includes/header.php';
include 'includes/top-bar.php';
include 'includes/sidebar.php';


if ($_SESSION["user_role"] == 1) {
    include "./config/config.php";
    $attr_id = $_GET['id'];
    $sql2 = "SELECT business_id FROM product_attributes WHERE attr_ID = {$attr_id}";
    $result2 = mysqli_query($conn, $sql2) or die("First Query Failed.");

    $row2 = mysqli_fetch_assoc($result2);

    if ($row2['business_id'] != $_SESSION["business_id"]) {
        header("location: {$hostname}attributes.php");
    }
}

?>

<!-- Addon starts here -->
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
                        <i class="bi bi-pencil-fill me-2"></i>Edit Attribute
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Attribute
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Edite attribute form starts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        include './config/config.php';

                        $attr_id = $_GET["id"];
                        $sql = "SELECT * FROM product_attributes where attr_ID = '{$attr_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/attribute-controller/edit-attr.php" method="post" id="attr_form">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <input type="hidden" name="attr_ID" class="form-control" value="<?php echo $row['attr_ID']; ?>">
                                                <div class="form-floating">
                                                    <input name="attr_name" class="form-control" type="text" placeholder="Attribute Name" value="<?php echo $row['attr_Name']; ?>" required />
                                                    <label for="floatingInput">Attribute Name</label>
                                                </div>

                                            </div>
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="attr_price" class="form-control" type="number" placeholder="Attribute Price" value="<?php echo $row['attr_price']; ?>" required />
                                                    <label for="floatingInput">Attribute Price</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" value="Submit" name="update_attr"></input>
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

    <!-- Edite attribute form ends -->
    </div>
    <?php

    ?>
</main>
<!-- Attributes ends here -->

<?php include 'includes/footer.php'; ?>