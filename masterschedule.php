<?php
    session_start();

    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] != 'admin') {
            header("Location:login.php");
        }
    }

    $filmName = "";
    $filmID = "";
    if(isset($_POST['filmName'])){
        $filmName = $_POST['filmName'];
    }
    if(isset($_POST['filmID'])){
        $filmID = $_POST['filmID'];
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
    </head>
    <body>
        <h1>Welcome Admin</h1>
        <form action="Controller/controller_member.php" method = "POST">
            <button name="logout" type="submit">Logout</button>
            <button name="masterUser" type="submit">Master User</button>
            <button name="masterFilm" type="submit">Master Film</button>
            <button name="masterSchedule" type="submit">Master Schedule</button>
        </form>
        <h2>Master Schedule</h2>
            Film : <input id="filmName" type="text" disabled value=<?= empty($filmName) ? "" : $filmName ?>> <button id="chooseFilm">Choose Film...</button> <br>
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
            <button id="addSchedule">Add Schedule</button>
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
                var fetchObject = new FetchObject("fetchfilmtochoose.php", ajaxContainer, bindFilmChoose);

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
                var data = `filmID=${filmID}&broadcast=${broadcast}&session=${session}`;
                var crudObject = new CrudObject("insertIntoSchedule.php", data);
                var ajaxContainer = document.getElementById("messageContainer");
                crud(crudObject, updateSchedule, ajaxContainer);
            }

            function updateSchedule(){
                var ajaxContainer = document.getElementById("schedulContainer");
                var fetchObject = new FetchObject("fetchschedule.php", ajaxContainer, bindSchedule);

                fetch(fetchObject, bindSchedule);
            }

            function bindSchedule(){
                listDelete = document.querySelectorAll(".deleteSchedule");
                for(var i=0; i<listDelete.length; i++){
                    listDelete[i].addEventListener("click", deleteSchedule);
                }
            }

            function deleteSchedule(){
                var data = `scheduleID=${this.value}`;
                var crudObject = new CrudObject("deleteschedule.php", data);
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