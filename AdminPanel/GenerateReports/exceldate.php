<?php
    if(isset($_POST['date'])){
        include('../../database/dbconn.php');
        $order_from = $_POST['from'];
        $order_to = $_POST['to'];
        $stmt = $conn->prepare("SELECT * FROM orders WHERE created_at BETWEEN '$order_from' AND '$order_to' ORDER BY order_id DESC");
        $stmt->execute();
        $html='<table><tr><td>Order_id</td><td>First Name</td><td>Last Name</td><td>Email</td><td>Number</td><td>Address</td><td>Total</td><td>Coupon</td><td>Sub_total</td></tr>';
        while($row = $stmt->fetch()){
            $html.='<tr><td>'.$row['order_id'].'</td><td>'.$row['first_Name'].'</td><td>'.$row['last_Name'].'</td><td>'.$row['email'].'</td><td>'.$row['mobile_number'].'</td><td>'.$row['shipping_address'].'</td><td>'.$row['total'].'</td><td>'.$row['coupon_Discount'].'</td><td>'.$row['sub_total'].'</td></tr>';
        }
        
        $html.='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment;filename=date.xls');
        echo $html;
    }
?>