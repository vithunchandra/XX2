<?php
    require('connect.php');

    if(isset($_GET['get_seat'])) {
      $theater = $_GET['theater'];
      $tanggal = $_GET['tanggal'];
      $movieNow = $_GET['film'];
      $sesi = $_GET['sesi'];
      $id_schedule = fetch("SELECT id_schedule FROM `schedule` WHERE id_film = $movieNow and id_session = $sesi and broadcast_date = $tanggal and status = 1")[0]['id_schedule'];
      $id_theater_schedule = fetch("SELECT id_theater_schedule id FROM `theater_schedule` WHERE id_theater = $theater and id_schedule = $id_schedule and status = 1")[0]['id'];

      $sizeNow = fetch("Select width,height from theater where id_theater = " . $theater);

      $all_seat_sql = fetch("SELECT dm.seat_i,dm.seat_j FROM `d_movie` dm ,(SELECT id_nota FROM `h_movie` WHERE id_theater_schedule = $id_theater_schedule) as related_nota WHERE dm.id_nota = related_nota.id_nota;");


      $seat = [];
      for($i = 0;$i < $sizeNow[0]['height'];$i++) {
        for($j = 0;$j < $sizeNow[0]['width'];$j++)  {
          //nanti tambahi pengecekan apakah seat sudah diambil di db
          $canFill = 1;
          for($k = 0;$k < count($all_seat_sql);$k++) {
            if($i == $all_seat_sql[$k]['seat_i'] && $j == $all_seat_sql[$k]['seat_j'] ) {
              $canFill = 0;
            }
          }
          $seat[$i][$j] = $canFill;
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
      $user = $_GET['user'];

      $theater = $_GET['theater'];
      $movieNow = $_GET['film'];
      $sesi = $_GET['sesi'];
      $tanggal = $_GET['tanggal'];
      $id_schedule = fetch("SELECT id_schedule FROM `schedule` WHERE id_film = $movieNow and id_session = $sesi and broadcast_date = $tanggal and status = 1")[0]['id_schedule'];
      $id_theater_schedule = fetch("SELECT id_theater_schedule id FROM `theater_schedule` WHERE id_theater = $theater and id_schedule = $id_schedule and status = 1")[0]['id'];


      $seat = json_decode($_GET['seat']);
      

      $id_now = fetch("SELECT (ifnull(max(id_nota),0) + 1) as new_id FROM `h_movie` WHERE 1;")[0]['new_id'] ;
      $sql_header = "INSERT INTO `h_movie`(`id_nota`,`id_member`, `id_theater_schedule`, `buy_date`) 
            VALUES ($id_now,$user,$id_theater_schedule,NOW())";
      
      $conn->begin_transaction();
      try {
        $conn->query($sql_header);

        for($i = 0;$i < count($seat);$i++) {
          $sql_desc = "INSERT INTO `d_movie`(`id_nota`, `seat_i`, `seat_j`) 
            VALUES ($id_now,".$seat[$i][0].",".$seat[$i][1].")";
          $conn->query($sql_desc);
        }


        $conn->commit();
      } catch (mysqli_sql_exception $exception) {
        $conn->rollback();
        throw $exception;
      }
      
      
    }

    if(isset($_GET['get_search_prop'])) {

      $result['theater'] = fetch('select id_theater,nama_theater from theater');
      $result['session'] = fetch('select * from session');
      echo json_encode($result);
    } 
?>