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
            <button name="masterUser" type="submit" class="btn btn-primary">Master User</button>
            <button name="masterFilm" type="submit" class="btn btn-outline-primary">Master Film</button>
            <button name="masterSchedule" type="submit" class="btn btn-outline-primary">Master Schedule</button>
            <button name="masterReport" type="submit" class="btn btn-outline-primary">Master Report</button>
        </form>
        <h2>Master User</h2>
        <button id="user_menu" class="btn btn-success">User Menu</button> <button id="point_menu" class="btn btn-success">Point Menu</button>
        <div class="m-4"></div>
        <table id="ajaxContainer" border="1" class="table table-stripped text-center table-hover">

        </table>

        <div class="popup_container">
            <div class="popup text-center">
                <img src="Assets/close.png" class="close-button" id="closePopup">
                <div id="updateContainer" class="container-fluid" style="width: 500px;">

                </div>
            </div>
        </div>
        <script src="ajax.js"></script>
        <script>
            var ajaxContainer = document.getElementById("ajaxContainer");
            var closePopupButton = document.getElementById("closePopup");
            var userMenu = document.getElementById("user_menu");
            var pointMenu = document.getElementById("point_menu");
            var userMenuInterval, pointMenuInterval;
            
            function showUserMenu(){
                updateUser();
                userMenuInterval = setInterval(updateUser, 500);
                clearInterval(pointMenuInterval); 
            }

            function showPointMenu(){
                updatePoint();
                pointMenuInterval = setInterval(updatePoint, 500);
                clearInterval(userMenuInterval);
            }

            function updatePoint(){
                var fetchObject = new FetchObject("Ajax_Folder/fetch_point_request.php", ajaxContainer, bindPointAction);
                fetch(fetchObject);
            }

            function bindPointAction(){
                var listPointRequestAccept = document.querySelectorAll(".accept-button");
                for(var i = 0; i < listPointRequestAccept.length; i++){
                    listPointRequestAccept[i].addEventListener("click", acceptPointRequest);
                }

                var listPointRequestCancel = document.querySelectorAll(".cancel-button");
                for(var i = 0; i < listPointRequestCancel.length; i++){
                    listPointRequestAccept[i].addEventListener("click", cancelPointRequest);
                }
            }

            function acceptPointRequest(){
                alert("Test");
                var data = `id_point_request=${this.value}&value=1`;
                var crudObject = new CrudObject("Ajax_Folder/point_request_action.php", data);
                
                crud(crudObject);
            }

            function cancelPointRequest(){
                var data = `id_point_request=${this.value}&value=0`;
                var crudObject = new CrudObject("Ajax_Folder/point_request_action.php", data);
                
                crud(crudObject);
            }

            function updateUser(){
                var fetchObject = new FetchObject("Ajax_Folder/fetchuser.php", ajaxContainer, bindUserDelete);
                fetch(fetchObject);
            }

            function bindUserDelete(){
                var listDelete = document.querySelectorAll(".deleteUser");
                for(var i = 0; i < listDelete.length; i++){
                    listDelete[i].addEventListener("click", deleteUser);
                }

                var listupdate = document.querySelectorAll(".updateUser");
                for(var i = 0; i < listupdate.length; i++){
                    listupdate[i].addEventListener("click", showPopup);
                }
            }

            function deleteUser(){
                var data = `userID=${this.value}`;
                var crudObject = new CrudObject("Ajax_Folder/deleteuser.php", data);
                
                crud(crudObject, updateUser);
            }

            function fetchUpdateMenu(data){
                var ajaxContainer = document.getElementById("updateContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchupdateusermenu.php", ajaxContainer, bindUpdateDataButton, data);
                
                fetch(fetchObject);
            }

            function bindUpdateDataButton(){
                var updateButton = document.getElementById("updateData");
                updateButton.addEventListener("click", updateData);
            }

            function updateData(){
                var userID = document.getElementById("idUpdate").value;
                var username = document.getElementById("usernameUpdate").value;
                var password = document.getElementById("passwordUpdate").value;
                var name = document.getElementById("nameUpdate").value;
                var email = document.getElementById("emailUpdate").value;
                var saldo = document.getElementById("saldoUpdate").value;
                var messageContainer = document.getElementById("messageContainer");

                var data = `userID=${userID}&username=${username}&password=${password}&name=${name}&email=${email}&saldo=${saldo}`;
                var crudObject = new CrudObject("Ajax_Folder/updateuserdata.php", data);
                crud(crudObject, confirmationUpdateUserData, messageContainer);
            }

            function confirmationUpdateUserData(){
                var message = "";
                message = document.getElementById("messageContainer").innerText;
                alert(message);
                if(message.length == 0){
                    hidePopup();
                }
            }

            function showPopup(){
                var data = `userID=${this.value}`;
                var popup = document.querySelector(".popup_container");
                popup.style.display = "flex";

                fetchUpdateMenu(data);
            }
            
            function hidePopup(){
                var popup = document.querySelector(".popup_container");
                popup.style.display = "none";
                updateUser();
            }

            userMenu.addEventListener("click", showUserMenu);
            pointMenu.addEventListener("click", showPointMenu);
            closePopupButton.addEventListener("click", hidePopup);
            
            updateUser();
        </script>
    </body>
</html>