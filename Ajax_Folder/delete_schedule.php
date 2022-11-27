<?php 
    require "../Controller/functions.php";

    $id_theater = $_POST['id_theater'];
    $id_schedule = $_POST['id_schedule'];
    $id_theater_schedule = fetchScalar("SELECT id_theater_schedule FROM theater_schedule WHERE id_theater = '$id_theater' AND id_schedule = '$id_schedule'");
    $isExist = fetchScalar("SELECT EXISTS(SELECT * FROM h_movie WHERE id_theater_schedule = '$id_theater_schedule')");
    $query = "";
    if($isExist){
        $query = "UPDATE theater_schedule SET status = 0 WHERE id_theater_schedule = '$id_theater_schedule'";
    }else{
        $query = "DELETE FROM theater_schedule WHERE id_theater_schedule = '$id_theater_schedule'";
    }
    crud($query);
    $query = "SELECT EXISTS(SELECT * FROM theater_schedule WHERE id_schedule = '$id_schedule')";
    $isExist = fetchScalar($query);
    if(!$isExist){
        $query = "DELETE FROM schedule where id_schedule = '$id_schedule'";
        crud($query);
    }
?>