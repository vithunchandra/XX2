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
<h1 class="loglogo">XX2 Chinema</h1>
<div class="login">
  <form action="Controller/controller_member.php" method = "POST">
    <h1 class="logtit">Login</h1>
    <div class="kurangkiri">
      <div class="form-floating mb-1 mt-3 me-2 ">
          <input type="text" class="form-control bg-light" id="floatingInput" name="user" placeholder=" ">
          <label for="floatingInput" class="fw-bold">Username</label>
      </div>
      <div class="form-floating mb-1 me-2">
          <input type="password" class="form-control bg-light" id="floatingPassword" name="pass" placeholder=" ">
          <label for="floatingPassword" class="fw-bold">Password</label>
      </div>
      </div>
      <div class="kurangkiri2">
      <button class="logon" name = 'login' type="submit"> <svg width="180px" height="60px" viewBox="0 0 180 60" class="border">
            <polyline points="179,1 179,59 1,59 1,1 179,1" class="bg-line" />
            <polyline points="179,1 179,59 1,59 1,1 179,1" class="hl-line" />
          </svg>
          <span>login</span></button>
          <br><br>
      </div>
    </form>
  don't have account ? <a class="nounder" href="register.php">Register</a>
</div>
 
</body>
</html>