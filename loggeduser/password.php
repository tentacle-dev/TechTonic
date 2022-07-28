<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    include('../database/dbconn.php');
    $stmt = $conn->prepare("SELECT * FROM user WHERE user_id = :id");
    $stmt->bindParam(":id",$id);
    $stmt->execute();
} else {
    echo "<h1>No user found</h1>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link rel="stylesheet" href="../bootstrap/bootstrap-5.0.1/dist/css/bootstrap.css">


</head>
<body>
    <div class="container">
        <form action="passwordupdate.php" method="post">
            <?php while($row = $stmt->fetch()){

                $id = $row['user_id'];

                ?>
                 <h3 class="mb-5">Enter new password</h3>
        <div class="mb-4">
          <label for="name" class="form-label">New password</label>
          <input
            type="password"
            class="form-control"
            id="password"
            name="pass"
            required
          />
        </div>
        <div class="mb-4">
          <label for="name" class="form-label">New password (Re-enter)</label>
          <input
            type="password"
            class="form-control"
            id="cpassword"
            name="cpass"
            required
          />
        </div>
        <input type="hidden" name="id" value="<?php echo $id?>">
                
                    <button type="submit" class="btn btn-primary" name="password">Update</button>
                </div>
            

          <?php  } ?>

        </form>
    </div>
</body>
<script src="../bootstrap/bootstrap-5.0.1/dist/js/bootstrap.js"></script>

</html>