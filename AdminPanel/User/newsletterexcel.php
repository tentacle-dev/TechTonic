<?php
    if(isset($_POST['excel'])){
        include('../../database/dbconn.php');
        $stmt = $conn->prepare("SELECT *
        FROM newsletter WHERE status='Subscribed'");
        $stmt->execute();
        $html='<table><tr><td>Email</td></tr>';
        while($row = $stmt->fetch()){
            $html.='<tr><td>'.$row['email'].'</td></tr>';
        }
        
        $html.='</table>';
        header('Content-Type:application/xls');
        header('Content-Disposition:attachment;filename=newsletter.xls');
        echo $html;
    }
?>