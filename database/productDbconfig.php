<?php

function Active($id){
    include('dbconn.php');
    $stmt2 = $conn->prepare("UPDATE product SET product_status='Active' WHERE product_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;


}

function updThumbnail($id,$img){
    include('dbconn.php');
        $stmt2 = $conn->prepare("UPDATE product SET product_thumbnail=:img WHERE product_id=:id");
        $stmt2->bindParam(':id',$id);
        $stmt2->bindParam(':img',$img);
        $result = $stmt2->execute();
        return $result;
}

function updProduct($id,$name,$sku,$quantity,$price,$tags,$category){
    include('dbconn.php');
    $stmt2 = $conn->prepare("UPDATE product SET product_name=:name,product_sku=:sku,product_price=:price,product_quantity=:quantity,product_tags=:tags,product_subcategory=:cat WHERE product_id=:id");
        $stmt2->bindParam(':id',$id);
        $stmt2->bindParam(':name',$name);
        $stmt2->bindParam(':sku',$sku);
        $stmt2->bindParam(':tags',$tags);
        $stmt2->bindParam('quantity',$quantity);
        $stmt2->bindParam(':price',$price);
        $stmt2->bindParam(':cat',$category);

        $result = $stmt2->execute();
        return $result;
}

function disable($id){
    include('dbconn.php');
    $stmt2 = $conn->prepare("UPDATE product SET product_status='Disabled' WHERE product_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;


}
  function getProducts(){


    include_once('dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM product WHERE product_status = 'Available'");      
    $result = $stmt->execute();

    while($row = $stmt->fetch()){
   
        include_once('../components/components.php');
        $total = 0;
        displayProductsCust($row['product_name'],$row['product_price'],$row['product_thumbnail'],$row['prod_id'],$row['product_quantity']);
    }
  
}

function addProductsToCheckout($user_id,$order_value){

    try{
    $stmt->$conn->prepare("INSERT INTO checkout () VALUES (:user_id,:order_value)");
    $stmt->bindParam(':user_id',$user_id);
    $stmt->bindParam(':order_value',$order_value);
    $stmt->execute();
    $checkout_id = $conn->lastInsertId();


    return $checkout_id;


    } catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }




}
 

 function cartProducts(){

    include('dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM product");      
    $result = $stmt->execute();

    $total=0; 

    while($row = $stmt->fetch()){
   
        include_once('../components/components.php');
        $product_id =array_column($_SESSION['cart'],'product_id');
        
        foreach($product_id as $id){
            
            if($row['prod_id'] == $id){
                               
                cartElement($row['product_thumbnail'],$row['product_name'],$row['product_price'],$row['prod_id']);
                $total = $total + (int)$row['product_price'];
               
                
                }
               
                
            }
           
        }
        echo $total;

        return $total;
        

 }


?>