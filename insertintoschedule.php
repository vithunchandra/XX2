<?php 
    require "functions.php";

    $filmID = $_POST['filmID'];
    $broadcast = $_POST['broadcast'];
    $session = $_POST['session'];
    $message = "";
    
    $isExist = fetchData("SELECT * FROM schedule WHERE id_film = '$filmID' AND broadcast_date = '$broadcast' AND id_session = '$session' AND status = 1");

    if(empty($isExist)){
        crud("INSERT INTO schedule(id_film, broadcast_date, id_session) VALUES('$filmID', '$broadcast', '$session')");
    }else{
        $message = "Schedule dengan data diatas sudah pernah terdaftar";
    }
?>

<?= $message ?>