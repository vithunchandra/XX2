<?php
    require "functions.php";

    $scheduleID = $_POST['scheduleID'];

    crud("UPDATE schedule SET status = 0 WHERE id_schedule = '$scheduleID'");
?>