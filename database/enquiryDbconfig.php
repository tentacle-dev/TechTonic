<?php

function updEnquiry($id,$response){
    try{

        include('dbconn.php');    
        $stmt = $conn->prepare("UPDATE product_enquiry SET response=:response,isClosed='Yes' WHERE id=:id");
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':response',$response);
        $result = $stmt->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function addEnquiry($id,$prod,$enquiry){
    try{
        include('dbconn.php');    
        $stmt = $conn->prepare("INSERT INTO `product_enquiry`( `user_id`, `product_id`, `enquiry`) VALUES (:id,:prod,:enquiry)");
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':prod',$prod);
        $stmt->bindParam(':enquiry',$enquiry);

        $result = $stmt->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
?>