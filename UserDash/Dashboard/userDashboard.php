<?php

session_start();
$id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">
    <link rel="stylesheet" href="../../fontawesome-free-5.15.4-web/css/all.css">
</head>
<body>
    <?php include('../../Sidebar/User.php'); ?>
    
   
    

<script src="../../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>


