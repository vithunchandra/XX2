<?php
  if(isset($_GET['err'])) {
    echo "<script>alert(".$_GET['err'].")</script>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="bootstrap-5.2.1-dist/css/bootstrap.css">
  <link rel="stylesheet" href="mycss.css">  
  <title>Document</title>
</head>
<body class="">
<div class="login">
  <form action="Controller/controller_member.php" method = "POST">
    <h1 class="reg" >Form Register</h1>
    nama : <input class="form-control mini" name = "nama" type="text"> <br>
    email : <input class="form-control mini" name = "email" type="text"> <br>
    user : <input class="form-control mini" name = "user" type="text"> <br>
    pass : <input class="form-control mini" name = "pass" type="text">  <br>
    <a href="login.php" class="nounder"> already have account ? Login</a>
    <button name = 'register' type="submit" class="btn">Register</button>
    
  </form>
  </div>
 
</body>
</html>