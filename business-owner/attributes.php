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
                        <i class="bi bi-filter"></i>Attributes
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="admin.php">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Attributes
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
                                        <input type="text" id="searchAttributes" onkeyup="myFunction()" class="form-control" placeholder="Search Attributes" aria-label="Search Attributes" aria-describedby="button-addon2" />
                                        <button class="btn btn-primary" type="button" id="button-addon2">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 mb-3 mb-lg-0">
                                <div class="d-grid gap-2">
                                    <?php if ($_SESSION["user_role"] == '1') { ?>
                                        <a data-bs-toggle="modal" data-bs-target="#addAttrs" class="btn btn-primary btn-block" type="button">
                                            <i class="bi bi-plus-circle-fill"></i>
                                            Add Attribute
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                            <!-- add addon modal starts-->
                            <div class="modal fade" id="addAttrs" tabindex="-1" aria-labelledby="addAttrsLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addAttrsLabel">
                                                Add Attribute
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="./controller-files/attribute-controller/insert-attr.php" method="post" id="cat_form" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-floating">
                                                                        <input name="attr_name" class="form-control" type="text" placeholder="Attribute Name" required />
                                                                        <label for="floatingInput">Attribute Name</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-floating">
                                                                        <input name="attr_price" class="form-control" type="number" placeholder="Attribute Price" required />
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
                                            <button type="submit" name="add_attr" class="btn btn-primary">
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
                        if ($_SESSION["user_role"] == '0') {
                            /* select query of attribute table for admin user */
                            $sql = "SELECT * FROM product_attributes ORDER BY attr_ID DESC LIMIT {$offset},{$limit}";
                        } elseif ($_SESSION["user_role"] == '1') {
                            /* select query of attribute table for seller user */
                            $sql = "SELECT * FROM product_attributes where product_attributes.business_id = {$_SESSION['business_id']}
                        ORDER BY product_attributes.attr_ID DESC LIMIT {$offset},{$limit}";
                        }
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) { ?>
                            <div class="table-responsive" id="attrTable">
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
                                                    <?php echo $row['attr_Name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['attr_price']; ?>
                                                </td>
                                                <td><?php echo $row['attr_date']; ?></td>
                                                <td>

                                                    <div class="dropdown">
                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu shadow-lg rounded mt-1" aria-labelledby="dropdownMenuButton1">
                                                            <?php if ($_SESSION["user_role"] == '1') { ?>
                                                                <li>
                                                                    <a class="dropdown-item btn" href='update-attr.php?id=<?php echo $row['attr_ID']; ?>'>Edit</a>
                                                                </li>
                                                            <?php } ?>
                                                            <li>
                                                                <a class="dropdown-item" href='./controller-files/attribute-controller/delete-attr.php?id=<?php echo $row['attr_ID']; ?>'>Delete</a>
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
                            $sql1 = "SELECT * FROM product_attributes where business_id = {$_SESSION['business_id']} ";
                        } elseif ($_SESSION["user_role"] == '0') {
                            $sql1 = "SELECT * FROM product_attributes";
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
                                    <a class='page-link' href='attributes.php?page=" . ($page - 1) . "' aria-label='Previous'>
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
                                        <a class='page-link' href='attributes.php?page=" . $i . "'>$i</a>
                                    </li>";
                                        }
                                    }

                                    if ($total_page > $page) {
                                        echo " <li class='page-item'>
                                    <a class='page-link' href='attributes.php?page=" . ($page + 1) . "' aria-label='Next'>
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
        input = document.getElementById("searchAttributes");
        filter = input.value.toUpperCase();
        table = document.getElementById("attrTable");
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