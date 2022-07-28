<?php

$cartcount = 0;
if(isset($_SESSION['cart'])){
    $cartcount = count($_SESSION['cart']);
} else {
    $cartcount = 0;
}
$wishcount = 0;
if(isset($_SESSION['wishlist'])){
    $wishcount = count($_SESSION['wishlist']);
} else {
    $wishcount = 0;
}


?>