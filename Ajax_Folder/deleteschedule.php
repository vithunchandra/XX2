<?php
    require "../Controller/functions.php";

    $scheduleID = $_POST['scheduleID'];

    crud("UPDATE theater_schedule SET status = 0 WHERE id_schedule = '$scheduleID'");

    crud("UPDATE schedule SET status = 0 WHERE id_schedule = '$scheduleID'");
?>