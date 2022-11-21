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
        <h2>Master User</h2>
        <table id="userContainer" border="1" class="table">

        </table>

        
        <script src="ajax.js"></script>
        <script>
            var userContainer = document.getElementById("userContainer");
            updateUser();
            
            setInterval(500, updateUser);

            function updateUser(){
                var ajaxcontainer = document.getElementById("userContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchuser.php", ajaxcontainer, bindUserDelete);
                fetch(fetchObject);
            }

            function bindUserDelete(){
                listDelete = document.querySelectorAll(".deleteUser");
                for(var i = 0; i < listDelete.length; i++){
                    listDelete[i].addEventListener("click", deleteUser);
                }
            }

            function deleteUser(){
                var data = `userID=${this.value}`;
                var crudObject = new CrudObject("Ajax_Folder/deleteuser.php", data);
                
                crud(crudObject, updateUser);
            }
        </script>
    </body>
</html>