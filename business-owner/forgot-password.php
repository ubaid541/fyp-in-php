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
                        Forgot Password
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
                        <form action="./user-authentication/process-forgot-password.php" method="post" id="product_form" enctype="multipart/form-data">
                            <div class="row mb-4">
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="form-floating">
                                            <input name="email" class="form-control" type="email" placeholder="Email" required />
                                            <label for="floatingInput">Email</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 col-md-12">
                                    <div class="mb-3">
                                        <div class="col-sm-3 col-md-12 mt-3">
                                            <select class="form-select" aria-label="Default select example" name="role">
                                                <option selected>Login As: </option>
                                                <option value="0">Admin</option>
                                                <option value="1">Seller</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-3 col-md-12 d-grid gap-2">
                                        <input type="submit" class="btn btn-danger" name="forgotPass" value="Send Mail"></input>
                                    </div>
                        </form>
                        <div class="row mt-5 text-center">
                            <a class="link-primary" href="index.php">
                                <h4>Back to login</h4>
                            </a>
                        </div>

                    </div>
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