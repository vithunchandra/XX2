<?php
    session_start();

    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] != 'admin') {
            header("Location:login.php");
        }
    }

    $monday = date("Y-m-d", strtotime("monday this week"));
    $sunday = date("Y-m-d", strtotime("sunday this week"));

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

        <style>
            table {
                table-layout: fixed;
                width: 100%;
            }

            th, td{
                width: 210px;
                overflow: hidden;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center">Welcome Admin</h1>
        <form action="Controller/controller_member.php" method = "POST" class="text-center">
            <button name="logout" type="submit" class="btn btn-outline-primary">Logout</button>
            <button name="masterUser" type="submit" class="btn btn-outline-primary">Master User</button>
            <button name="masterFilm" type="submit" class="btn btn-outline-primary">Master Film</button>
            <button name="masterSchedule" type="submit" class="btn btn-primary">Master Schedule</button>
        </form>
        <h2>Master Schedule</h2>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <?php 
            for($i=0; $i<7; $i++){
                $dt = new DateTime($monday);
                $dt->modify('+'.$i.' day'); 
                $time = $dt->format("Y-m-d"); ?>
                
                <input type="radio" class="btn-check day-button" name="btnradio" id="btnradio<?= '-'.$i ?>" autocomplete="off" value="<?= $time ?>">
                <label class="btn btn-outline-primary" for="btnradio<?= '-'.$i ?>"><?= $dt->format("l") ?></label>
                
            <?php } ?>
        </div>
        <table id="schedule-table" border="1px" class="table align-middle text-center mt-4">

        </table>

        <div class="popup_container">
            <div class="popup" style="overflow-y: auto; width: 80%;">
                <button id="closePopup" class="btn btn-danger position-absolute top-0 end-0" style="border-radius: 0px; border-top-right-radius: 10px;">X</button>
                <div id="filmContainer" class="container-fluid">

                </div>
            </div>
        </div>

        <script src="ajax.js"></script>
        <script>
            var buttonRadio = document.querySelectorAll(".day-button");
            var selectedSession , selectedTheater;
            var closePopupButton = document.getElementById("closePopup");

            function bindButtonRadio(){
                for(var i=0; i<buttonRadio.length; i++){
                    buttonRadio[i].addEventListener("change", getSchedule);
                }
            }

            function getSchedule(){
                var data = `date=${document.querySelector("input[name='btnradio']:checked").value}`;
                var ajaxContainer = document.getElementById("schedule-table");
                var fetchObject = new FetchObject("Ajax_Folder/fetch_schedule.php", ajaxContainer, bindScheduleAction, data);
                fetch(fetchObject);
            }

            function bindScheduleAction(){
                var chooseButton = document.querySelectorAll(".choose-film");
                var deleteButton = document.querySelectorAll(".delete-film");

                for(var i=0; i<chooseButton.length; i++){
                    chooseButton[i].addEventListener("click", showPopUp);
                }

                for(var i=0; i<deleteButton.length; i++){
                    deleteButton[i].addEventListener("click", deleteSchedule);
                }
            }

            function showPopUp(){
                var pop = document.querySelector(".popup_container");
                pop.style.display = "flex";
                var rawdata = this.value.split("-");
                var id_theater = rawdata[0];
                var id_session = rawdata[1];
                var data = `id_theater=${id_theater}&id_session=${id_session}`;

                showFilm(data);
            }

            function closePopup(){
                var pop = document.querySelector(".popup_container");
                pop.style.display = "none";
                getSchedule();
            }

            function showFilm(data){
                var ajaxContainer = document.getElementById("filmContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchfilmtochoose.php", ajaxContainer, bindFilmChoose, data);

                fetch(fetchObject);
            }

            function bindFilmChoose(){
                var chooseFilmButton = document.querySelectorAll(".chooseFilm");
                for(var i=0; i<chooseFilmButton.length; i++){
                    chooseFilmButton[i].addEventListener("click", addSchedule);
                }
            }

            function addSchedule(){
                var rawdata = this.value.split("-");
                var id_theater = rawdata[0];
                var id_session = rawdata[1];
                var id_film = rawdata[2];
                var date = document.querySelector("input[name='btnradio']:checked").value;
                var data = `id_theater=${id_theater}&id_session=${id_session}&id_film=${id_film}&date=${date}`;
                var crudObject = new CrudObject("Ajax_Folder/add_schedule.php", data);
                crud(crudObject, closePopup);
            }

            function deleteSchedule(){
                var rawdata = this.value.split("-");
                var id_theater = rawdata[0];
                var id_schedule = rawdata[1];
                var data = `id_theater=${id_theater}&id_schedule=${id_schedule}`;
                var crudObject = new CrudObject("Ajax_Folder/delete_schedule.php", data);
                crud(crudObject, getSchedule);
            }

            bindButtonRadio();
            buttonRadio[0].checked = true;
            buttonRadio[0].dispatchEvent(new Event("change", {bubbles:true}));
            closePopupButton.addEventListener("click", closePopup);
        </script>
    </body>
</html>