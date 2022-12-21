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
                        <i class="bi bi-filter"></i>Addons
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Addon
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->
        <!-- Addons table starts here -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row" style="width: 100%">
                            <div class="col-8 mb-4 mb-lg-1">
                                <form class="d-flex ms-auto">
                                    <div class="input-group my-3 my-lg-0">
                                        <input type="text" id="searchAddon" onkeyup="myFunction()" class="form-control" placeholder="Search Addons" aria-label="Search Addon" aria-describedby="button-addon2" />
                                        <button class="btn btn-primary" type="button" id="button-addon2">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 mb-3 mb-lg-0">
                                <div class="d-grid gap-2">
                                    <?php if ($_SESSION["user_role"] == '1') { ?>
                                        <a data-bs-toggle="modal" data-bs-target="#addAddon" class="btn btn-primary btn-block" type="button">
                                            <i class="bi bi-plus-circle-fill"></i>
                                            Add Addon
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- add addon modal starts-->
                            <div class="modal fade" id="addAddon" tabindex="-1" aria-labelledby="addAddonLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addAddonLabel">
                                                Add Addon
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="./controller-files/addon-controller/insert-addon.php" method="post" id="cat_form" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-floating">
                                                                        <input name="addon_name" class="form-control" type="text" placeholder="Addon Name" required />
                                                                        <label for="floatingInput">Addon Name</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-floating">
                                                                        <input name="addon_price" class="form-control" type="number" placeholder="Addon Price" required />
                                                                        <label for="floatingInput">Price</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                Cancel
                                            </button>
                                            <button type="submit" name="add_addon" class="btn btn-primary">
                                                Save changes
                                            </button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- add addon modal ends-->
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
                        // $sql = "SELECT * from product_addons limit $offset,$limit";
                        if ($_SESSION["user_role"] == '0') {
                            /* select query of category table for admin user */
                            $sql = "SELECT * FROM product_addons ORDER BY addon_ID DESC LIMIT {$offset},{$limit}";
                        } elseif ($_SESSION["user_role"] == '1') {
                            /* select query of category table for seller user */
                            $sql = "SELECT * FROM product_addons where product_addons.business_id = {$_SESSION['business_id']}
                        ORDER BY product_addons.addon_ID DESC LIMIT {$offset},{$limit}";
                        }
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) { ?>
                            <div class="table-responsive" id="addonTable">
                                <table class="table data-table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope='col'>#</th>
                                            <th scope='col'>Name</th>
                                            <th scope='col'>Price</th>
                                            <th scope='col'>Date</th>
                                            <th scope='col'>Edit</th>
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
                                                    <?php echo $row['addon_name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['addon_price']; ?>
                                                </td>
                                                <td><?php echo $row['add_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu shadow-lg rounded mt-1" aria-labelledby="dropdownMenuButton1">
                                                            <?php if ($_SESSION["user_role"] == '1') { ?>
                                                                <li>
                                                                    <a class="dropdown-item btn" href='update-addon.php?id=<?php echo $row['addon_ID']; ?>'>Edit</a>
                                                                </li>
                                                            <?php } ?>
                                                            <li>
                                                                <a class="dropdown-item" href='./controller-files/addon-controller/delete-addon.php?id=<?php echo $row['addon_ID']; ?>'>Delete</a>
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
                        //$sql1 = "SELECT COUNT(addon_ID) FROM product_addons";
                        if ($_SESSION["user_role"] == '1') {
                            $sql1 = "SELECT * FROM product_addons where business_id = {$_SESSION['business_id']} ";
                        } elseif ($_SESSION["user_role"] == '0') {
                            $sql1 = "SELECT * FROM product_addons";
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
                                    <a class='page-link' href='addons.php?page=" . ($page - 1) . "' aria-label='Previous'>
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
                                        <a class='page-link' href='addons.php?page=" . $i . "'>$i</a>
                                    </li>";
                                        }
                                    }

                                    if ($total_page > $page) {
                                        echo " <li class='page-item'>
                                    <a class='page-link' href='addons.php?page=" . ($page + 1) . "' aria-label='Next'>
                                        <span aria-hidden='true'>&raquo;</span>
                                    </a>
                                </li>";
                                    }
                                    ?>
                                </ul>
                            <?php } ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Addons table ends here -->
    </div>
</main>
<!-- category table ends here -->

<?php include './includes/footer.php'; ?>
<script>
    // search inside addon table
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchAddon");
        filter = input.value.toUpperCase();
        table = document.getElementById("addonTable");
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