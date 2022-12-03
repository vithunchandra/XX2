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
    </head>
    <body>
        <h1 class="text-center">Welcome Admin</h1>
        <form action="Controller/controller_member.php" method = "POST" class="text-center">
            <button name="logout" type="submit" class="btn btn-outline-primary">Logout</button>
            <button name="masterUser" type="submit" class="btn btn-outline-primary">Master User</button>
            <button name="masterFilm" type="submit" class="btn btn-outline-primary">Master Film</button>
            <button name="masterSchedule" type="submit" class="btn btn-outline-primary">Master Schedule</button>
            <button name="masterReport" type="submit" class="btn btn-primary">Master Report</button>
        </form>
        <h2>Master Report</h2>
        <table id="report-table" border="1" class="table align-middle text-center mt-4 shadow"></table>
    </body>


    <script src="ajax.js"></script>
    <script>
        
        function fetchReport(){
            var ajaxContainer = document.getElementById("report-table");
            var fetchObject = new FetchObject("Ajax_Folder/fetch_report.php", ajaxContainer, bindDateSearch);
            fetch(fetchObject);
        }

        function bindDateSearch(){
            listReport = document.querySelectorAll(".pilih-tanggal");
            for(var i=0; i<listReport.length; i++){
                listReport[i].addEventListener("change", fetchSpecificDate);
            }
        }

        function fetchSpecificDate(){
            var row = this.parentNode.parentNode.parentNode;
            var id_film = this.previousElementSibling.value;
            var data = `id_film=${id_film}&date=${this.value}`;
            var fetchObject = new FetchObject("Ajax_Folder/fetch_specific_date_report.php", row, bindDateSearch, data);
            fetch(fetchObject);
        }

        fetchReport();
    </script>
</html>