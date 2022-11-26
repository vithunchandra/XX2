<?php 
    require "../Controller/functions.php";

    $filmData = fetchData("SELECT id_film as id, nama_film AS nama, sinopsis, image_path AS image, trailer_link AS trailer, 
    start_date AS start, end_date AS end, status FROM film");
?>

<?php 
    foreach($filmData as $film){
        if($film['status']){ ?>
            <div class="item-container d-flex justify-content-center align-items-center w-100 border-top border-2 mx-auto">
                <div class="item-img-container w-15 text-center">
                    <img src="Gambar/<?= $film['image'] ?>" class="film-image"> <br>
                </div>
                <div class="item-detail w-85 p-3">
                    <div class="row">
                        <div class="col-8">
                            <p class="fs-3 fw-bold"><?= $film['nama'] ?></p>
                        </div>
                        <div class="col text-end">
                            <span class="fw-bold"><?= $film['start'] ?> - <?= $film['end'] ?> </span>
                        </div>
                    </div>
                    <span class="fw-bold text-success">
                    Genre :  
                    <?php
                        $currentID = $film['id'];
                        $genreData = fetchData("SELECT nama_genre FROM film_genre fg JOIN genre g ON g.id_genre = fg.id_genre WHERE id_film = '$currentID'");
                        foreach($genreData as $key => $genre){ ?>
                            <?= $genre['nama_genre'] ?>
                            <?php if($key != array_key_last($genreData)){ ?>
                                <?= ", " ?>
                            <?php } ?>
                        <?php } ?> </span> <br>
                    Trailer : <?= $film['trailer'] ?> <br>
                    Sinopsis : <?= $film['sinopsis'] ?> <br><br>
                    <button class="deleteFilm btn btn-danger" value="<?= $film['id'] ?>">Deactivate</button>
                    <button class="updateFilm btn btn-info" value="<?= $film['id'] ?>">Update</button>
                </div>
            </div>
        <?php } ?>
    <?php } ?>
    