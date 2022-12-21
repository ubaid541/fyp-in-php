<?php
include "./includes/header.php";
include "./config/config.php";

if (isset($_SESSION["username"])) {
    header("Location: {$hostname}admin.php");
}
?>

<main class="mt-5 pt-3" style="padding-right: 1.5rem">
    <div class="container-fluid">
        <!-- page heading starts  -->
        <div class="page-heading">
            <div class="row">
                <?php if (isset($_SESSION['error'])) {
                    echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
                    unset($_SESSION['error']);
                } ?>
            </div>
            <div class="row">
                <div class="
                align-items-center
                mb-1
                mt-5
              ">
                    <h1 class="h3 mb-0 text-gray-800 text-center">
                        Login
                    </h1>

                </div>
            </div>
        </div>
        <!-- page heading ends  -->

        <!-- Login user form-->
        <div class="row justify-content-center">
            <div class="col-md-6 mb-5">
                <div class="card mb-5">
                    <div class="card-body">
                        <form action="./user-authentication/process-login.php" method="post" id="product_form" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="user_name" class="form-control" type="text" placeholder="User Name" required />
                                            <label for="floatingInput">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="password" class="form-control" type="password" placeholder="Password" required />
                                            <label for="floatingInput">Password</label>
                                        </div>
                                        <div class="col-sm-3 col-md-12 mt-3">
                                            <select class="form-select" aria-label="Default select example" name="role">
                                                <option selected>Login As: </option>
                                                <option value="0">Admin</option>
                                                <option value="1">Seller</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="row">
                                        <h5>Forgot Password?<a class="link-primary" href="forgot-password.php"> Click here</a></h5>
                                    </div> -->
                                </div>

                            </div>
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12 d-grid gap-2">
                                    <input type="submit" class="btn btn-danger" name="loginUser" value="Login"></input>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <h5 class="text-center">Not registered?<a class="link-primary" href="business-registeration.php"> Get Registered</a></h5>
                        </div>
                        <div class="row mt-4">
                            <h5 class="text-center">OR </h5>
                        </div>
                        <div class="row mt-4">
                            <h5 class="text-center"><a class="link-primary" href="register-admin.php"> Register As Admin</a></h5>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!--Login user form ends -->
    </div>
    </div>


    </div>
</main>


<?php include "./includes/footer.php"; ?>