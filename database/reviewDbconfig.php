<?php

    /*function setReview($user_id,$product_id,$desc,$rating){
        try {
            include('dbconn.php');        
        
        //prepare the sql statement for execution
        $stmt = $conn->prepare("INSERT INTO review (user_id,product_id,description,rating) VALUES (:user,:product,:description,:rating)");
        // bind all placeholders to the actual values
        $stmt->bindparam(':user',$user_id);
        $stmt->bindparam(':product',$product_id);
        $stmt->bindparam(':description',$desc);
        $stmt->bindparam(':rating',$rating);
        $stmt->execute();
        echo "Reviewed";

        // execute statement
        $stmt->execute();
        }catch(PDOException $e){
            $e->getMessage();
        }*/
        function delReview($reviewid){
            try{
                include('dbconn.php');        
                $stmt = $conn->prepare("UPDATE review SET status='Hide' WHERE id=:id");
                // bind all placeholders to the actual values
                $stmt->bindparam(':id',$reviewid);
                $result = $stmt->execute();
                return $result;
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
        function setReview($user_id,$product_id,$desc,$rating){
            try{
                include('dbconn.php');        
                $stmt = $conn->prepare("INSERT INTO review (user_id,product_id,description,rating) VALUES (:user,:product,:description,:rating)");
                // bind all placeholders to the actual values
                $stmt->bindparam(':user',$user_id);
                $stmt->bindparam(':product',$product_id);
                $stmt->bindparam(':description',$desc);
                $stmt->bindparam(':rating',$rating);
                $result = $stmt->execute();
                return $result;
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
        function hideReview($id){
            try{
                include('dbconn.php');        
                $stmt = $conn->prepare("UPDATE review SET status='Hide' WHERE id=:id");
                // bind all placeholders to the actual values
                $stmt->bindparam(':id',$id);
                $result = $stmt->execute();
                return $result;
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
    

?>