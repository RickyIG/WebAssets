<?php
require 'config.php';

if(isset($_POST['action'])){
    $sql = "SELECT * FROM product WHERE product_category !=''";

    if(isset($_POST['product_category'])) {
        $product_category = implode("','", $_POST['product_category']);
        $sql .= "AND product_category IN('".$product_category."')";
    }


    $result = $conn->query($sql);
    $output = '';

    if ($result -> num_rows > 0) {
        while ($row = $result -> fetch_assoc()) {
            $output .= '<div class="col-md-3 mb-2">
                        <div class="class-deck">
                            <div class="card border-secondary">
                                <img src="'.$row['product_image'].'" class="card-img-top">
                                <div class="card-img-overlay">
                                    <h6 style="margin-top:225px;" class="text-light bg-info text-center rounded p-1">
                                        '.$row['product_name'].'
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="card-title text-danger">Price : Rp'.number_format($row['product_price']).',-
                                    </h4>
                                    <p>
                                         '. $row['product_desc'].' <br>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    }
    else {
        $output = "<h3>No Products Found!</h3>";
    }
    echo $output;
}
?>