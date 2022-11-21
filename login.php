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
  <title>Document</title>
</head>
<body>

  <form action="Controller/controller_member.php" method = "POST">
    <h1>Form Login</h1>
    user : <input name = "user" type="text"> <br>
    pass : <input name = "pass" type="text">  <br>
    <button name = 'login' type="submit">login</button>
  </form>
  <a href="register.php">Register</a>
</body>
</html>