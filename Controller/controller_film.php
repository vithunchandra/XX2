<?php
  require('connect.php');
  if(isset($_GET['get_current_movie'])) {
    $filter = " ";
    if(isset($_GET['title_like'])) {
      $filter = $filter . " and nama_film like '%".$_GET['title_like']."%' ";
    }

    $sql = "SELECT DISTINCT f.* FROM `film` f,`schedule` s, `theater_schedule` ts,`session` as sess
    WHERE s.id_film = f.id_film and ts.id_schedule = s.id_schedule and s.id_session = sess.id_session 
    and datediff(f.end_date,NOW()) > 0 and f.status = 1 AND
    addtime(s.broadcast_date,sess.session_end) >= NOW() and datediff(f.start_date,NOW()) < 0";
    
    //"SELECT * FROM `film` WHERE datediff(start_date,NOW()) < 0 and datediff(end_date,NOW()) > 0 and status = 1" . $filter;
    
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
    $sql = "SELECT DISTINCT f.* FROM `film` f,`schedule` s, `theater_schedule` ts,`session` as sess
    WHERE s.id_film = f.id_film and ts.id_schedule = s.id_schedule and s.id_session = sess.id_session 
    and datediff(f.end_date,NOW()) > 0 and f.status = 1 AND
    addtime(s.broadcast_date,sess.session_end) >= NOW() and datediff(f.end_date,NOW()) > 0 and datediff(f.start_date,NOW()) > 0";
    
    //$sql = "SELECT * FROM `film` WHERE datediff(start_date,NOW()) > 0 and datediff(end_date,NOW()) > 0 and status = 1" . $filter;
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