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

  function fetch($sql) {
    global $conn;
    $result = $conn->query($sql);
    $rows = [];
    $counter = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $rows[$counter] = $row;
      $counter = $counter + 1;
    }
    return $rows;
  }
?>