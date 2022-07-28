<?php

function setUserData($username,$email,$updates,$mobilenumber,$address,$password,$token){
    try {

        include('dbconn.php');        
        
        //prepare the sql statement for execution
        $stmt = $conn->prepare("INSERT INTO `user`(`username`, `user_emailaddress`, `user_emailupdates`, `user_role`, `user_mobilenumber`, `user_address`, `user_password`, `verification_token`, `user_status`) VALUES (:uname,:email,:updates,:role,:mobile,:address,:password,:verification,:status)");
        // bind all placeholders to the actual values
        $stmt->bindparam(':uname',$username);
        $stmt->bindparam(':email',$email);
        $stmt->bindparam(':updates',$updates);
        $role = 'User';
        $status = 'Unverified';
        $stmt->bindparam(':status',$status);

        $stmt->bindparam(':role',$role);
        $stmt->bindparam(':mobile',$mobilenumber);
        $stmt->bindparam(':address',$address);
        $stmt->bindparam(':password',$password);
        $stmt->bindparam(':verification',$token);       


        // execute statement
        $stmt->execute();
        $user_id = $conn->lastInsertId();
        if($updates == 'Yes'){
            try{
                include_once('dbconn.php');
                $stmt3 = $conn->prepare("INSERT INTO newsletter(user_id,email,status) VALUES (:id,:email,'Subscribed')");
                $stmt3->bindParam(":email",$email);
                $stmt3->bindParam(":id",$user_id);
                $stmt3->execute();
                echo "Added";
                return true;
        
                } catch(PDOException $e){
                    $e->getMessage();
                    return false;
                }
            
            return $user_id;
    
        } 
        }catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        

}

function forgetPass($email,$token){
    try{
       
        include('dbconn.php');

        $stmt = $conn->prepare("SELECT * FROM user WHERE user_emailaddress = :email");
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0){
            $stmt2 = $conn->prepare("UPDATE user SET verification_token = :code WHERE user_emailaddress=:email");
            $stmt2->bindParam(":code",$token);
            $stmt2->bindParam(":email",$email);
            $stmt2->execute();
            return true;
        } else {
            return false;
        }
        /*
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){    
            if(!$row){
             echo 'No user under this email recorded.Please register';
           } else {
            $vkey = $row['verification_token'];                
            return $vkey;
          }
        }*/

          

      } catch (PDOException $e) {
       echo $e->getMessage();
       return $e;

      }

}


function verify($token){
    

    try{
        include('dbconn.php');    

        $stmt = $conn->prepare("SELECT verification_token,user_status FROM user WHERE verification_token = :token LIMIT 1");
        $stmt->bindParam(':token',$token);
        $res = $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0 ){
            $stmt2 = $conn->prepare("UPDATE user SET user_status = 'Verified' WHERE verification_token = :token");
            $stmt2->bindParam(':token',$token);
            $stmt2->execute(); 
            return true;   
        }else {
            return false;
        }
        }catch (PDOException $e) {
            echo $e->getMessage();
        }
}

function updatePassword($id,$password){
    try{
        include('dbconn.php');
        echo "Detected";
        $stmt = $conn->prepare("UPDATE user SET user_password =:pw WHERE user_id = :id");
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":pw",$password);
        $stmt->execute();
        echo"updated";

    }catch(PDOException $e){
        $e->getMessage();
    }
}
function isExist($email){
    try{
        include('dbconn.php');

        $stmt= $conn->prepare("SELECT * FROM user WHERE user_emailaddress = :email");
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        if($count > 0){
            return true;
        } else {
            return false;
        }
    }catch(PDOException $e){
        $e->getMessage();
        return false;
    }
}
function checkPwd($password,$id){

    try{
        include('dbconn.php');

        $stmt= $conn->prepare("SELECT * FROM user WHERE user_id = :id");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        if($count > 0){
            /*echo "found";
        }else {
            echo "not found";
        }*/
            while($row = $stmt->fetch()){
                $pw = $row['user_password'];
                if(password_verify($password,$pw)){
                    return true;
                } else {
                   return false;
                }
            }
        } else {
            return false;
        }
    }catch(PDOException $e){
        $e->getMessage();
        return false;
    }
}

