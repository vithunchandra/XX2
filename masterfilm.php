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
        <link rel="stylesheet" href="mycss.css">
        <title>Document</title>
        <script src = "jquery-3.6.1.min.js"></script>
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
        Gambar Film : <input id="gambar" type="file" name="gambar" /> <br><br>
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

        <div class="popup_container">
            <div class="popup">
                <Button id="closePopup">Close</Button>
                <div id="updateContainer">

                </div>
            </div>
        </div>
        <script src="ajax.js"></script>
        <script>
            var addButton = document.getElementById("addFilm");
            var filmContainer = document.getElementById("filmContainer");
            var closePopup = document.getElementById("closePopup");

            addButton.addEventListener("click", insertIntoFilm);
            updateFilm();
            function insertIntoFilm(){
                var nama = document.getElementById("namaFilm").value;
                var mulai = document.getElementById("mulai").value;
                var akhir = document.getElementById("akhir").value;
                
                var file_data = $("#gambar").prop("files")[0];   
                var gambar = file_data.name;
                var form_data = new FormData();
                form_data.append("file", file_data);


                var trailer = document.getElementById("trailer").value;
                var sinopsis = document.getElementById("sinopsis").value;
                var checkbox = document.querySelectorAll(".genre:checked");
                var genre = [];
                for(var i=0; i<checkbox.length; i++){
                    genre.push(checkbox[i].value);
                    checkbox[i].checked = false;
                }
                document.getElementById("namaFilm").value = "";
                document.getElementById("mulai").value = "";
                document.getElementById("akhir").value = "";
                document.getElementById("gambar").value = "";
                document.getElementById("trailer").value = "";
                document.getElementById("sinopsis").value = "";
                var data = `nama=${nama}&mulai=${mulai}&akhir=${akhir}&gambar=${gambar}&trailer=${trailer}&sinopsis=${sinopsis}&genre=${JSON.stringify(genre)}`;
                var crudObject = new CrudObject("Ajax_Folder/insertintofilm.php", data);
                crud(crudObject, updateFilm);
                
                $.ajax({
                    url: 'Ajax_Folder/upload.php', // <-- point to server-side PHP script 
                    dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(php_script_response){
                        console.log(php_script_response); // <-- display response from the PHP script, if any
                    }
                });
                
            }
            /*
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
                var crudObject = new CrudObject("Ajax_Folder/insertintofilm.php", data);
                crud(crudObject, updateFilm);
            }
            */
            function updateFilm(){
                var ajaxContainer = document.getElementById("filmContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchfilm.php", ajaxContainer, bindFilmAction);

                fetch(fetchObject);
            }

            function bindFilmAction(){
                var listDelete = document.querySelectorAll(".deleteFilm");
                for(var i=0; i<listDelete.length; i++){
                    listDelete[i].addEventListener("click", deleteFilm);
                }

                var listUpdate = document.querySelectorAll(".updateFilm");
                for(var i=0; i<listUpdate.length; i++){
                    listUpdate[i].addEventListener("click", showPopup);
                }
            }

            function deleteFilm(){
                var data = `id_film=${this.value}`;
                crudObject = new CrudObject("Ajax_Folder/deletefilm.php", data);
                crud(crudObject, updateFilm);
            }

            function fetchUpdateMenu(data){
                var ajaxContainer = document.getElementById("updateContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchupdatefilmmenu.php", ajaxContainer, bindUpdateDataButton, data);

                fetch(fetchObject);
            }

            function bindUpdateDataButton(){
                var updateFilmDataButton = document.getElementById("updateFilmDataButton");
                updateFilmDataButton.addEventListener("click", updateFilmData);
                changeCheckboxState();
            }

            function updateFilmData(){
                var filmID = this.value;
                var nama = document.getElementById("namaUpdate").value;
                var mulai = document.getElementById("mulaiUpdate").value;
                var akhir = document.getElementById("akhirUpdate").value;
                
                var file_data = $("#gambarUpdate").prop("files")[0];
                var old = $("#old").val();
                var gambar = file_data.name;
                var form_data = new FormData();
                form_data.append("file", file_data);
                form_data.append("old", old);

                alert(old);

                var trailer = document.getElementById("trailerUpdate").value;
                var sinopsis = document.getElementById("sinopsisUpdate").value;
                var checkbox = document.querySelectorAll(".genre:checked");
                var genre = [];
                for(var i=0; i<checkbox.length; i++){
                    genre.push(checkbox[i].value);
                    checkbox[i].checked = false;
                }
                document.getElementById("namaFilm").value = "";
                document.getElementById("mulai").value = "";
                document.getElementById("akhir").value = "";
                document.getElementById("gambar").value = "";
                document.getElementById("trailer").value = "";
                document.getElementById("sinopsis").value = "";
                var data = `filmID=${filmID}&nama=${nama}&mulai=${mulai}&akhir=${akhir}&gambar=${gambar}&trailer=${trailer}&sinopsis=${sinopsis}&genre=${JSON.stringify(genre)}`;
                var crudObject = new CrudObject("Ajax_Folder/updatefilmdata.php", data);
                crud(crudObject, updateFilm, confirmationUpdateFilmData);

                $.ajax({
                    url: 'Ajax_Folder/updateUpload.php', // <-- point to server-side PHP script 
                    dataType: 'text',  // <-- what to expect back from the PHP script, if anything
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    type: 'post',
                    success: function(php_script_response){
                        console.log(php_script_response); // <-- display response from the PHP script, if any
                    }
                });
            }

            function changeCheckboxState(){
                var checkbox = document.querySelectorAll(".genreUpdate");
                for(var i=0; i<checkbox.length; i++){
                    if(checkbox[i].value == "1"){
                        checkbox[i].checked = true;
                    }
                }
            }

            function confirmationUpdateFilmData(){
                var message = "";
                message = document.getElementById("messageContainer").innerText;
                alert(message);
                if(message.length == 0){
                    hidePopup();
                }
            }

            function showPopup(){
                var data = `filmID=${this.value}`;
                var popup = document.querySelector(".popup_container");
                popup.style.display = "flex";

                fetchUpdateMenu(data);
            }

            function hidePopup(){
                var popup = document.querySelector(".popup_container");
                popup.style.display = "none";
                updateFilm();
            }

            closePopup.addEventListener("click", hidePopup);
            setInterval(updateFilm, 500);
        </script>
    </body>
</html>