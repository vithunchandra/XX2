<?php
    require "../Controller/functions.php";

    $scheduleData = fetchData("SELECT s.id_schedule AS id, f.nama_film AS nama, s.broadcast_date AS date, s.id_session As id_session, se.session_start AS start, se.session_end AS end, 
    s.status AS status, f.image_path AS gambar FROM schedule s JOIN film f ON f.id_film = s.id_film JOIN session se ON se.id_session = s.id_session");
?>

<tr>
    <th>No</th>
    <th>Film</th>
    <th>Image</th>
    <th>Broadcast Date</th>
    <th>Start</th>
    <th>End</th>
    <th>Theatre</th>
    <th>Action</th>
</tr>
<?php
    $counter = 1;
    foreach($scheduleData as $schedule){
        if($schedule['status']){ ?>
            <tr>
                <td><?= $counter ?></td>
                <td><?= $schedule['nama'] ?></td>
                <td><img src="Gambar/<?= $schedule['gambar'] ?>" height="50px"></td>
                <td><?= $schedule['date'] ?></td>
                <td><?= $schedule['start'] ?></td>
                <td><?= $schedule['end'] ?></td>
                <td>
                    Theatre : <br>
                    <?php
                        $theaterID = 1;
                        $scheduleID = $schedule['id'];
                        $sessionID = $schedule['id_session'];
                        $theater = fetchData("SELECT * FROM theater_schedule WHERE id_schedule = '$scheduleID'");
                        foreach($theater as $value){
                            $query = "SELECT EXISTS(SELECT * FROM theater_schedule ts JOIN schedule s ON s.id_schedule = ts.id_schedule
                            WHERE s.id_schedule != '$scheduleID' AND s.id_session = '$sessionID' AND ts.id_theater = '$theaterID' AND ts.status = 1)"; 
                            $isCollide = fetchScalar($query);
                            if($isCollide){ ?>
                                <input type="checkbox" class="theater" value="<?= $theaterID ?>-<?= $schedule['id'] ?>-<?= $value['status'] ?>" disabled> Theater <?= $theaterID ?> <br>
                            <?php }else{ ?>
                                <input type="checkbox" class="theater" value="<?= $theaterID ?>-<?= $schedule['id'] ?>-<?= $value['status'] ?>"> Theater <?= $theaterID ?> <br>
                            <?php } ?>
                    
                        <?php $theaterID++;} ?>
                </td>
                <td>
                    <button class="deleteSchedule" value=<?= $schedule['id'] ?>>Deactivate</button> <br>
                    <button class="updateSchedule" value=<?= $schedule['id'] ?>>Update</button>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>
