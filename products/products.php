<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>VeryNiceShop</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css' />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css' />
    <link rel="icon" type="image/png" href="../images/favicon.png" />
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #001C40">
    <a class="navbar-brand" href="../index.php"><i class="fas fa-coffee"></i>&nbsp;&nbsp;EnakBenerCafe</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="../order/order.php"><i class="fas fa-check-square mr-2"></i>Order</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="fas fa-th-list mr-2"></i>Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../order/checkout.php"><i class="fas fa-money-check-alt mr-2"></i>Checkout</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../order/cart.php"><i class="fas fa-shopping-cart"></i> <span id="cart-item" class="badge badge-danger"></span></a>
            </li>
        </ul>
    </div>
</nav>
<div class="container-fluid" style="margin-top: 10px">
    <div class="row">
        <div class="col-lg-3">
            <h5>Filter Product</h5>
            <hr>


            <h6 class="text-info">Select Category</h6>
            <ul class="list-group">
                <?php
                $sql="SELECT DISTINCT product_category FROM product ORDER BY product_category";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()) {
                    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input product-check"
                                       value="<?= $row['product_category']; ?>" id="product_category"><?=$row['product_category']; ?>

                            </label>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>

        <div class="col-lg-9">
            <h5 class="text-center" id="textChange">All Products</h5>
            <hr>
            <div class="text-center">
                <img src="../images/loader.gif" id="loader" width="200" style="display:none">
            </div>
            <div class="row" id="result">
                <?php
                $sql="SELECT * FROM product";
                $result=$conn->query($sql);
                while($row=$result->fetch_assoc()) {
                    ?>
                    <div class="col-md-3 mb-2">
                        <div class="class-deck">
                            <div class="card border-secondary">
                                <img src="<?= $row['product_image']; ?>" class="card-img-top">
                                <div class="card-img-overlay">
                                    <h6 style="margin-top:225px;" class="text-light bg-info text-center rounded p-1">
                                        <?= $row['product_name']; ?>
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title text-danger">Price : Rp<?= number_format($row['product_price']); ?>,-
                                    </h4>
                                    <p>
                                         <?= $row['product_desc']; ?> <br>
                                    </p>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(".product-check").click(function () {
            $("#loader").show();

            var action = 'data';
            var product_category = get_filter_text('product_category');


            $.ajax({
                url: 'action.php',
                method: 'POST',
                data:{action:action, product_category:product_category},
                success:function (response) {
                    $("#result").html(response);
                    $("#loader").hide();
                    $("#textChange").text("Filtered Products");
                }
            })
        });

        function get_filter_text(text_id){
            var filterData=[];
            $('#'+text_id+':checked').each(function () {
                filterData.push($(this).val());
            });
            return filterData;
        }
    });
</script>

</body>

<footer style="text-align: center; margin-top: 75px">
    <div class="container">
        <img class="logo" src="../images/logo.png">
        <p>EnakBenerCafe &#169; 2020</p>
        <p>Good Food, Good Mood</p>
    </div>
</footer>

</html>