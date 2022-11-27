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
            <button name="masterFilm" type="submit" class="btn btn-primary">Master Film</button>
            <button name="masterSchedule" type="submit" class="btn btn-outline-primary">Master Schedule</button>
        </form>
        <h2>Master Schedule</h2>
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
        <?php 
            for($i=0; $i<6; $i++){
                $dt = new DateTime($monday);
                $dt->modify('+'.$i.' day'); ?>
                
                <input type="radio" class="btn-check" name="btnradio<?= '-'.$i ?>" id="btnradio<?= '-'.$i ?>" autocomplete="off" value="<?= $dt ?>" checked>
                <label class="btn btn-outline-primary" for="btnradio<?= '-'.$i ?>">Radio 1</label>
                
            <?php } ?>
        </div>

        <!-- Film : <input id="filmName" type="text" disabled value=<?= empty($filmName) ? "" : $filmName ?>> <button id="chooseFilm">Choose Film...</button> <br>
        <input id="filmID" type="text" hidden value=<?= empty($filmID) ? "" : $filmID ?>> <br>
        Broadcast Date : <input type="date" id="broadcast"> <br>
        Sesi : <select name="session" id="session">
            <option value="1">09:30:00 - 12:00:00</option>
            <option value="2">12:30:00 - 15:00:00</option>
            <option value="3">15:30:00 - 18:00:00</option>
            <option value="4">18:30:00 - 21:00:00</option>
            <option value="5">21:30:00 - 23:00:00</option>
        </select><br>
        <span id="messageContainer"></span> <br>
        <button id="addSchedule">Add Schedule</button> -->
        <h3>Schedule List</h3>
        <table id="schedulContainer" border="1" class="table">

        </table>

        <div class="popup_container">
            <div class="popup">
                <Button id="closePopup">Close</Button>
                <table id="filmContainer" border="1" class="table">

                </table>
            </div>
        </div>
        <script src="ajax.js"></script>
        <script>
            var chooseFilm = document.getElementById("chooseFilm");
            var closePopup = document.getElementById("closePopup");
            var addSchedule = document.getElementById("addSchedule");

            function chooseFilmPopUp(){
                var pop = document.querySelector(".popup_container");
                pop.style.display = "flex";
                updateFilm();
            }

            function closeChooseFilmPopup(){
                var pop = document.querySelector(".popup_container");
                pop.style.display = "none";
            }

            function updateFilm(){
                var ajaxContainer = document.getElementById("filmContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchfilmtochoose.php", ajaxContainer, bindFilmChoose);

                fetch(fetchObject);
            }

            function bindFilmChoose(){
                var listChoose = document.querySelectorAll(".chooseFilm");
                for(var i=0; i<listChoose.length; i++){
                    listChoose[i].addEventListener("click", getFilm);
                }
            }

            function insertIntoSchedule(){
                var filmID = document.getElementById("filmID").value;
                var broadcast = document.getElementById("broadcast").value;
                var session = document.getElementById("session").value;
                document.getElementById("filmName").value = "";
                document.getElementById("filmID").value = "";
                document.getElementById("broadcast").value = "";
                document.getElementById("session").value = "";
                var data = `filmID=${filmID}&broadcast=${broadcast}&session=${session}`;
                var crudObject = new CrudObject("Ajax_Folder/insertIntoSchedule.php", data);
                var ajaxContainer = document.getElementById("messageContainer");
                crud(crudObject, updateSchedule, ajaxContainer);
            }

            function updateSchedule(){
                var ajaxContainer = document.getElementById("schedulContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchschedule.php", ajaxContainer, bindSchedule);

                fetch(fetchObject, bindSchedule);
            }

            function bindSchedule(){
                var listDelete = document.querySelectorAll(".deleteSchedule");
                for(var i=0; i<listDelete.length; i++){
                    listDelete[i].addEventListener("click", deleteSchedule);
                }

                var listCheckBox = document.querySelectorAll(".theater");
                for(var i=0; i<listCheckBox.length; i++){
                    listCheckBox[i].addEventListener("change", selectTheatre);
                    var rawData = listCheckBox[i].value.split("-");
                    var status = rawData[2];
                    if(status == 1){
                        listCheckBox[i].checked = true;
                    }else{
                        listCheckBox[i].checked = false;
                    }
                }
            }

            function selectTheatre(){
                var rawData = this.value.split("-");
                var theaterID = rawData[0];
                var scheduleID = rawData[1];
                var data = `theaterID=${theaterID}&scheduleID=${scheduleID}`;
                var crudObject = new CrudObject("Ajax_Folder/theatercheckbox.php", data);
                crud(crudObject);
            }

            function deleteSchedule(){
                var data = `scheduleID=${this.value}`;
                var crudObject = new CrudObject("Ajax_Folder/deleteschedule.php", data);
                crud(crudObject, updateSchedule);
            }

            function getFilm(){
                var value = this.value;
                var fields = value.split('-');
                var id = fields[0];
                var name = fields[1];
                document.getElementById("filmName").value = name;
                document.getElementById("filmID").value = id;
                closeChooseFilmPopup();
            }

            chooseFilm.addEventListener("click", chooseFilmPopUp);
            closePopup.addEventListener("click", closeChooseFilmPopup);
            addSchedule.addEventListener("click", insertIntoSchedule);

            updateSchedule();
            setInterval(updateSchedule, 500);
        </script>
    </body>
</html>