<?php
include './includes/header.php';
include './includes/top-bar.php';
include './includes/sidebar.php';

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
                        <i class="bi bi-pencil-fill me-2"></i>Edit Shifts
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Edit Shifts
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

                        $shift_id = $_GET["id"];
                        $sql = "SELECT * from rider_shifts where rider_shifts.shift_id = {$shift_id}";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/shifts-controller/edit-shift.php" method="post" id="product_form" enctype="multipart/form-data">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="shift_id" class="form-control" type="hidden" value="<?php echo $row['shift_id']; ?>" placeholder="Shift ID" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="shift_name" class="form-control" type="text" placeholder="Shift Name" value="<?php echo $row['shift_name']; ?>" required />
                                                    <label for="floatingInput">Shift Name</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <textarea name="shift_desc" class="form-control" type="text" placeholder="Description" style="height: 70px" required><?php echo $row['shift_desc']; ?></textarea>
                                                    <label for="floatingInput">Description</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="start_time" class="form-control" type="time" placeholder="Start Time" value="<?php echo $row['start_time']; ?>" required />
                                                    <label for="floatingInput">Start Time</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="end_time" class="form-control" type="time" placeholder="Ends Time" value="<?php echo $row['end_time']; ?>" required />
                                                    <label for="floatingInput">End Time</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" class="btn btn-danger" name="update_shift" value="Update"></input>
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
<!-- Category form ends here -->

<?php include './includes/footer.php'; ?>