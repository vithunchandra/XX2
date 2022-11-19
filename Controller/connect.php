<?php
  session_start();
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "bioskop_xx2";
  
  $conn = new mysqli($servername, $username, $password,$dbname);

  function alert($str) {
    echo "<script>alert('".$str."')</script>";
  }
?>