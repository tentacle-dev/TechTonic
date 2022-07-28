<?php

include('../../database/dbconn.php');



$stmt = $conn->prepare("SELECT SUM(sub_total) FROM `orders` WHERE MONTHNAME(created_at) BETWEEN MONTHNAME(CURDATE()-1 ) AND MONTHNAME(CURDATE()+1);");
$stmt->execute();

while($row = $stmt->fetch()){
    print_r($row);
    echo $row['0'];
}
?>