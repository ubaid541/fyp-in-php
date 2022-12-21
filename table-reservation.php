<?php include './includes/header.php';
include './includes/top-bar.php';
include 'config.php'; ?>

<!-- table reservation from starts  -->
<div class="row justify-content-center">

    <div class="page-heading">
        <h1 class="h3 mb-0 text-gray-800" style="margin-top: 50px;">
            Reserve Table
        </h1>
        <div class="row">
            <?php if (isset($_SESSION['status'])) {
                echo "<div class='alert alert-success' role='alert'>" . $_SESSION['status'] . "</div>";
                unset($_SESSION['status']);
            } elseif (isset($_SESSION['error'])) {
                echo "<div class='alert alert-danger' role='alert'>" . $_SESSION['error'] . "</div>";
                unset($_SESSION['error']);
            } ?>
        </div>
    </div>
    <div class="col-md-8 mb-5">
        <div class="card my-5">
            <div class="card-body">
                <form action="./controller-files/process-reservation/process-table-reservation.php" method="post" id="reservation_form">
                    <div class="row">
                        <div class="col-sm-3 col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-lg" id="restaurant" name="restaurant" aria-label="Default select example" required>
                                    <option value="">Select Restaurant</option>
                                </select>
                                <label for="floatingSelect">Select Restaurant</label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="reserve_date" class="form-control" type="date" placeholder="Reservation Date" required />
                                    <label for="floatingInput">Reservation Date</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="reserve_start_time" class="form-control" type="time" placeholder="Start Time" required />
                                    <label for="floatingInput">Start Time</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="reserve_end_time" class="form-control" type="time" placeholder="End Time" required />
                                    <label for="floatingInput">End Time</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div class="form-floating mb-3">
                                <select class="form-select form-select-lg" id="tbl" name="tbl" aria-label="Default select example" required>
                                    <option value=""></option>
                                </select>
                                <label for="floatingSelect">Table</label>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-6">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <input name="num_of_people" class="form-control" type="number" placeholder="Number of people" required />
                                    <label for="floatingInput">Number of people</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3 col-md-12">
                            <div class="mb-3">
                                <div class="form-floating">
                                    <textarea class="form-control" name="comment" placeholder="Comments(optional)" id="floatingTextarea2" style="height: 80px"></textarea>
                                    <label for="floatingTextarea2">Comments (optional)</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4 d-flex justify-content-center">
                        <?php if (!isset($_SESSION['username'])) { ?>
                            <div class="col-sm-3 col-md-6">
                                <a href="login.php" class=" btn btn-danger">Kindly login for table reservation.</a>
                            </div>
                        <?php } else { ?>
                            <div class="col-sm-3 col-md-6">
                                <input type="submit" class="btn btn-primary" name="reserve_table" value="Reserve Now"></input>
                            </div>
                        <?php } ?>
                    </div>
                </form>
            </div>

        </div>
    </div>

</div>
<!-- table reservation from ends  -->

<?php include './includes/footer-script.php'; ?>
<script type="text/javascript">
    $(document).ready(function() {
        function loadData(type, category_id) {
            $.ajax({
                url: "./controller-files/load-rt.php",
                type: "POST",
                data: {
                    type: type,
                    id: category_id
                },
                success: function(data) {
                    if (type == "tblData") {
                        $("#tbl").html(data);
                    } else {
                        $("#restaurant").append(data);
                    }

                }
            });
        }

        loadData();

        $("#restaurant").on("change", function() {
            var restaurant = $("#restaurant").val();

            if (restaurant != "") {
                loadData("tblData", restaurant);
            } else {
                $("#tbl").html("");
            }
        })
    });
</script>

<?php include './includes/footer.php'; ?>