<?php 
    require "../Controller/functions.php";

    $filter = ""; 
    $queryMulai = "";
    $queryAkhir = "";
    $queryGenre = "";

    if(isset($_POST)){
        if(!empty($_POST['judul'])){
            $judul = $_POST['judul'];
            $filter = " AND nama_film LIKE '%$judul%'";
        }
        if(!empty($_POST['mulai'])){
            $mulai = toDate($_POST['mulai']);
            $queryMulai = " AND start_date >= '$mulai'";
        }
        if(!empty($_POST['akhir'])){
            $akhir = toDate($_POST['akhir']);
            $queryAkhir = " AND end_date <= '$akhir'";
        }
        if(!empty($_POST['genre'])){
            $genre = $_POST['genre'];
            if($genre != 'all'){
                $queryGenre = " AND id_genre = '$genre'";
            }
        }
    }

    $filmData = fetchData("SELECT DISTINCT f.id_film as id, nama_film AS nama, sinopsis, image_path AS image, trailer_link AS trailer, 
    start_date AS start, end_date AS end, status FROM film f JOIN film_genre fg ON fg.id_film = f.id_film WHERE 1=1".$filter.$queryMulai.$queryAkhir.$queryGenre);
?>

<?php 
    $counter = 0;
    foreach($filmData as $key => $film){
        if($film['status']){ ?>
            <div class="item-container d-flex justify-content-center align-items-center w-100 border-top border-2 mx-auto py-3">
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
    <?php $counter++;} ?>
    