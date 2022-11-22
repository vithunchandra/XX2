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

        <div class="popup_container">
            <div class="popup">
                <Button id="closePopup">Close</Button>
                <div id="updateContainer">

                </div>
            </div>
        </div>
        <script src="ajax.js"></script>
        <script>
            var userContainer = document.getElementById("userContainer");
            var closePopupButton = document.getElementById("closePopup");
            updateUser();
            
            setInterval(updateUser, 500);

            function updateUser(){
                var ajaxcontainer = document.getElementById("userContainer");
                var fetchObject = new FetchObject("Ajax_Folder/fetchuser.php", ajaxcontainer, bindUserDelete);
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


            closePopupButton.addEventListener("click", hidePopup);
        </script>
    </body>
</html>