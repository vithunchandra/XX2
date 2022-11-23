<?php 
    require "../Controller/functions.php";

    $filmID = $_POST['filmID'];
    $nama = $_POST['nama'];
    $mulai = toDate($_POST['mulai']);
    $akhir = toDate($_POST['akhir']);
    $gambar = $_POST['gambar'];
    $trailer = $_POST['trailer'];
    $sinopsis = $_POST['sinopsis'];
    $genre = json_decode($_POST['genre'], true);
    $messageContainer = "";

    if(!empty($nama) && !empty($mulai) && !empty($akhir) && !empty($gambar) && !empty($trailer) && !empty($sinopsis) && !empty($genre)){
        $query = "UPDATE FILM SET nama_film = '$nama', sinopsis = '$sinopsis', image_path = '$gambar', trailer_link = '$trailer', 
        start_date = '$mulai', end_date = '$akhir' WHERE id_film = '$filmID'";
        crud($query);
    
        crud("DELETE FROM film_genre WHERE id_film = '$filmID'");
        foreach($genre as $value){
            crud("INSERT INTO film_genre(id_genre, id_film) VALUES('$value', '$filmID')");
        }
    }else{
        $messageContainer = "Field tidak boleh kosong";
    }
    
?>

<?= $messageContainer ?>