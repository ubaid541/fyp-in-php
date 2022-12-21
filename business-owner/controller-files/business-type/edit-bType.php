<?php
include '../../includes/header.php';
include '../../includes/top-bar.php';
include '../../includes/sidebar.php';

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
                        <i class="bi bi-pencil-fill me-2"></i>Edit Business Type
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Business Type
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Edite addon form starts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        include '../../config/config.php';

                        $bType_id = $_GET["id"];
                        $sql = "SELECT * FROM business_type where business_type_id = '{$bType_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="addon_form">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <input type="hidden" name="business_type_id" class="form-control" value="<?php echo $row['business_type_id']; ?>">
                                                <div class="form-floating">
                                                    <input name="bType_name" class="form-control" type="text" placeholder="Business Type" value="<?php echo $row['business_type_name']; ?>" required />
                                                    <label for="floatingInput">Business Type Name</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" value="Submit" name="update_bType"></input>
                                        </div>
                                    </div>
                                </form>
                        <?php    }
                        }
                        ?>
                        <?php
                        if (isset($_POST['update_bType'])) {
                            $bType_name = mysqli_real_escape_string($conn, $_POST['bType_name']);
                            $bType_id = mysqli_real_escape_string($conn, $_POST['business_type_id']);
                            // check if input value already exists
                            $sql = "SELECT business_type_name from business_type where business_type_name = '{$bType_name}' AND NOT business_type_id = '{$bType_id}'";
                            $result1 = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result1) > 0) {
                                // if input value already exists
                                echo '<p class="alert alert-danger" role="alert">Type ' . $bType_name . ' already exists.</p>';
                            } else {
                                // if input value not exists then update addon
                                $sql1 = "UPDATE business_type set business_type_id = '{$_POST['business_type_id']}',
                                business_type_name = '{$_POST['bType_name']}' where business_type_id = {$_POST['business_type_id']}";

                                if (mysqli_query($conn, $sql1)) {
                                    header("Location: {$hostname}/business-type.php");
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edite addon form ends -->
    </div>
    <?php

    ?>
</main>
<!-- Addon ends here -->

<?php include '../../includes/footer.php'; ?>