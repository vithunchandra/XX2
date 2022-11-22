<?php
    require "../Controller/functions.php";

    $filmID = $_POST['filmID'];
    $filmData = fetchData("SELECT * FROM film where id_film = '$filmID'")[0];
    $mulai = date('Y-m-d', strtotime($filmData['start_date']));
    $akhir = date('Y-m-d', strtotime($filmData['end_date']));
    $genre = fetchData("SELECT * FROM film_genre fg JOIN genre g ON g.id_genre = fg.id_genre WHERE fg.id_film = '$filmID'");
    $namaGenre = fetchData("SELECT nama_genre FROM genre");
?>

<h3>Add Film</h3>
Nama Film : <input type="text" id="namaUpdate" value="<?= $filmData['nama_film'] ?>"><br>
Tanggal Mulai : <input type="date" id="mulaiUpdate" value=<?= $mulai ?>><br>
Tanggal Akhir : <input type="date" id="akhirUpdate" value=<?= $akhir ?>><br>

Gambar Film : <img src="Gambar/<?= $filmData['image_path'] ?>" width="50px">
<input id="gambar" type="file" name="gambar" value=""><?= $filmData['image_path'] ?> <br>
Trailer Link : <input type="text" id="trailerUpdate" value="<?= $filmData['trailer_link'] ?>"><br>
Sinopsis : <textarea id="sinopsisUpdate" cols="30" rows="10"><?= $filmData['sinopsis'] ?></textarea><br>
Genre : <br>
<?php 
    $counter = 0;
    for($i=0; $i<7; $i++){
        if($counter < count($genre)){
            if($genre[$counter]['id_genre'] == $i){ ?>
                <input type="checkbox" class="genreUpdate" value="1"> <?= $namaGenre[$i]['nama_genre'] ?>
            <?php $counter++;}else{ ?>
                <input type="checkbox" class="genreUpdate" value="0"> <?= $namaGenre[$i]['nama_genre'] ?>
            <?php } ?>
            <?php if($i % 2 == 1){
                echo "<br>";
            } ?>
        <?php } ?>
    <?php } ?><br>
<button id="updateFilmDataButton">Add Film</button>