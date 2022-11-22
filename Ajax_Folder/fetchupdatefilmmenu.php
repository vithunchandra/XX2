<?php
    require "../Controller/functions.php";

    $filmID = $_POST['filmID'];
    $filmData = fetchData("SELECT * FROM film where id_film = '$filmID'")[0];
    $mulai = date('Y-m-d', strtotime($filmData['start_date']));
    $akhir = date('Y-m-d', strtotime($filmData['end_date']));
    $genre = fetchData("SELECT * FROM film_genre fg JOIN genre g ON g.id_genre = fg.id_genre WHERE fg.id_film = '$filmID'");
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
    for($i=0; $i<7; $i++){
        if(!empty($genre[$i])){

        }else{

        }
    }
?>
<button id="updateFilmDataButton">Add Film</button>