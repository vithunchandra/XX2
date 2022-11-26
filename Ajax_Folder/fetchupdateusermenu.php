<?php 
    require "../Controller/functions.php";

    $userID = $_POST['userID'];
    $userData = fetchData("SELECT * FROM member WHERE id_member = '$userID'")[0];
?>

<h3 class="text-center">Update User</h3>

<div class="container">
    <div class="row text-end">
        <div class="col">
            <label for="idUpdate">ID :</label>
        </div>
        <div class="col">
            <input id="idUpdate" type="text" value="<?= $userData['id_member'] ?>" disabled>
        </div>
    </div>
    <div class="row mt-3 text-end">
        <div class="col">
            <label for="usernameUpdate">Username :</label>
        </div>
        <div class="col">
            <input id="usernameUpdate" type="text" value="<?= $userData['user'] ?>">
        </div>
    </div>
    <div class="row mt-3 text-end">
        <div class="col">
            <label for="passwordUpdate">Password :</label>
        </div>
        <div class="col">
            <input id="passwordUpdate" type="text" value="<?= $userData['pass'] ?>">
        </div>
    </div>
    <div class="row mt-3 text-end">
        <div class="col">
            <label for="nameUpdate">Name :</label>
        </div>
        <div class="col">
            <input id="nameUpdate" type="text" value="<?= $userData['nama_member'] ?>">
        </div>
    </div>
    <div class="row mt-3 text-end">
        <div class="col">
            <label for="emailUpdate" >Email :</label>
        </div>
        <div class="col">
            <input id="emailUpdate" type="text" value="<?= $userData['email'] ?>">
        </div>
    </div>
    <div class="row mt-3 text-end">
        <div class="col">
            <label for="saldoUpdate" >Saldo :</label> <br>
        </div>
        <div class="col">
            <input id="saldoUpdate" type="text" value="<?= $userData['saldo'] ?>"> <br>
        </div>
    </div> <br>
    <span id="messageContainer"></span><br>
    <button id="updateData" class="btn btn-primary">Update User Data</button>
</div>


