<?php
include('../database/newsletterDbconfig.php');
if(isset($_GET['email'])){
    $email = $_GET['email'];

    $res = unsubscribe($email);

    echo $res;
}
?>
