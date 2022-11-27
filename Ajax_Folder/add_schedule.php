<?php 
    require "../Controller/functions.php";

    $id_theater = $_POST['id_theater'];
    $id_session = $_POST['id_session'];
    $id_film = $_POST['id_film'];

    $query = "INSERT INTO schedule "
?>