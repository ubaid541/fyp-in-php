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
                <div class="d-sm-flex align-items-center justify-content-between mb-1 mt-5">
                    <h1 class="h3 mb-0 text-gray-800">
                        <i class="bi bi-filter"></i>Business Categories
                    </h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">
                            Business Category
                        </li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- page heading ends  -->
        <!-- Category table starts here -->
        <div class="row mb-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row" style="width: 100%">
                            <div class="col-8 mb-4 mb-lg-1">
                                <form class="d-flex ms-auto">
                                    <div class="input-group my-3 my-lg-0">
                                        <input type="text" id="searchBCat" onkeyup="myFunction()" class="form-control" placeholder="Search Business Category" aria-label="Search Business Category" aria-describedby="button-addon2" />
                                        <button class="btn btn-primary" type="button" id="button-addon2">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-4 mb-3 mb-lg-0">
                                <div class="d-grid gap-2">

                                    <a data-bs-toggle="modal" data-bs-target="#addBCat" class="btn btn-primary btn-block" type="button">
                                        <i class="bi bi-plus-circle-fill"></i>
                                        Add Business Category
                                    </a>

                                </div>
                            </div>
                            <!-- add cat modal starts-->
                            <div class="modal fade" id="addBCat" tabindex="-1" aria-labelledby="addBCatLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addBCatLabel">
                                                Add Business Category
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="card">
                                                <div class="card-body">
                                                    <form action="./controller-files/business-category/insert-bCategory.php" method="post" id="Bcat_form">
                                                        <div class="row">
                                                            <div class="col-sm-3 col-md-12">
                                                                <div class="mb-3">
                                                                    <div class="form-floating">
                                                                        <input name="Bcat_name" class="form-control" type="text" placeholder="Category Name" required />
                                                                        <label for="floatingInput">Category</label>
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
                                            <button type="submit" name="add_Bcategory" value="Add_category" class="btn btn-primary">
                                                Save changes
                                            </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- add cat modal ends-->
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
                        $sql = "SELECT * from business_category limit $offset,$limit";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) { ?>
                            <div class="table-responsive" id="BcatTable">
                                <table class="table data-table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope='col'>#</th>
                                            <th scope='col'>Name</th>
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
                                                    <?php echo $row['business_cat_title']; ?>
                                                </td>
                                                <td><?php echo $row['business_date']; ?></td>
                                                <td>
                                                    <div class="dropdown">

                                                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="bi bi-gear-fill"></i>
                                                        </button>
                                                        <ul class="dropdown-menu shadow-lg rounded mt-1" aria-labelledby="dropdownMenuButton1">
                                                            <li>
                                                                <a class="dropdown-item btn" href='./controller-files/business-category/edit-bCategory.php?id=<?php echo $row['business_cat_id']; ?>'>Edit</a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item" href='./controller-files/business-category/delete-bCategory.php?id=<?php echo $row['business_cat_id']; ?>'>Delete</a>
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
                        $sql1 = "SELECT COUNT(business_cat_id) FROM business_category";
                        $result_1 = mysqli_query($conn, $sql1);
                        $row_db = mysqli_fetch_row($result_1);
                        $total_record = $row_db[0];
                        $total_page = ($total_record / $limit);
                        ?>
                        <div class="row mt-2">
                            <ul class="pagination justify-content-center">
                                <?php if ($page > 1) {
                                    echo " <li class='page-item'>
                                    <a class='page-link' href='business-category.php?page=" . ($page - 1) . "' aria-label='Previous'>
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
                                        <a class='page-link' href='business-category.php?page=" . $i . "'>$i</a>
                                    </li>";
                                    }
                                }

                                if ($total_page > $page) {
                                    echo " <li class='page-item'>
                                    <a class='page-link' href='business-category.php?page=" . ($page + 1) . "' aria-label='Next'>
                                        <span aria-hidden='true'>&raquo;</span>
                                    </a>
                                </li>";
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Category table ends here -->
    </div>
</main>
<!-- category table ends here -->

<?php include './includes/footer.php'; ?>
<script>
    // search inside category table
    function myFunction() {
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchBCat");
        filter = input.value.toUpperCase();
        table = document.getElementById("BcatTable");
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