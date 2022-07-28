<?php


function displayProductsCust($productname, $productprice, $productimg, $productid ,$prodquantity){
    
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
        <form action=\"index.php\" method=\"post\">
            <div class=\"card shadow\">
                <div>
                    <img src=\"../AddProducts/Thumbnail/$productimg\" alt=\"Image1\" class=\"img-fluid img-card card-img-top\">
                </div>
            <div class=\"card-body\">
            <h5 class=\"card-title\">$productname</h5>
                <h6>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"fas fa-star\"></i>
                    <i class=\"far fa-star\"></i>
                </h6>
            <h5>
            <small><s class=\"text-secondary\">$519</s></small>
            <span class=\"price\">$productprice</span><br>
            <a class=\"brand-text\" href=\"viewSingleProduct.php?id=$productid\">more info</a><small><s class=\"text-secondary\">$519</s></small>
            <span class=\"price\">$productprice</span><br>
            <a class=\"brand-text\" href=\"testDB.php?id=$productid\">more info</a>                                
            </h5>
        <input type='number' class='iquantity' name='product_quantity' min='1' max='$prodquantity'>
                           

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>

                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"wishlist\">Add to Wishlist <i class=\"fas fa-shopping-cart\"></i></button>
                            
                            
                             <input type='hidden' name='product_id' class='iprice' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
            
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid){
    $element = "
    
    <form action=\"cart.php?action=remove&id=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=\"../AddProducts/Thumbnail/$productimg\" alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                            <input type=\"hidden\" name=\"productname[]\"value=\"$productname\">
                                <h5 class=\"pt-2\">$productname</h5>                                
                                <h6 class=\"pt-2\">$$productprice</h6>

                                
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

function total($totalprice){
    $element="
    <div class=\"col-md-6\">
                        <h6> <?php
                        echo $totalprice;
                        ?></h6>

                        <h6 class=\"text-success\">
                            FREE
                        </h6>
                        <h6>
                            <hr>                            
                            $<?php
                                echo $totalprice
                                ;
                            ?>
                        </h6>
                        <div id=\"paypal-payment-button\">
                        </div>
                       

                    </div>
    ";
    echo $element;
}
?>