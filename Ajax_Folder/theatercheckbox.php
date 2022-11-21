<?php
    require "../Controller/functions.php";

    $theaterID = $_POST['theaterID'];
    $scheduleID = $_POST['scheduleID'];
    $query = "UPDATE theater_schedule SET status = NOT status WHERE id_theater = '$theaterID' AND id_schedule = '$scheduleID'";
    crud($query);
    // $isExist = fetchData("SELECT EXISTS(SELECT * FROM theater_schedule WHERE id_theater = '$theaterID' AND id_schedule = '$scheduleID') AS isExist")[0]['isExist'];
    // if($isExist == 1){
    //     $query = "UPDATE theater_schedule SET status = NOT status WHERE id_theater = '$theaterID' AND id_schedule = '$scheduleID'";
    // }else{
    //     $query = "INSERT INTO theater_schedule(id_theater, id_schedule) VALUES()"
    // }
?>