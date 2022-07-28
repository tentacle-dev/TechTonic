<?php

if(isset($_POST['filter'])){
    echo $_POST['slider'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="slidecontainer">
  <form action="" method="post">
  <input type="range" min="1" max="100" value="50" class="slider" name="slider" id="myRange">
  <button type="submit" name="filter">add</button>
  </form>
</div>
</body>
</html>