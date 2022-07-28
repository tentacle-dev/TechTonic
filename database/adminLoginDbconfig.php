<?php


    function setadminData($name,$email,$password){
        try {
    
            include('dbconn.php');
            // define sql statement to be executed
            $stmt = $conn->prepare("INSERT INTO admin (name,email,password) VALUES (:name,:email,:password)");
            //prepare the sql statement for execution

            // bind all placeholders to the actual values
            $stmt->bindparam(':name',$name);
            $stmt->bindparam(':email',$email);
            $stmt->bindparam(':password',$password);
            // execute statement
            $stmt->execute();
            //$prod_id = $conn->lastInsertId();
            header("Location:login.php");
            return true;
    
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    
    }

    function adminLogin($email,$password){
 
        
        try{
         include('dbconn.php');
 
         $stmt= $conn->prepare("SELECT id,name,email,password FROM admin WHERE ( name=:uname OR email = :email)");
 
         $stmt->bindParam(':email',$email);
         $stmt->bindParam(':uname',$email);

 
         $stmt->execute();
 
         while($row = $stmt->fetch()){
             try{
                 
                 
                 $pw = $row['password'];
                 if(password_verify($password,$pw)){
                     $adminname = $row['name'];
                     $adminemail = $row['email'];
                     $adminid = $row['id'];
                     echo "Match";
                 } else {
                     echo "Didnt match";
                 }
                 
     
             return array('id' =>"$adminid",'name' => "$adminname");
                 
             }catch (PDOException $e) {
     
                 echo $e->getMessage();
                 return false;
             
                }
             }
          
        } catch (PDOException $e) {
         echo $e->getMessage();
         return false;
 
        }
    }
?>