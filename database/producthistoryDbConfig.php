<?php
function setUserProd($user,$product){

    try{
        include('dbconn.php');
            // define sql statement to be executed
            $stmt = $conn->prepare("INSERT INTO product_history(product_id,user_id) VALUES (:product,:user_id)");
            //prepare the sql statement for execution

            // bind all placeholders to the actual values
            $stmt->bindparam(':user_id',$user);
            $stmt->bindparam(':product',$product);
            $stmt->execute();
            
            return true;

        } catch(PDOException $e){
            $e->getMessage();
            return false;
        }

}

setUserProd(10,11);
?>