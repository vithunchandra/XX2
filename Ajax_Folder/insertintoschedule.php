<?php 
    require "../Controller/functions.php";
    
    $filmID = $_POST['filmID'];
    $broadcast = $_POST['broadcast'];
    $session = $_POST['session'];
    $message = "";
    
    $isExist = fetchData("SELECT * FROM schedule WHERE id_film = '$filmID' AND broadcast_date = '$broadcast' AND id_session = '$session' AND status = 1");
    $inRange = fetchData("SELECT true FROM schedule s JOIN film f ON f.id_film = s.id_film WHERE '$broadcast' >= f.start_date AND '$broadcast' <= f.end_date");
    
    if($inRange){
        if(empty($isExist)){
            crud("INSERT INTO schedule(id_film, broadcast_date, id_session) VALUES('$filmID', '$broadcast', '$session')");
            $lastScheduleID = fetchData("SELECT id_schedule AS id FROM schedule ORDER BY id DESC LIMIT 1")[0]['id'];
            $totalTheater = fetchData("SELECT COUNT(*) AS total FROM theater")[0]['total'];
            for($i=0; $i<$totalTheater; $i++){
                $theaterID = $i + 1;
                crud("INSERT INTO theater_schedule(id_theater, id_schedule) VALUES('$theaterID', '$lastScheduleID')");
            }
        }else{
            $message = "Schedule dengan data diatas sudah pernah terdaftar";
        }
    }else{
        $message = "Tanggal tayang schedule tidak masuk dalam range tanggal tayang film";
    }
    
?>

<?= $message ?>