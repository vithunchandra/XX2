<?php 
    require "functions.php";
    
    $filmID = $_POST['id_film'];
    crud("UPDATE film SET status = 0 WHERE id_film = '$filmID'");
?>