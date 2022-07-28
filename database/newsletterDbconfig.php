<?php
function setnewsData($email){

    try{
        include('dbconn.php');
        $stmt = $conn->prepare("INSERT INTO newsletter(email,status) VALUES (:email,'Subscribed')");
        $stmt->bindParam(":email",$email);
        $res = $stmt->execute();
        return $res;

        } catch(PDOException $e){
            $e->getMessage();
            return false;
        }

}

function newsletterexist($email){
    try{
        include('dbconn.php');

        $stmt= $conn->prepare("SELECT * FROM newsletter WHERE email = :email");
        $stmt->bindParam(':email',$email);
        $stmt->execute();
        
        $count = $stmt->rowCount();
        if($count > 0){
            $stmt2= $conn->prepare("UPDATE newsletter SET status = 'Subscribe' WHERE email = :email");
            $stmt2->execute();
            return true;
        } else {
            return false;
        }
    }catch(PDOException $e){
        $e->getMessage();
        return false;
    }
}

function unsubscribe($email){
    try{
        include("dbconn.php");
        $stmt = $conn->prepare("UPDATE newsletter SET status='Unsubscribe'");
        $res = $stmt->execute();
        return $res;
    } catch(PDOException $e){
        echo $e->getMessage();
    }
}
function setExisting($id,$email){
    try{
        include_once('dbconn.php');
        $stmt3 = $conn->prepare("INSERT INTO newsletter(user_id,email,status) VALUES (:id,:email,'Subscribed')");
        $stmt3->bindParam(":email",$email);
        $stmt3->bindParam(":id",$id);
        $stmt3->execute();
        echo "Added";
            try{
                $stmt2 = $conn->prepare("UPDATE user SET user_emailupdates = 'Yes' WHERE user_id = :id");
                $stmt2->bindParam(':id',$id);
                $stmt2->execute();

            } catch(PDOExceotion $e){
                $e->getMessage();
            }
        return true;

        } catch(PDOException $e){
            $e->getMessage();
            return false;
        }
}
?>