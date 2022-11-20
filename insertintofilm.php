<?php
    require "functions.php";

    $nama = $_POST['nama'];
    $mulai = toDate($_POST['mulai']);
    $akhir = toDate($_POST['akhir']);
    $gambar = $_POST['gambar'];
    $trailer = $_POST['trailer'];
    $sinopsis = $_POST['sinopsis'];
    $genre = json_decode($_POST['genre'], true);
    var_dump($genre);
    
    $query = "INSERT INTO film(nama_film, start_date, end_date, image_path, trailer_link, sinopsis) 
    VALUES('$nama', '$mulai', '$akhir', '$gambar', '$trailer', '$sinopsis')";

    crud($query);

    echo "test";
    
    $lastID = fetchData("SELECT id_film FROM film ORDER BY id_film DESC LIMIT 1")[0]['id_film'];
    foreach($genre as $value){
        crud("INSERT INTO film_genre(id_genre, id_film) VALUES('$value', '$lastID')");
    }
?>