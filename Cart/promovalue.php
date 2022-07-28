<?php
if(isset($_POST['checkout'])){ 



    
       // $user_id = $_SESSION['user_id'];
        $username = "Peiris";
        $total = $_POST['final'];
        $amount = $total * 100;
        $prod = $_POST['name'];
        $address = $_POST['address'];
        $mobilenumber =$_POST['mobile'] ;
        $coupon = $_POST['testvalue'];
        if($coupon == 0){
           $coupon = '0';
        }

        echo $coupon;
        echo $total;


}

?>