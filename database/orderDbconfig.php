<?php
function isReview($id,$prod_id){
    try{
        include('database/dbconn.php');
    $stmt6 = $conn->prepare("SELECT * FROM orderitems WHERE user_id = $id AND product_id = $prod_id");
    $stmt6->execute();
    $count = $stmt6->RowCount();
    if($count>0){ 
        return true;
    }else {
        return false;
    }
    } catch(PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function prepareOrder($id){
    try{
        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE orders SET isDelivered='Processing'  WHERE order_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function deliverOrder($id){
    try{
        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE orders SET isDelivered='Delivered'  WHERE order_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function delOrder($id){
    try{
        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE orders SET isPaid='Cancelled',isDelivered='Cancelled' WHERE order_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}

function getOrderByid($id){
    try{
        include('dbconn.php');    
        $stmt = $conn->prepare("SELECT * FROM orders WHERE order_id = $id");      
        $result = $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }catch(PDOException $e){
        $e->getMessage();
    }
}

function updateQuantityOrder($id){
    try{
        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE orders SET isDelivered='1'  WHERE order_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}


?>