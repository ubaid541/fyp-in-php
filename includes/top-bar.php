<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once("./config.php");
?>

<body data-bs-spy="scroll" data-bs-target=".navbar">
    <!--Navigation sec-->
    <section id="header" class="mb-5">
        <nav class="navbar navbar-expand-lg bg-primary fixed-top">
            <div class="container">
                <a class="navbar-brand" href="http://localhost/fatafut-mangwaen">Fatafut</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="ti-angle-double-down navbar-toggler-icon"></span>
                    <!--<span class="navbar-toggler-icon"></span>-->
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="http://localhost/fatafut-mangwaen">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all-products.php">Products</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all-categories.php">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="all-business.php">Business</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="table-reservation.php">Reservation</a>
                        </li>
                        <?php if (isset($_SESSION['username'])) { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="logout.php">Logout</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="order-history.php">Orders</a>
                            </li>
                            <li class="nav-item">
                                <a href="user-account.php" class="nav-link"><i class="bi bi-person"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="customer_chat.php">Chat</a>
                            </li>
                            <!-- count number of products added to cart -->
                            <?php
                            $sql1 = "SELECT COUNT(cart_ID) as id from product_cart where user_ID = {$_SESSION['user_id']}";
                            $count = mysqli_query($conn, $sql1);
                            $res = mysqli_fetch_assoc($count);
                            ?>
                            <li>
                                <a class="btn mt-1 me-4 position-relative" href="cart.php">
                                    <i class="bi bi-bag-dash"></i>
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                        <?php echo $res['id']; ?>
                                    </span>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                        <?php } ?>
                    </ul>
                    <?php include 'search.php'; ?>
                </div>
            </div>
        </nav>
    </section>