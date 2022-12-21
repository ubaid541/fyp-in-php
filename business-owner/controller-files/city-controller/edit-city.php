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
                        <i class="bi bi-pencil-fill me-2"></i>Edit City
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            City
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Update City form starts -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <?php
                        include '../../config/config.php';

                        $city_id = $_GET["id"];
                        $sql = "SELECT * FROM city where city_id = '{$city_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" id="product_form">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="city_id" class="form-control" value="<?php echo $row['city_id']; ?>">
                                                    <input name="city_name" class="form-control" type="text" placeholder="City Name" value="<?php echo $row['city_name']; ?>" required />
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <p class="text-secondary">20 chracters maximum.</p>
                                                <div class="form-floating">
                                                    <textarea name="city_tagline" class="form-control" type="text" placeholder="City Tagline" style="height: 70px" maxlength="20" required><?php echo $row['city_tagline']; ?></textarea>
                                                    <label for="floatingInput">City Tagline</label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" value="Update" name="update_city"></input>
                                        </div>
                                    </div>
                                </form>
                        <?php    }
                        }
                        ?>
                        <?php
                        if (isset($_POST['update_city'])) {
                            $city_name = mysqli_real_escape_string($conn, $_POST['city_name']);
                            $city_id = mysqli_real_escape_string($conn, $_POST['city_id']);
                            $city_tagline = mysqli_real_escape_string($conn, $_POST['city_tagline']);
                            if (strlen($city_tagline) > 20) {
                                $city_tagline_trimmed = substr($city_tagline, 0, 20);
                            } else {
                                $city_tagline_trimmed =  $_POST['city_tagline'];
                            }
                            // check if input value already exists
                            $sql = "SELECT city_name from city where city_name = '{$city_name}' AND NOT city_id = '{$city_id}'";
                            $result1 = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result1)) {
                                // if input value already exists
                                echo '<p class="alert alert-danger" role="alert">City ' . $city_name . ' already exists.</p>';
                            } else {
                                // if input value not exists the update category
                                $sql1 = "UPDATE city set city_id = '{$_POST['city_id']}',
                                city_name = '{$_POST['city_name']}', city_tagline = '{$_POST['city_tagline']}' where city_id = {$_POST['city_id']}";

                                if (mysqli_query($conn, $sql1)) {
                                    header("Location: {$hostname}cities.php");
                                }
                            }
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Update City form ends -->
    </div>
    <?php

    ?>
</main>
<!-- Category form ends here -->

<?php include '../../includes/footer.php'; ?>