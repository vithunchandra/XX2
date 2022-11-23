<?php
    require "../Controller/functions.php";

    $scheduleID = $_POST['scheduleID'];

    crud("DELETE FROM theater_schedule ts WHERE id_schedule = '$scheduleID' NOT EXISTS(SELECT * FROM h_movie WHERE id_theater_schedule = ts.id_theater_schedule)");

    crud("UPDATE theater_schedule SET status = 0 WHERE id_schedule = '$scheduleID'");

    crud("UPDATE schedule SET status = 0 WHERE id_schedule = '$scheduleID'");
?>