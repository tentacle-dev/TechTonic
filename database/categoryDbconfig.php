<?php
function delMainCategory($id){
    try{

        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE main_category SET main_category_status='Deactive' WHERE main_category_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
    
}
function actMainCategory($id){
    try{

        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE main_category SET main_category_status='Active' WHERE main_category_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
    
}
function updMainCategory($id,$name){
    try{

        include('dbconn.php');    
        $stmt = $conn->prepare("UPDATE main_category SET main_category_name=:name WHERE main_category_id=:id");
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':name',$name);
        $result = $stmt->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function setMainCategory($name){

    try{
    include('dbconn.php');
    $stmt = $conn->prepare("INSERT INTO main_category(main_category_name,main_category_status) VALUES (:name,'Active')");
    $stmt->bindParam(":name",$name);
    $result = $stmt->execute();

    return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function delSubCategory($id){
    try{

        try{
            include('dbconn.php');    
            $stmt2 = $conn->prepare("UPDATE sub_category SET sub_category_status='Deactive' WHERE sub_category_id=:id");
            $stmt2->bindParam(':id',$id);
            $result = $stmt2->execute();
            return $result;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
       }
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
    
}
function actSubCategory($id){
    try{

        include('dbconn.php');    
        $stmt2 = $conn->prepare("UPDATE sub_category SET sub_category_status='Active' WHERE sub_category_id=:id");
        $stmt2->bindParam(':id',$id);
        $result = $stmt2->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
    
}
function updSubCategory($id,$name,$main){
    try{

        include('dbconn.php');    
        $stmt = $conn->prepare("UPDATE Sub_category SET main_category_id= :main, sub_category_name=:name WHERE sub_category_id=:id");
        $stmt->bindParam(':id',$id);
        $stmt->bindParam(':main',$main);
        $stmt->bindParam(':name',$name);
        $result = $stmt->execute();
        return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
function setSubCategory($name,$mainid){

    try{
    include('dbconn.php');
    $stmt = $conn->prepare("INSERT INTO Sub_category(sub_category_name,main_category_id,sub_category_status) VALUES (:name,:main,'Active')");
    $stmt->bindParam(":name",$name);
    $stmt->bindParam(":main",$mainid);

    $result = $stmt->execute();

    return $result;
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
   }
}
?>