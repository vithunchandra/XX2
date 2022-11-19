<?php
  session_start();

  if(isset($_SESSION['login'])) {
    if($_SESSION['login'] == 'admin') {
      header("Location:login.php");
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
    <button name = "logout" type="submit">Logout</button>
  </form>
</body>
</html>