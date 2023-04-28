<?php

include('./database/dbconn.php');    

$host = 'localhost';
$db = 'testcrudnode';
$user = 'root';
$pass = '';


$dsn = "mysql:host=$host;dbname=$db;";

try{
    $conn = new PDO($dsn, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    throw new PDOException($e->getMessage());
    
}

function setnewsData(){

    try{
        $stmt = $conn->prepare("SELECT * FROM  users)");
        $res = $stmt->execute();
        
        while($prod2 =$stmt->fetch()){
            echo $prod2['username'] ;
        }

        } catch(PDOException $e){
            $e->getMessage();
            echo $e;
        }

}

?>