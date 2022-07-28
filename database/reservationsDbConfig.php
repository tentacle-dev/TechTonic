<?php


function setData($name,$id,$number,$date,$email,$purpose){

    try{
        include('dbconn.php');
        $stmt = $conn->prepare("INSERT INTO reservation(name,user_id,Telephone_Number,Email_Address,date,purpose,status) VALUES (:name,:id,:number,:email,:date,:purpose,'Pending')");
        $stmt->bindParam(":name",$name);
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":number",$number);
        $stmt->bindParam(":email",$email);
        $stmt->bindParam(":date",$date);
        $stmt->bindParam(":purpose",$purpose);
        $result = $stmt->execute();
        if($result){
            return true;
        } else {
            return false;
        }
        
        } catch(PDOException $e){
            $e->getMessage();
            return false;
        }

}

function getDataById($id){
    try{
        include('dbconn.php');    
        $stmt = $conn->prepare("SELECT * FROM reservation WHERE id = $id");      
        $result = $stmt->execute();
        $result = $stmt->fetch();
        return $result;
    }catch(PDOException $e){
        $e.getMessage();
    }
}

function approveReservation($id,$feed){

        try{
            include('dbconn.php');    
            $stmt2 = $conn->prepare("UPDATE reservation SET status='Approve' ,feedback = :feed WHERE id=:id");
            $stmt2->bindParam(':id',$id);
            $stmt2->bindParam(':feed',$feed);
            $stmt2->execute();
            return true;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
       }
}
function rejectReservation($id,$feed){
   
    try{
        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE reservation SET status='Reject' ,feedback = :feed WHERE id=:id");
        $stmt2->bindParam(':id',$id);
        $stmt2->bindParam(':feed',$feed);
        $stmt2->execute();
        return true;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}


?>

