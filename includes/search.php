<?php include 'header.php';  ?>


<form class="d-flex" action="./product-list.php" method="post">
    <input class="form-control me-2" type="text" name="pro_box" id="pro_box" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" name="search_product" id="search_product" type="submit">Search</button>
    <div class="list-group" style="position: absolute; margin-top: 2.2%;" id="pro_list">
        <!--  -->
    </div>
</form>



<?php include 'footer-script.php';  ?>
<script type="text/javascript">
    $(document).ready(function() {
        $("#pro_box").keyup(function() {
            var product = $(this).val();
            if (product != '') {
                $.ajax({
                    url: "./controller-files/search-product.php",
                    method: "POST",
                    data: {
                        product: product
                    },
                    success: function(data) {
                        $("#pro_list").fadeIn("fast").html(data);
                    }
                });
            } else {
                $("#pro_list").fadeOut();
            }
        });
        // set search term to an event
        $(document).on('click', '#pro_list a', function() {
            $('#pro_box').val($(this).text());
            $("#pro_list").fadeOut();
        });
    });
</script>