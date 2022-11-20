<?php
    session_start();

    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] != 'admin') {
            header("Location:login.php");
        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="bootstrap-5.2.1-dist/css/bootstrap.css">
        <title>Document</title>
    </head>
    <body>
        <h1>Welcome Admin</h1>
        <form action="Controller/controller_member.php" method = "POST">
            <button name="logout" type="submit">Logout</button>
            <button name="masterUser" type="submit">Master User</button>
            <button name="masterFilm" type="submit">Master Film</button>
            <button name="masterSchedule" type="submit">Master Schedule</button>
        </form>
        <h2>Master Film</h2>
        <h3>Add Film</h3>
        Nama Film : <input type="text" id="namaFilm"><br>
        Tanggal Mulai : <input type="date" id="mulai"><br>
        Tanggal Akhir : <input type="date" id="akhir"><br>
        Gambar Film ; <input type="text" id="gambar"><br>
        Trailer Link : <input type="text" id="trailer"><br>
        Sinopsis : <textarea id="sinopsis" cols="30" rows="10"></textarea><br>
        Genre : <br>
        <input type="checkbox" class="genre" value="1"> Action <br>
        <input type="checkbox" class="genre" value="2"> Horror
        <input type="checkbox" class="genre" value="3"> Romance <br>
        <input type="checkbox" class="genre" value="4"> Family
        <input type="checkbox" class="genre" value="5"> Comedy<br>
        <input type="checkbox" class="genre" value="6"> Shounen
        <input type="checkbox" class="genre" value="7"> Thriller<br>
        <button id="addFilm">Add Film</button>
        <table id="filmContainer" border="1" class="table">

        </table>

        
        <script src="ajax.js"></script>
        <script>
            var addButton = document.getElementById("addFilm");
            var filmContainer = document.getElementById("filmContainer");

            addButton.addEventListener("click", insertIntoFilm);
            updateFilm();

            function insertIntoFilm(){
                var nama = document.getElementById("namaFilm").value;
                var mulai = document.getElementById("mulai").value;
                var akhir = document.getElementById("akhir").value;
                var gambar = document.getElementById("gambar").value;
                var trailer = document.getElementById("trailer").value;
                var sinopsis = document.getElementById("sinopsis").value;
                var checkbox = document.querySelectorAll(".genre:checked");
                var genre = [];
                for(var i=0; i<checkbox.length; i++){
                    genre.push(checkbox[i].value);
                }
                document.getElementById("namaFilm").value = "";
                document.getElementById("mulai").value = "";
                document.getElementById("akhir").value = "";
                document.getElementById("gambar").value = "";
                document.getElementById("trailer").value = "";
                document.getElementById("sinopsis").value = "";
                var data = `nama=${nama}&mulai=${mulai}&akhir=${akhir}&gambar=${gambar}&trailer=${trailer}&sinopsis=${sinopsis}&genre=${JSON.stringify(genre)}`;
                var crudObject = new CrudObject("insertintofilm.php", data);
                crud(crudObject, updateFilm);
            }

            function updateFilm(){
                var ajaxContainer = document.getElementById("filmContainer");
                var fetchObject = new FetchObject("fetchfilm.php", ajaxContainer, bindFilmDelete);

                fetch(fetchObject);
            }

            function bindFilmDelete(){
                var listDelete = document.querySelectorAll(".deleteFilm");
                for(var i=0; i<listDelete.length; i++){
                    listDelete[i].addEventListener("click", deleteFilm);
                }
            }

            function deleteFilm(){
                var data = `id_film=${this.value}`;
                crudObject = new CrudObject("deletefilm.php", data);
                crud(crudObject, updateFilm);
            }

            setInterval(updateFilm, 500);
        </script>
    </body>
</html>