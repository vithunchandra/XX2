<?php
    require('connect.php');

    if(isset($_GET['get_seat'])) {
      $theater = $_GET['theater'];
      $tanggal = $_GET['tanggal'];
      $movieNow = $_GET['film'];

      echo $theater . " " . $tanggal . " " . $movieNow;
    }

    if(isset($_GET['get_all_broadcast_date'])) {
        $sql = "select s.broadcast_date as tgl from theater_schedule as ts,schedule as s where ts.id_schedule = s.id_schedule and 
        ts.id_theater = ".$_GET['theater']." and s.id_film = ".$_GET['film'].";";

        $result = fetch($sql);
        echo json_encode($result);
    }
?>