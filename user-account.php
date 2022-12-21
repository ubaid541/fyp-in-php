<?php
include './includes/header.php';
include './includes/top-bar.php';

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
                    <h1 class="h3 my-4 text-gray-800 text-center">
                        Your Details
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
                        include 'config.php';

                        $user_id = $_SESSION["user_id"];
                        $sql = "SELECT * FROM user where user_id = '{$user_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/edit-user-details.php" method="post" id="business_update_form">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="user_id" class="form-control" value="<?php echo $row['user_id']; ?>">
                                                    <input name="first_name" id="first_name" class="form-control" type="text" placeholder="First Name" value="<?php echo $row['first_name']; ?>" required />
                                                    <label for="floatingInput">First Name</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="last_name" id="last_name" class="form-control" type="text" placeholder="Last Name" value="<?php echo $row['last_name']; ?>" required />
                                                    <label for="floatingInput">Last Name</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="username" id="user_name" class="form-control" type="text" placeholder="User Name" value="<?php echo $row['cust_username']; ?>" required />
                                                    <label for="floatingInput">Username</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="email" id="email" class="form-control" type="email" placeholder="Email" value="<?php echo $row['email']; ?>" required />
                                                    <label for="floatingInput">Email</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="phone" id="phone" class="form-control" type="tel" placeholder="Phone" value="<?php echo $row['phone']; ?>" required />
                                                    <label for="floatingInput">Phone</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="address" id="address" class="form-control" type="text" placeholder="Address" value="<?php echo $row['address']; ?>" required />
                                                    <label for="floatingInput">Address</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-6">
                                        <div class="mb-3">
                                            <select class="form-select form-select-lg mb-3" size="3" aria-label=".form-select-lg example" name="user_city" id="business_city" required>
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
                                    <div class="row my-4">
                                        <div class="col-sm-3 col-md-12 ">
                                            <input type="submit" id="submit" class="btn btn-danger" name="update_user" value="Update Information"></input>
                                        </div>
                                    </div>
                    </div>
                    </form>
            <?php    }
                        } else {
                            echo   '<h4>No record found.</h4>';
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

<?php
include "./includes/footer.php";
include "./includes/footer-script.php";
?>