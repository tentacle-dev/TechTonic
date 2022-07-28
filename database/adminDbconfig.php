<?php

function newOrders(){
    try{
        include('dbconn.php');
        $stmt2 = $conn->prepare("SELECT *
        FROM orders WHERE isPaid='PAID' AND isDelivered='Pending'");
        $stmt2->execute();
        $count = $stmt2->RowCount();            
        
        return $count;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
} 

function customers(){
    try{
        include('dbconn.php');
        $stmt2 = $conn->prepare("SELECT * FROM user WHERE user_status= 'VERIFIED' AND user_role = 'User'");
        $stmt2->execute();
        $count = $stmt2->RowCount();            
        
        return $count;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
} 

function enquiry(){
    try{
        include('dbconn.php');
        $stmt2 = $conn->prepare("SELECT * FROM product_enquiry WHERE isClosed = ''");
        $stmt2->execute();
        $count = $stmt2->RowCount();            
        
        return $count;
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
} 

function monthly(){
    try{
        include('dbconn.php');
        $stmt = $conn->prepare("SELECT SUM(sub_total) FROM orders WHERE created_at BETWEEN (CURDATE() - INTERVAL 1 MONTH) AND (CURDATE() + INTERVAL 1 MONTH)");
        $stmt->execute();
        $total = 0;
        while($res = $stmt->fetch()){
            $total = $res['0'];
        }
        return $total;
        
        
        }catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
}


function sum(){

    try{
    include('dbconn.php');
    $stmt = $conn->prepare("SELECT SUM(sub_total) FROM orders WHERE isPaid='Paid'");
    $stmt->execute();
    $total = 0;
    while($res = $stmt->fetch()){
        $total = $res['0'];
    }
    return $total;
    
    
    }catch (PDOException $e){
        echo $e->getMessage();
        return false;
    }
    }




?>