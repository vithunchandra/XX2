<?php
  require('connect.php');
  if(isset($_GET['get_current_movie'])) {
    $sql = "SELECT * FROM `film` WHERE datediff(start_date,NOW()) < 0 and datediff(end_date,NOW()) > 0 and status = 1";
    $result = $conn->query($sql);
    $film = [];
    $counter = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $film[$counter] = $row;
      $counter+=1;
    }
    echo json_encode($film);
  }

  if(isset($_GET['get_upcoming_movie'])) {
    $sql = "SELECT * FROM `film` WHERE datediff(start_date,NOW()) > 0 and datediff(end_date,NOW()) > 0 and status = 1";
    $result = $conn->query($sql);
    $film = [];
    $counter = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $film[$counter] = $row;
      $counter+=1;
    }
    echo json_encode($film);
  }
?>