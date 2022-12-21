<?php
include './includes/header.php';
include './includes/top-bar.php';
include './includes/sidebar.php';

?>

<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <div class="row">
                <?php if (isset($_SESSION['status'])) {
                    echo "<div class='alert alert-success' role='alert'>" . $_SESSION['status'] . "</div>";
                    unset($_SESSION['status']);
                } elseif (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                } ?>
                <div class="
                align-items-center
                mb-1
                mt-5
              ">
                    <h1 class="h3 mb-0 text-gray-800 text-center">
                        Update Business Details
                    </h1>

                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Register business form-->
        <div class="row justify-content-center">
            <div class="col-md-8 mb-5">
                <div class="card mb-5">
                    <div class="card-body">
                        <?php
                        include './config.php';

                        $rider_id = $_SESSION["rider_ID"];
                        $sql = "SELECT * FROM rider where rider_ID = '{$rider_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/edit-rider-details.php" method="post">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="rider_id" class="form-control" value="<?php echo $row['rider_ID']; ?>">
                                                    <input name="name" class="form-control" type="text" placeholder="sName" value="<?php echo $row['name']; ?>" required />
                                                    <label for="floatingInput">Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="username" id="last_name" class="form-control" type="text" placeholder="Username" value="<?php echo $row['username']; ?>" required />
                                                    <label for="floatingInput">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="email" class="form-control" type="email" placeholder="Email" value="<?php echo $row['email']; ?>" required />
                                                    <label for="floatingInput">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="phone" id="phone" class="form-control" type="tel" placeholder="Phone" value="<?php echo $row['phone']; ?>" required />
                                                    <label for="floatingInput">Phone</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="address" id="address" class="form-control" type="text" placeholder="Address" value="<?php echo $row['address']; ?>" required />
                                                    <label for="floatingInput">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg mb-3" size="3" aria-label=".form-select-lg example" name="rider_city" required>
                                                    <option disabled>City: </option>
                                                    <?php
                                                    $sql2 = "SELECT * FROM city";
                                                    $result2 = mysqli_query($conn, $sql2) or die("City Query Failed.");

                                                    if (mysqli_num_rows($result2) > 0) {
                                                        while ($row2 = mysqli_fetch_assoc($result2)) {
                                                            if ($row['city'] == $row2['city_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option {$selected} value='{$row2['city_id']}'>{$row2['city_name']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="old_city" value="<?php echo $row['city']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 ">
                                        <div class="col-sm-3 col-md-12 text-center">
                                            <input type="submit" class="btn btn-danger" name="update_rider" value="Update Rider"></input>
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
        <!--Register business form ends -->
    </div>
    </div>


    </div>
</main>

<?php include "./includes/footer.php"; ?>