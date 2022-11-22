<?php 
    require "../Controller/functions.php";

    $filmData = fetchData("SELECT id_film as id, nama_film AS nama, sinopsis, image_path AS image, trailer_link AS trailer, 
    start_date AS start, end_date AS end, status FROM film");
?>

<tr>
    <th>No</th>
    <th>Nama</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Genre</th>
    <th>Image</th>
    <th>Trailer</th>
    <th>Sinopsis</th>
    <th>Action</th>
</tr>

<?php
    $counter = 1;
    foreach($filmData as $film) {
        if($film['status']){ ?>
            <tr>
                <td><?= $counter ?></td>
                <td><?= $film['nama'] ?></td>
                <td><?= $film['start'] ?></td>
                <td><?= $film['end'] ?></td>
                <td>
                    <ul>
                        <?php
                            $currentID = $film['id'];
                            $genreData = fetchData("SELECT nama_genre FROM film_genre fg JOIN genre g ON g.id_genre = fg.id_genre WHERE id_film = '$currentID'");
                            foreach($genreData as $genre){ ?>
                                <li><?= $genre['nama_genre'] ?></li>
                            <?php } ?>
                    </ul>
                </td>
                <td><img src="Gambar/<?= $film['image'] ?>" width="50px"></td>
                <td><?= $film['trailer'] ?></td>
                <td><?= $film['sinopsis'] ?></td>
                <td>
                    <button class="deleteFilm" value="<?= $film['id'] ?>">Deactivate</button> <br>
                    <button class="updateFilm" value="<?= $film['id'] ?>">Update</button>
                </td>
            </tr>
        <?php $counter++; } ?>
    <?php } ?>