<?php

include './includes/header.php';
include './includes/top-bar.php';
include './includes/sidebar.php';

?>

<!-- Category table starts here -->
<main class="mt-5 pt-3">
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
            </div>
            <div class="row">
                <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-5">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-filter"></i>Reservations
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Reservations
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->
        <!-- Tables starts here -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row" style="width: 100%">
                            <div class="col-8 mb-4 mb-lg-1">
                                <form class="d-flex ms-auto">
                                    <div class="input-group my-3 my-lg-0">
                                        <input type="text" id="searchTbl" onkeyup="myFunction()" class="form-control" placeholder="Search Table" aria-label="Search Table" aria-describedby="button-addon2" />
                                        <button class="btn btn-primary" type="button" id="button-addon2">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        include './config/config.php';
                        // calculate offset 
                        $limit = 3;
                        if (isset($_GET["page"])) {
                            $page = $_GET["page"];
                        } else {
                            $page = 1;
                        }
                        $offset = ($page - 1) * $limit;

                        // select query with offset and limit
                        if ($_SESSION["user_role"] == '0') {
                            /* select query of reservations for admin user */
                            $sql = "SELECT reservations.*,business.business_id,business.business_name,user.user_id,user.cust_username,user.phone,tables.* FROM reservations
                            LEFT JOIN business ON reservations.restaurant_id = business.business_id
                            LEFT JOIN user ON reservations.user_id = user.user_id
                            LEFT JOIN tables ON reservations.tbl_id = tables.tbl_id
                            ORDER BY reservations.rsvr_id DESC LIMIT {$offset},{$limit}";
                        } elseif ($_SESSION["user_role"] == '1') {
                            /* select query of reservations for seller user */
                            $sql = "SELECT reservations.*,business.business_id,business.business_name,user.user_id,user.cust_username,user.phone,tables.* FROM reservations
                            LEFT JOIN business ON reservations.restaurant_id = business.business_id
                            LEFT JOIN user ON reservations.user_id = user.user_id
                            LEFT JOIN tables ON reservations.tbl_id = tables.tbl_id where tables.business_id = {$_SESSION['business_id']}
                            ORDER BY tables.tbl_id DESC LIMIT {$offset},{$limit}";
                        }
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) { ?>
                            <div class="table-responsive" id="res_Table">
                                <table class="table data-table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope='col'>#</th>
                                            <th scope='col'>Table name</th>
                                            <?php if ($_SESSION["user_role"] == '0') { ?> <th scope='col'>Restaurant name</th> <?php } ?>
                                            <th scope='col'>Date</th>
                                            <th scope='col'>Start time</th>
                                            <th scope='col'>End time</th>
                                            <th scope='col'>Username</th>
                                            <th scope='col'>Phone number</th>
                                            <?php if ($_SESSION["user_role"] == '1') { ?> <th scope='col'>Edit</th> <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $serial = $offset + 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr>
                                                <th scope="row"><?php echo $serial; ?></th>
                                                <td>
                                                    <?php echo $row['tbl_name']; ?>
                                                </td>
                                                <?php if ($_SESSION["user_role"] == '0') { ?>
                                                    <td>
                                                        <?php echo $row['business_name']; ?>
                                                    </td>
                                                <?php } ?>
                                                <td>
                                                    <?php echo $row['date']; ?>
                                                </td>
                                                <td><?php echo $row['start_time']; ?></td>
                                                <td><?php echo $row['end_time']; ?></td>
                                                <td><?php echo $row['cust_username']; ?></td>
                                                <td><?php echo $row['phone']; ?></td>
                                                <td>
                                                    <div class="dropdown">

                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu shadow-lg rounded mt-1" aria-labelledby="dropdownMenuButton1">
                                                            <?php if ($_SESSION["user_role"] == '1') { ?> <li>
                                                                    <a class="dropdown-item btn" href='./update-reservation.php?id<?php echo $row['rsvr_id']; ?>'>Edit</a>
                                                                </li>
                                                            <?php } ?>
                                                            <li>
                                                                <a class="dropdown-item" href='./controller-files/reservations/delete-reservation.php?id=<?php echo $row['rsvr_id']; ?>'>Delete</a>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $serial++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {

                            echo '<h3 class="text-center">No results found.</h3>';
                        }
                        ?>

                        <!-- select query for pagination -->
                        <?php
                        if ($_SESSION["user_role"] == '1') {
                            $sql1 = "SELECT * FROM tables where business_id = {$_SESSION['business_id']} ";
                        } elseif ($_SESSION["user_role"] == '0') {
                            $sql1 = "SELECT * FROM tables";
                        }
                        $result_1 = mysqli_query($conn, $sql1);
                        if (mysqli_num_rows($result_1)) {
                            $total_record = mysqli_num_rows($result_1);
                            $total_page = ceil($total_record / $limit);
                        ?>
                            <div class="row mt-2">
                                <ul class="pagination justify-content-center">
                                    <?php if ($page > 1) {
                                        echo " <li class='page-item'>
                                    <a class='page-link' href='table.php?page=" . ($page - 1) . "' aria-label='Previous'>
                                        <span aria-hidden='true'>&laquo;</span>
                                    </a>
                                </li>";
                                    }

                                    if ($total_record > $limit) {
                                        for ($i = 1; $i <= $total_page; $i++) {
                                            if ($i == $page) {
                                                $cls = 'active';
                                            } else {
                                                $cls = '';
                                            }
                                            echo "<li class='page-item {$cls}'>
                                        <a class='page-link' href='table.php?page=" . $i . "'>$i</a>
                                    </li>";
                                        }
                                    }

                                    if ($total_page > $page) {
                                        echo " <li class='page-item'>
                                    <a class='page-link' href='table.php?page=" . ($page + 1) . "' aria-label='Next'>
                                        <span aria-hidden='true'>&raquo;</span>
                                    </a>
                                </li>";
                                    }
                                    ?>
                                </ul>
                            <?php } ?>
                            </ul>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Table ends here -->
    </div>
</main>
<!-- category table ends here -->

<?php include './includes/footer.php'; ?>
<script>
    // search inside category table
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchTbl");
        filter = input.value.toUpperCase();
        table = document.getElementById("res_Table");
        tr = table.getElementsByTagName("tr");
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
</script>