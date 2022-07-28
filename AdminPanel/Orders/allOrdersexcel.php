<?php
    if(isset($_POST['excel'])){
        include('../../database/dbconn.php');
        $stmt = $conn->prepare("SELECT *
        FROM orders WHERE isPaid='Paid' AND isDelivered='Delivered'");
        $stmt->execute();
        $html='<table><tr><td>Email</td><td>Address</td><td>Number</td><td>Name</td><td>Total</td></tr>';
        while($row = $stmt->fetch()){
            $html.='<tr><td>'.$row['email'].'</td><td>'.$row['shipping_address'].'</td><td>'.$row['mobile_number'].'</td><td>'.$row['first_Name'].'</td><td>'.$row['sub_total'].'</td></tr>';
        }
        
        $html.='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment;filename=Delivered.xls');
        echo $html;
    }
?>