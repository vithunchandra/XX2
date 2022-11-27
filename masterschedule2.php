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
    </body>

    <table id="schedule-table" border="1px" class="table">

    </table>

    <div class="popup_container">
        <div class="popup" style="overflow-y: auto;">
            <div id="updateContainer" class="container-fluid">

            </div>
        </div>
    </div>

    <script src="ajax.js"></script>
    <script>
        var buttonRadio = document.querySelectorAll(".day-button");
        var selectedSession , selectedTheater;

        function bindButtonRadio(){
            for(var i=0; i<buttonRadio.length; i++){
                buttonRadio[i].addEventListener("change", getSchedule);
            }
        }

        function getSchedule(){
            var data = `date=${this.value}`;
            var ajaxContainer = document.getElementById("schedule-table");
            var fetchObject = new FetchObject("Ajax_Folder/fetch_schedule2.php", ajaxContainer, bindScheduleAction, data);
            fetch(fetchObject);
        }

        function bindScheduleAction(){
            var chooseButton = document.querySelectorAll(".choose-film");
            var deleteButton = document.querySelectorAll(".delete-film");

            for(var i=0; i<chooseButton.length; i++){
                chooseButton[i].addEventListener("click", showFilm);
            }

            for(var i=0; i<deleteButton.length; i++){
                deleteButton[i].addEventListener("click", deleteSchedule);
            }
        }

        function showFilm(){
            var rawdata = this.value.split("-");
            var id_theater = rawdata[0];
            var id_session = rawdata[1];
            var data = `id_theater=${id_theater}&id_session=${id_session}`;
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
            var data = `id_theater=${id_theater}&id_session=${id_session}&id_film=${id_film}`;
            var crudObject = new CrudObject("")
        }

        function deleteSchedule(){

        }

        bindButtonRadio();

        buttonRadio[0].checked = true;
        buttonRadio[0].dispatchEvent(new Event("change", {bubbles:true}));
    </script>
</html>