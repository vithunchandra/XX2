<?php
    require "../Controller/functions.php";

    $filmID = $_POST['filmID'];
    $filmData = fetchData("SELECT * FROM film where id_film = '$filmID'")[0];
    $mulai = date('Y-m-d', strtotime($filmData['start_date']));
    $akhir = date('Y-m-d', strtotime($filmData['end_date']));
    $genre = fetchData("SELECT * FROM film_genre fg JOIN genre g ON g.id_genre = fg.id_genre WHERE fg.id_film = '$filmID'");
    $namaGenre = fetchData("SELECT nama_genre FROM genre");
?>

<div class="container-fluid p-3 border border-3 rounded-3 mx-auto" style="width: 900px;">
    <h4 class="text-center">Update Film Form</h4>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="filmID" value="<?= $filmData['id_film'] ?>" placeholder="ID">
        <label for="filmID">ID</label>
    </div>
    <div class="form-floating mb-3">
        <input type="text" class="form-control" id="namaUpdate" value="<?= $filmData['nama_film'] ?>" placeholder="Bocchi The Rock Movie">
        <label for="namaUpdate">Film Name</label>
    </div>
    <div class="container-fluid mb-3">
        <div class="row">
            <div class="col-6">
                <div class="form-floating">
                    <input type="date" class="form-control" id="mulaiUpdate" value="<?= $mulai ?>" placeholder="Tanggal Mulai">
                    <label for="mulaiUpdate">Tanggal Mulai Tayang</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input type="date" class="form-control" id="akhirUpdate" value="<?= $akhir ?>" placeholder="Tanggal Akhir">
                    <label for="akhirUpdate">Tanggal Akhir Tayang</label>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-3">
        <div class="col-3">
            <img src="Gambar/<?= $filmData['image_path'] ?>" width="50px" class="w-100 rounded">
        </div>
        <div class="col-9 align-self-center">
            <div class="input-group">
                <input type="file" class="form-control"  id="gambarUpdate">
                <input type="text" name="old" id="old" hidden value="<?= $filmData['image_path'] ?>">
                <label class="input-group-text" for="gambarUpdate">Upload</label>
            </div>
        </div>
    </div>
    

    <div class="form-floating mb-3">
        <input type="text" class="form-control" value="<?= $filmData['trailer_link'] ?>" id="trailerUpdate">
        <label for="trailerUpdate">Trailer Film</label>
    </div>

    <div class="form-floating mb-3">
        <textarea class="form-control" id="sinopsisUpdate" style="height: 100px"><?= $filmData['sinopsis'] ?></textarea>
        <label for="sinopsisUpdate">Sinopsis Film</label>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-auto">
                Genre :
            </div>
            <div class="col">
                <?php 
                    $counter = 0;
                    for($i=0; $i<7; $i++){
                        if($counter < count($genre)){
                            if($genre[$counter]['id_genre'] == ($i + 1)){ ?>
                                <input type="checkbox" class="genreUpdate form-check-input" value="1-<?= ($i + 1) ?>"> <?= $namaGenre[$i]['nama_genre'] ?>
                            <?php $counter++;}else{ ?>
                                <input type="checkbox" class="genreUpdate form-check-input" value="0-<?= ($i + 1) ?>"> <?= $namaGenre[$i]['nama_genre'] ?>
                            <?php } ?>
                        <?php }else{ ?>
                            <input type="checkbox" class="genreUpdate form-check-input" value="0-<?= ($i + 1) ?>"> <?= $namaGenre[$i]['nama_genre'] ?>
                        <?php } ?>
                        <?php if($i % 3 == 2){
                            echo "<br>";
                        } ?>
                    <?php } ?><br>
            </div>
        </div>
    </div>
    
    <div class="container-fluid text-center">
        <span id="messageContainerUpdate"></span> <br>
        <button id="updateFilmDataButton" class="btn btn-primary">Update Film</button>
        <button id="closePopup" class="btn btn-danger">Cancel Update</button>
    </div>
    
</div>