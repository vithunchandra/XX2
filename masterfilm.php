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
        <script src="bootstrap-5.2.1-dist/js/bootstrap.bundle.js"></script>
    </head>
    <body>
        <h1 class="text-center">Welcome Admin</h1>
        <form action="Controller/controller_member.php" method = "POST" class="text-center">
            <button name="logout" type="submit" class="btn btn-outline-primary">Logout</button>
            <button name="masterUser" type="submit" class="btn btn-outline-primary">Master User</button>
            <button name="masterFilm" type="submit" class="btn btn-primary">Master Film</button>
            <button name="masterSchedule" type="submit" class="btn btn-outline-primary">Master Schedule</button>
            <button name="masterReport" type="submit" class="btn btn-outline-primary">Master Report</button>
        </form>

        <div class="container-fluid px-3">
            <h2 class="text-center m-4">Master Film</h2>

            <div class="container-fluid w-50 p-3 border border-3 rounded-3 mx-auto">
                <h4 class="text-center">Add Film Form</h4>
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="namaFilm" placeholder="Bocchi The Rock Movie">
                    <label for="namaFilm">Film Name</label>
                </div>
                <div class="container-fluid mb-3">
                    <div class="row">
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="mulai" placeholder="Tanggal Mulai">
                                <label for="mulai">Tanggal Mulai Tayang</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-floating">
                                <input type="date" class="form-control" id="akhir" placeholder="Tanggal Akhir">
                                <label for="akhir">Tanggal Akhir Tayang</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="gambar">
                    <label class="input-group-text" for="gambar">Upload</label>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="trailer" placeholder="Trailer Film">
                    <label for="trailer">Trailer Film</label>
                </div>

                <div class="form-floating mb-3">
                    <textarea class="form-control" id="sinopsis" style="height: 100px" placeholder="Sinopsis"></textarea>
                    <label for="sinopsis">Sinopsis Film</label>
                </div>

                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            Genre :
                        </div>
                        <div class="col-auto">
                            <input type="checkbox" class="genre form-check-input" value="1"> Action
                            <input type="checkbox" class="genre form-check-input" value="2"> Horror
                            <input type="checkbox" class="genre form-check-input" value="3"> Romance <br>
                            <input type="checkbox" class="genre form-check-input" value="4"> Family
                            <input type="checkbox" class="genre form-check-input" value="5"> Comedy
                            <input type="checkbox" class="genre form-check-input" value="6"> Shounen <br>
                            <input type="checkbox" class="genre form-check-input" value="7"> Thriller
                        </div>
                    </div>
                </div>
                
                <div class="container-fluid text-center">
                    <span id="messageContainer"></span> <br>
                    <button id="addFilm" class="btn btn-primary">Add Film</button>
                </div>
                
            </div>
            

            <div class="container-fluid mt-3">
                <h1 class="display-4">Movie List</h1>
                <div class="row">
                    <div class="col-6">
                        <div class="row mb-2">
                            <div class="col">
                                <input type="text" id="searchInput" class="form-control w-100" placeholder="Search movie here...">
                            </div>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <div class="dropdown">
                            <button type="button" id="dropdownButton" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                Filter
                            </button>
                            <div class="dropdown-menu p-4">
                                <div class="w-100 d-flex justify-content-center align-items-center">
                                    <div class="form-floating me-3">
                                        <input type="date" class="form-control" id="mulaiFilter" placeholder="Tanggal Mulai">
                                        <label for="mulai">Tanggal Mulai Tayang</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="date" class="form-control" id="akhirFilter" placeholder="Tanggal Akhir">
                                        <label for="akhir">Tanggal Akhir Tayang</label>
                                    </div>
                                </div>
                                <div class="w-100 d-flex align-items-center mt-3">
                                    <div style="width: 100px;">Genre :</div>
                                    <select class="form-select" id="genreFilter">
                                        <option selected value="all">All</option>
                                        <option value="1">Action</option>
                                        <option value="2">Horror</option>
                                        <option value="3">Romance</option>
                                        <option value="4">Family</option>
                                        <option value="5">Comedy</option>
                                        <option value="6">Shounen</option>
                                        <option value="7">Thriller</option>
                                    </select>
                                </div>
                                <div class="w-100 d-flex justify-content-center mt-3">
                                    <button id="saveFilter" class="btn btn-info me-3">Save filter</button>
                                    <button id="resetFilter" class="btn btn-danger">Reset filter</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="filmContainer" class="container-fluid p-3">

            </div>
        </div>
        

        <div class="popup_container">
            <div class="popup" style="overflow-y: auto;">
                <div id="updateContainer" class="container-fluid">

                </div>
            </div>
        </div>
        <script src="ajax.js"></script>
        <script>
            var addButton = document.getElementById("addFilm");
            var filmContainer = document.getElementById("filmContainer");
            var closePopup;
            var mulaiFilter = document.getElementById("mulaiFilter");
            var akhirFilter = document.getElementById("akhirFilter");
            var genreFilter = document.getElementById("genreFilter");

            addButton.addEventListener("click", insertIntoFilm);
            updateFilm();
            function insertIntoFilm(){
                var nama = document.getElementById("namaFilm").value;
                var mulai = document.getElementById("mulai").value;
                var akhir = document.getElementById("akhir").value;
                
                var file_data = $("#gambar").prop("files")[0];   
                var gambar = "";
                if(typeof file_data !== 'undefined'){
                    var gambar = file_data.name;
                    var form_data = new FormData();
                    form_data.append("file", file_data);
                }
                


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
                var ajaxContainer = document.getElementById("messageContainer");
                crud(crudObject, updateFilm, ajaxContainer);
                
                if(typeof file_data !== 'undefined'){
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
            }

            function updateFilm(data){
                var ajaxContainer = document.getElementById("filmContainer");
                if(data == null){
                    var fetchObject = new FetchObject("Ajax_Folder/fetchfilm.php", ajaxContainer, bindFilmAction);
                }else{
                    var fetchObject = new FetchObject("Ajax_Folder/fetchfilm.php", ajaxContainer, bindFilmAction, data);
                }

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
                closePopup = document.getElementById("closePopup");
                closePopup.addEventListener("click", hidePopup);
                updateFilmDataButton.addEventListener("click", updateFilmData);
                changeCheckboxState();
            }

            function updateFilmData(){
                var filmID = document.getElementById("filmID").value;
                var nama = document.getElementById("namaUpdate").value;
                var mulai = document.getElementById("mulaiUpdate").value;
                var akhir = document.getElementById("akhirUpdate").value;
                
                var old = $("#old").val();
                var file_data = $("#gambarUpdate").prop("files")[0];
                if(typeof file_data !== 'undefined'){
                    gambar = file_data.name;
                }else{
                    gambar = old;
                }
                
                var form_data = new FormData();
                form_data.append("file", file_data);
                form_data.append("old", old);
                var trailer = document.getElementById("trailerUpdate").value;
                var sinopsis = document.getElementById("sinopsisUpdate").value;
                var checkbox = document.querySelectorAll(".genreUpdate:checked");
                var genre = [];
                for(var i=0; i<checkbox.length; i++){
                    genreID = checkbox[i].value.split("-")[1];
                    genre.push(genreID);
                    checkbox[i].checked = false;
                }
                var data = `filmID=${filmID}&nama=${nama}&mulai=${mulai}&akhir=${akhir}&gambar=${gambar}&trailer=${trailer}&sinopsis=${sinopsis}&genre=${JSON.stringify(genre)}`;
                var crudObject = new CrudObject("Ajax_Folder/updatefilmdata.php", data);
                var ajaxContainer = document.getElementById("messageContainerUpdate");
                crud(crudObject, confirmationUpdateFilmData, ajaxContainer);

                if(typeof file_data !== 'undefined'){
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
                
            }

            function changeCheckboxState(){
                var checkbox = document.querySelectorAll(".genreUpdate");
                for(var i=0; i<checkbox.length; i++){
                    var status = checkbox[i].value.split("-")[0];
                    if(status == "1"){
                        checkbox[i].checked = true;
                    }
                }
            }

            function confirmationUpdateFilmData(){
                var message = "";
                message = document.getElementById("messageContainerUpdate").innerText;
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

            function filter(){
                var data = `judul=${searchInput.value}&mulai=${mulaiFilter.value}&akhir=${akhirFilter.value}&genre=${genreFilter.value}`;
                updateFilm(data);
            }

            function resetFilterSettings(){
                mulaiFilter.value = "";
                akhirFilter.value = "";
                genreFilter.selectedIndex = 0;
                filter();
            }

            var saveFilterButton = document.getElementById("saveFilter");
            var resetFilterButton = document.getElementById("resetFilter");
            var searchInput = document.getElementById("searchInput");
            
            saveFilterButton.addEventListener("click", filter);
            resetFilterButton.addEventListener("click", resetFilterSettings);
            searchInput.addEventListener("keyup", filter);
        </script>
    </body>
</html>