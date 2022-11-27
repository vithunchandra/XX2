<?php 
    require "../Controller/functions.php";
    $date = $_POST['date'];

    $theater = fetchData("SELECT id_theater, nama_theater FROM theater");
    $session = fetchData("SELECT id_session, session_start, session_end FROM session");
?>

<tr>
    <th></th>
    <?php 
        foreach($session as $value){ ?>
            <th>
                <?= $value['session_start']."-".$value['session_end'] ?>
            </th>
        <?php } ?>
</tr>
<?php 
    foreach($theater as $row){ ?>
        <tr>
            <th>
                <?= $row['nama_theater'] ?>
            </th>
            <?php foreach($session as $col){
                $theaterID = $row['id_theater'];
                $sessionID = $col['id_session'];
                $schedule = fetchData("SELECT * FROM theater_schedule ts JOIN schedule s ON s.id_schedule = ts.id_schedule JOIN film f ON f.id_film = s.id_film 
                WHERE s.broadcast_date = '$date' AND ts.id_theater = '$theaterID' AND s.id_session = '$sessionID' AND ts.status = 1"); ?>

                <td>
                    <?php if(!empty($schedule)){ 
                        $data = $schedule[0]; ?>
                        <img src="Gambar/<?= $data['image_path'] ?>" class="rounded" style="width: 200px;"> <br>
                        <span class="fw-bold"><?= $data['nama_film'] ?></span><br>
                        <button class="btn btn-danger delete-film" value="<?= $row['id_theater'].'-'.$col['id_session'] ?>">Delete Film</button>
                    <?php }else{ ?>
                        <button class="btn btn-info choose-film" value="<?= $row['id_theater'].'-'.$col['id_session'] ?>">Choose Film</button>
                    <?php } ?>
                </td>
            <?php } ?>
        </tr>
    <?php } ?>