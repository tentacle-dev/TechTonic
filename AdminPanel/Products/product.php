<?php
    if(isset($_POST['excel'])){
        include('../../database/dbconn.php');
        $stmt = $conn->prepare("SELECT * FROM product ORDER BY product_id DESC");
        $stmt->execute();
        $html='<table><tr><td>SKU</td><td>Name</td><td>Quantity</td><td>Price</td></tr>';
        while($row = $stmt->fetch()){
            $html.='<tr><td>'.$row['product_sku'].'</td><td>'.$row['product_name'].'</td><td>'.$row['product_quantity'].'</td><td>'.$row['product_price'].'</td></tr>';
        }
        
        $html.='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment;filename=stock.xls');
        echo $html;
    }
?>