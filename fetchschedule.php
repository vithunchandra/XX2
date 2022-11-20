<?php
    require "functions.php";

    $scheduleData = fetchData("SELECT s.id_schedule AS id, f.nama_film AS nama, s.broadcast_date AS date, se.session_start AS start, se.session_end AS end, 
    s.status AS status, f.image_path AS gambar FROM schedule s JOIN film f ON f.id_film = s.id_film JOIN session se ON se.id_session = s.id_session");
?>

<tr>
    <th>No</th>
    <th>Film</th>
    <th>Image</th>
    <th>Broadcast Date</th>
    <th>Start</th>
    <th>End</th>
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
                    <button class="deleteSchedule" value=<?= $schedule['id'] ?>>Deactivate</button> <br>
                    <button class="updateSchedule" value=<?= $schedule['id'] ?>>Update</button>
                </td>
            </tr>
        <?php } ?>
    <?php } ?>