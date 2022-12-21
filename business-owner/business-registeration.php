<?php
include "./includes/header.php";
include './config/config.php';
?>

<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <div class="row">
                <div class="
                align-items-center
                mb-1
                mt-5
              ">
                    <h1 class="h3 mb-0 text-gray-800 text-center">
                        Register Your Business
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
                        <form action="./controller-files/register-business/process-business-reg.php" method="post" id="product_form">
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="first_name" class="form-control" type="text" placeholder="First Name" required />
                                            <label for="floatingInput">First Name</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="last_name" class="form-control" type="text" placeholder="Last Name" required />
                                            <label for="floatingInput">Last Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="user_name" class="form-control" type="text" placeholder="User Name" required />
                                            <label for="floatingInput">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="email" class="form-control" type="email" placeholder="Email" required />
                                            <label for="floatingInput">Email</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="phone" class="form-control" type="tel" placeholder="Phone" required />
                                            <label for="floatingInput">Phone</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="password" class="form-control" type="password" placeholder="Password" required />
                                            <label for="floatingInput">Password</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="address" class="form-control" type="text" placeholder="Address" required />
                                            <label for="floatingInput">Address</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-6">
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="role" disabled>
                                            <option value="1">Seller</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="business_name" class="form-control" type="text" placeholder="Business Name" required />
                                            <label for="floatingInput">Business Name</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="business_city" id="business_city" required>
                                            <option selected>City: </option>
                                            <?php
                                            $sql = "SELECT * FROM city";
                                            $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['city_id']}'>{$row['city_name']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="business_type" id="business_type" required>
                                            <option selected>Business Type: </option>
                                            <?php
                                            $sql = "SELECT * FROM business_type";
                                            $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['business_type_id']}'>{$row['business_type_name']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <select class="form-select form-select-lg mb-3" size="3" aria-label=".form-select-lg example" name="business_cat" id="business_cat" required>
                                            <option selected>Business Category: </option>
                                            <?php
                                            $sql = "SELECT * FROM business_category";

                                            $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                            if (mysqli_num_rows($result) > 0) {
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='{$row['business_cat_id']}'>{$row['business_cat_title']}</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-4 d-flex justify-content-end">
                                <div class="col-sm-3 col-md-6">
                                    <input type="submit" class="btn btn-danger" name="register_business" value="Register Business"></input>
                                </div>
                                <div class="col-sm-3 col-md-6 text-end">
                                    <a href="index.php" class="btn btn-primary" name="">Login</a>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!--Register business form ends -->
    </div>
    </div>


    </div>
</main>

<?php include "./includes/footer.php"; ?>