<?php

try{
    include('database/dbconn.php');
    //$stmt = $conn->prepare("SELECT SUM(sub_total) FROM orders WHERE created_at BETWEEN (CURDATE() + INTERVAL 1 MONTH) AND (CURDATE() - INTERVAL 1 MONTH) ");
    $stmt = $conn->prepare("SELECT SUM(sub_total) FROM orders WHERE created_at BETWEEN (CURDATE() - INTERVAL 1 MONTH) AND (CURDATE() + INTERVAL 1 MONTH)");
    $stmt->execute();
    $total = 0;
    $res = $stmt->fetch();
    print_r($res);
    ECHO $res[0];
        
    
    return $total;
    
    
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
?>