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
  <title>Document</title>
</head>
<body>
  <form action="Controller/controller_member.php" method = "POST">
    <h1>Form Register</h1>
    nama : <input name = "nama" type="text"> <br>
    email : <input name = "email" type="text"> <br>
    user : <input name = "user" type="text"> <br>
    pass : <input name = "pass" type="text">  <br>
    <button name = 'register' type="submit">Regis!</button>
  </form>
  <a href="login.php">Login</a>
</body>
</html>