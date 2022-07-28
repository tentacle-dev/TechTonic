if(isset($_SESSION['cart'])){
    $count=  count($_SESSION['cart']);
} else {
    $count = 0;
}