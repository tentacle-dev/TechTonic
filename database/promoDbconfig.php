<?php

function getPromoValue($code){
    try{
        include('dbconn.php');
        $stmt = $conn->prepare("SELECT * FROM coupon WHERE coupon_code = :code AND STATUS='ACTIVE'");      
        $stmt->bindParam(':code',$code);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){
            while($result = $stmt->fetch()){
                $value =$result ['coupon_value'];
            }
            return $value;
        } else {
            return false;
        }
        
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}

function checkPromo($code){
   try{

        include('dbconn.php');
        $stmt = $conn->prepare("SELECT * FROM coupon WHERE promo_code = :code");      
        $stmt->bindParam(':code',$code);
        $stmt->execute();
        while($row = $stmt->fetch()){
            $value = $row['coupon_value'];
        }
        

        if($count)
        {
            return ;
        }
        else
        {
            echo "Bummer";
        }

        

   }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function delPromo($id){
    try{

        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE coupon SET status='Deactive' WHERE coupon_id=:id");
        $stmt2->bindParam(':id',$id);
        $stmt2->execute();
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
    
}
function actPromo($id){
    try{

        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE coupon SET status='Active' WHERE coupon_id=:id");
        $stmt2->bindParam(':id',$id);
        $stmt2->execute();
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
    
}

function updPromo($id,$name,$code,$value){
    try{

        include('dbconn.php');    
        $stmt = $conn->prepare("UPDATE coupon SET coupon_name=:name,coupon_code=:code,coupon_value=:value WHERE coupon_id=:id");
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':code',$code);
        $stmt->bindParam(':value',$value);
       $result = $stmt->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}



function getPromo(){
    try{

        include_once('dbconn.php');
        $stmt = $conn->prepare("SELECT * FROM coupon");
        $stmt->execute();
        $results = $stmt->fetch();
        return $results;
        
    } catch(PDOException $e) {
        echo $e.getMessage();
        return false;


    }
}
function setPromo($name,$code,$value,$slogan){

    try{
        include_once('dbconn.php');
    $stmt = $conn->prepare("INSERT INTO coupon(coupon_name,coupon_code,coupon_value,coupon_slogan,status) VALUES (:name,:code,:value,:slogan,'Active')");
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":code",$code);
    $stmt->bindParam(":value",$value);
    $stmt->bindParam(":slogan",$slogan);
    $result = $stmt->execute();
    return $result;
    echo "<script>alert('Added promotion. It is active');</script>";
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}

?>