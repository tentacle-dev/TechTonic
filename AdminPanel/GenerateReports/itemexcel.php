<?php
    if(isset($_POST['excel'])){
        include('../../database/dbconn.php');
        $stmt = $conn->prepare("SELECT I.product_id ItemId
        , I.product_name ItemName
        , I.product_price CurrentPrice
        , SUM(OL.value) TotalValue  
        FROM orderitems OL
        INNER JOIN (SELECT * FROM Orders WHERE isPaid ='Paid') O ON OL.orders_id = O.order_id
        INNER JOIN product I ON OL.product_id = I.product_id
        GROUP BY I.product_id,I.product_price
        ORDER BY I.product_id DESC");
        $stmt->execute();
        $html='<table><tr><td>ID</td><td>Name</td><td>Price</td>><td>Total</td></tr>';
        while($row = $stmt->fetch()){
            $html.='<tr><td>'.$row['ItemId'].'</td><td>'.$row['ItemName'].'</td><td>'.$row['CurrentPrice'].'</td><td>'.$row['TotalValue'].'</td></tr>';
        }
        
        $html.='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment;filename=itemReport.xls');
        echo $html;
    }
?>