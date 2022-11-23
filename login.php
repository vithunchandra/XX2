<?php
  session_start();
  if(isset($_GET['err'])) {
    echo "<script>alert(".$_GET['err'].")</script>";
  }

  if(isset($_SESSION['login'])) {
    if($_SESSION['login'] == 'admin') {
      header("Location:admin.php");
    }
    else {
      header("Location:index.php");
    }
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
<body class="backlog">
<div class="login">
  <form action="Controller/controller_member.php" method = "POST">
    <h1 class="logtit">Login</h1>
    <br><br>
    user : <input class="grai rounded" name = "user" type="text"> <br>
    pass : <input class="grai2 rounded" name = "pass" type="text">  <br>
    <button class="logon" name = 'login' type="submit"> <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
          <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
        </svg>
        <span>login</span></button>
        <br><br>
  </form>
  don't have account ? <a class="nounder" href="register.php">Register</a>
</div>
 
</body>
</html>