function updPassword($pw,$id){
    try{
        include('dbconn.php');
        $stmt = $conn->prepare("UPDATE `user` SET `user_password`=:pwd WHERE user_id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":pwd",$pw);
        $stmt->execute();
    }catch(PDOException $e){
        $e->getMessage();
    }
}
function updateProfile($id,$uname,$number,$address){
    try{
        include('dbconn.php');
        $stmt = $conn->prepare("UPDATE `user` SET `username`=:username,`user_mobilenumber`=:number,`user_address`=:address WHERE user_id=:id");
        $stmt->bindParam(":id",$id);
        $stmt->bindParam(":username",$uname);
        $stmt->bindParam(":number",$number);
        $stmt->bindParam(":address",$address);
        $res =  $stmt->execute();
        return $res;

    }catch(PDOException $e){
        $e->getMessage();
    }
}

/*function verifyUser($token){

   try{
    include('dbconn.php');
    $stmt = $conn->prepare("SELECT verification_token,user_status FROM user WHERE user_status =''verification_token = :token LIMIT 1");
    $stmt->bindParam(':token',$token);
    $res = $stmt->execute();
    if($res['verification_token'] === 'Verified'){
        $msg = "You have been verified already";
    } else {
        while($row = $stmt->fetch()){
        try{
              $vkey = $row['verification_token'];
              $status = $row['user_status'];
        
               $sql = $conn->prepare("UPDATE user SET user_status = 'Test' WHERE verification_token = '$vkey'");
                $sql->execute(); 
                $msg =  "You have been verified successfully";
                return $msg;
                
            }catch (PDOException $e) {
    
                echo $e->getMessage();
                $msg = "Your code is invalid";
                return $msg;
            
         }
    
        }

    }
    
   


    
   } catch (PDOException $e) {

    echo $e->getMessage();
    $msg = "Your code is invalid";

    return $msg;

   }
}*/

function userLogin($username,$password){
    try{
        include('dbconn.php');

        $stmt= $conn->prepare("SELECT user_id,username,user_password FROM user WHERE user_emailaddress = :email AND user_status = 'Verified'");
        $stmt->bindParam(':email',$username);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        if($count > 0){
            /*echo "found";
        }else {
            echo "not found";
        }*/
            while($row = $stmt->fetch()){
                $pw = $row['user_password'];
                if(password_verify($password,$pw)){
                    $_SESSION['user_id'] = $row['user_id'];
                    return true;
                    
                } else {
                   return false;
                }
            }
        } else {
            return false;
        }
    }catch(PDOException $e){
        $e->getMessage();
        return false;
    }
}
function isUSER($email){
    try{
        include('dbconn.php');

        $stmt= $conn->prepare("SELECT * FROM user WHERE  user_emailaddress = :email AND user_status = 'Verified'");
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        while($row =$stmt->fetch()){
            $role = $row['user_role'];
        }
        if($role == "User"){
            return true;
        } else {
        return false;
        }
        }catch(PDOException $e){
            $e->getMessage();
            return false;
        }
        

}
/*
function usersLogin($username,$password){
       try{
        include('dbconn.php');

        $stmt= $conn->prepare("SELECT user_id,username,user_password FROM user WHERE ( username=:uname OR user_emailaddress = :email) AND user_status = 'Verified'");

        $stmt->bindParam(':uname',$username);
        $stmt->bindParam(':email',$username);

        $stmt->execute();
        $count = $stmt->rowCount();
        if($count > 0 ){
           while($row = $stmt->fetch()){
                try{
                    $user_id = "";
                    $username="";
                    
                    $pw = $row['user_password'];
                    if(password_verify($password,$pw)){
                        $user_id = $row['user_id'];
                        $user_name = $row['username'];
                        echo"Matching";

                    } else {
                        echo "Didnt match";
                    }
                    
        
                return array('user_id' =>"$user_id",'username' => "$user_name");
                    
                }catch (PDOException $e) {
                    echo $e->getMessage();
                    return false;
                }
                } else {
                    return array('user_id' =>"$user_id",'username' => "$user_name");
                }
         
       } catch (PDOException $e) {
        echo $e->getMessage();
        return false;

       }
   }*/

function forgetPassword($email){
    try{
         include('dbconn.php');

         $stmt = $conn->prepare("SELECT * FROM user WHERE user_emailaddress = :email");
         $stmt->bindParam(':email',$email);
         $stmt->execute();
         while($row = $stmt->fetch(PDO::FETCH_ASSOC)){    
             if(!$row){
              echo 'No user under this email recorded.Please register';
            } else {
             $vkey = $row['verification_token'];                
             return $vkey;
           }
         }

           

       } catch (PDOException $e) {
        echo $e->getMessage();
        return $e;

       }
   }

function resetPassword($password,$email){
    try{
        include('dbconn.php');
         $sql = $conn->prepare("UPDATE user SET user_password = :pass WHERE user_emailaddress =:email");
         $sql->bindParam(':pass',$password);
         $sql->bindParam(':email',$email);    

        $result =$sql->execute();
        if($result){
            return true;
        } else {
            return false;
        }
    }catch (PDOException $e) {
        echo $e->getMessage();
    }
    
   

   }

?>