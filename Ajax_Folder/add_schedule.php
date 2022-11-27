<?php 
    require "../Controller/functions.php";

    $id_theater = $_POST['id_theater'];
    $id_session = $_POST['id_session'];
    $id_film = $_POST['id_film'];
    $date = $_POST['date'];

    $id_schedule = fetchScalar("SELECT id_schedule FROM schedule WHERE id_session = '$id_session' AND id_film = '$id_film' AND broadcast_date = '$date'");
    if(!empty($id_schedule)){
        $query = "UPDATE schedule SET status = 1 WHERE id_schedule = '$id_schedule'";
        crud($query);
    }else{
        $query = "INSERT INTO schedule(id_film, broadcast_date, id_session) 
        VALUES('$id_film', '$date', '$id_session')";
        crud($query);
    
        $id_schedule = fetchScalar("SELECT id_schedule FROM schedule ORDER BY id_schedule DESC LIMIT 1");    
    }
    
    $query = "INSERT INTO theater_schedule(id_theater, id_schedule) 
    VALUES('$id_theater', '$id_schedule')";
    crud($query);
?>