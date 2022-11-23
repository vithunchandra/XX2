<?php
  require('connect.php');
  if(isset($_GET['get_current_movie'])) {
    $filter = " ";
    if(isset($_GET['title_like'])) {
      $filter = $filter . " and nama_film like '%".$_GET['title_like']."%' ";
    }

    $sql = "SELECT * FROM `film` WHERE datediff(start_date,NOW()) < 0 and datediff(end_date,NOW()) > 0 and status = 1" . $filter;
    
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
    $filter = " ";
    if(isset($_GET['title_like'])) {
      $filter = $filter . " and nama_film like '%".$_GET['title_like']."%' ";
    }

    $sql = "SELECT * FROM `film` WHERE datediff(start_date,NOW()) > 0 and datediff(end_date,NOW()) > 0 and status = 1" . $filter;
    $result = $conn->query($sql);
    $film = [];
    $counter = 0;
    while($row = mysqli_fetch_assoc($result)) {
      $film[$counter] = $row;
      $counter+=1;
    }
    echo json_encode($film);
  }

  if(isset($_GET['']))
?>