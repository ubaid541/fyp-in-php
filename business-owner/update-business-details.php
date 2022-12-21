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
                        include './config/config.php';

                        $business_id = $_SESSION["business_id"];
                        $sql = "SELECT * FROM business where business_id = '{$business_id}'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <form action="./controller-files/register-business/edit-business-details.php" method="post" id="business_update_form">
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input type="hidden" name="business_id" class="form-control" value="<?php echo $row['business_id']; ?>">
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
                                                    <input name="user_name" id="user_name" class="form-control" type="text" placeholder="User Name" value="<?php echo $row['username']; ?>" required />
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
                                                    <input name="phone" id="phone" class="form-control" type="tel" placeholder="Phone" value="<?php echo $row['b_phone']; ?>" required />
                                                    <label for="floatingInput">Phone</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="password" class="form-control" type="password" placeholder="Password" required />
                                                    <label for="floatingInput">Password</label>
                                                </div>
                                            </div>
                                        </div> -->
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-6">
                                            <div class="mb-3">
                                                <div class="form-floating">
                                                    <input name="address" id="address" class="form-control" type="text" placeholder="Address" value="<?php echo $row['b_address']; ?>" required />
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
                                                    <input name="business_name" id="business_name" class="form-control" type="text" placeholder="Business Name" value="<?php echo $row['business_name']; ?>" required />
                                                    <label for="floatingInput">Business Name</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg mb-3" size="3" aria-label=".form-select-lg example" name="business_city" id="business_city" required>
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
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="business_type" id="business_type" required>
                                                    <option disabled>Business Type: </option>
                                                    <?php
                                                    $sql3 = "SELECT * FROM business_type";
                                                    $result3 = mysqli_query($conn, $sql3) or die("Query Failed.");

                                                    if (mysqli_num_rows($result3) > 0) {
                                                        while ($row3 = mysqli_fetch_assoc($result3)) {
                                                            if ($row['business_Type'] == $row3['business_type_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option {$selected} value='{$row3['business_type_id']}'>{$row3['business_type_name']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="old_business_type" value="<?php echo $row['business_Type']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="col-sm-3 col-md-12">
                                            <div class="mb-3">
                                                <select class="form-select form-select-lg mb-3" size="3" aria-label=".form-select-lg example" name="business_cat" id="business_cat" required>
                                                    <option disabled>Business Category: </option>
                                                    <?php
                                                    $sql4 = "SELECT * FROM business_category";

                                                    $result4 = mysqli_query($conn, $sql4) or die("Query Failed.");

                                                    if (mysqli_num_rows($result4) > 0) {
                                                        while ($row4 = mysqli_fetch_assoc($result4)) {
                                                            if ($row['business_category'] == $row4['business_cat_id']) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option {$selected} value='{$row4['business_cat_id']}'>{$row4['business_cat_title']}</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="old_business_cat" value="<?php echo $row['business_category']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4">
                                        <div class="input-group mb-3">
                                            <div class="form-check">
                                                <?php if ($row['tables'] == 1) { ?>
                                                    <input class="form-check-input" name="tbl_reserve" type="checkbox" value="1" checked>
                                                <?php } else { ?>
                                                    <input class="form-check-input" name="tbl_reserve" type="checkbox" value="1">
                                                <?php } ?>
                                                <label class="form-check-label">
                                                    Table reservation feature
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-4 ">
                                        <div class="col-sm-3 col-md-6">
                                            <input type="submit" id="submit" class="btn btn-danger" name="update_business" value="Update Business"></input>
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
<!-- <script>
    $(document).ready(function() {
        $("#submit").click(function() {
            var username = $("#user_name").val();
            var email = $("#email").val();
            var business_name = $("#business_name").val();
            var phone = $("#phone").val();


            if (username == "" || email == "" || business_name == "" || phone == "") {
                $('#response').fadeIn();
                $('#response').removeClass('alert alert-success').addClass('alert alert-danger').html('All fields are required.');
            } else {
                // $('#response').html($('#submit_form').serialize());
                $.ajax({
                    url: "./controller-files/register-business/edit-business-details.php",
                    type: "POST",
                    data: $('#business_update_form').serialize(),
                    // beforesend: function() {
                    //     $('#response').fadeIn();
                    //     $('#response').removeClass('success-msg error-msg').addClass('process-msg').html('Loading response...');
                    // },
                    success: function(data) {
                        // $('#business_update_form').trigger("reset");
                        $('#response').fadeIn();
                        $('#response').removeClass('alert alert-danger').addClass('alert alert-success').html(data);
                        setTimeout(function() {
                            $('#response').fadeOut("slow");
                        }, 4000);
                    }
                });
            }
        });
    });
</script> -->