<?php
    require('connect.php');

    if(isset($_GET['get_seat'])) {
      $theater = $_GET['theater'];
      $tanggal = $_GET['tanggal'];
      $movieNow = $_GET['film'];
      $sesi = $_GET['sesi'];

      $sizeNow = fetch("Select width,height from theater where id_theater = " . $theater);

      $seat = [];
      for($i = 0;$i < $sizeNow[0]['height'];$i++) {
        for($j = 0;$j < $sizeNow[0]['width'];$j++)  {
          //nanti tambahi pengecekan apakah seat sudah diambil di db
          $seat[$i][$j] = 1;
        }
      }
      echo json_encode($seat);
      //echo $theater . " " . $tanggal . " " . $movieNow . " " . $sesi;
    }

    if(isset($_GET['get_all_broadcast_date'])) {
        $sql = "select distinct s.broadcast_date as tgl from theater_schedule as ts,schedule as s where ts.id_schedule = s.id_schedule and 
        ts.id_theater = ".$_GET['theater']." and s.id_film = ".$_GET['film']." and ts.status = 1;";

        $result = fetch($sql);
        echo json_encode($result);
    }

    if(isset($_GET['get_all_session'])) {
      $sql = "select ses.id_session as id,ses.session_start as starts,ses.session_end as ends from theater_schedule as ts,schedule as s,session as ses where ts.id_schedule = s.id_schedule and ses.id_session = s.id_session and 
      ts.id_theater = ".$_GET['theater']." and s.id_film = ".$_GET['film']." and s.broadcast_date = ".$_GET['date']." and ts.status = 1;";
      
      // echo $sql;
      $result = fetch($sql);
      echo json_encode($result);
    } 

    if(isset($_GET['buy'])) {
      $theater = $_GET['theater'];
      $tanggal = $_GET['tanggal'];
      $movieNow = $_GET['film'];
      $sesi = $_GET['sesi'];
      $seat = json_decode($_GET['seat']);
      // insert transaction and check money
    }

?>