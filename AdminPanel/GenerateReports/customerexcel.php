<?php
    if(isset($_POST['excel'])){
        include('../../database/dbconn.php');
        $stmt = $conn->prepare("SELECT I.user_id UserId
        , I.username Name
        ,I.user_emailaddress email
        , SUM(OL.value) TotalValue  
        FROM orderitems OL
        INNER JOIN (SELECT * FROM Orders WHERE isPaid='Paid') O ON OL.orders_id = O.order_id
        INNER JOIN user I ON OL.user_id = I.user_id
        GROUP BY I.user_id");
        $stmt->execute();
        $html='<table><tr><td>ID</td><td>Username</td><td>Email</td><td>Value</td></tr>';
        while($row = $stmt->fetch()){
            $html.='<tr><td>'.$row['UserId'].'</td><td>'.$row['Name'].'</td><td>'.$row['email'].'</td><td>'.$row['TotalValue'].'</td></tr>';
        }
        
        $html.='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment;filename=customerwise.xls');
        echo $html;
    }
?>