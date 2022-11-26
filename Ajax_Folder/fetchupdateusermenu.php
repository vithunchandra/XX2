<?php 
    require "../Controller/functions.php";

    $userID = $_POST['userID'];
    $userData = fetchData("SELECT * FROM member WHERE id_member = '$userID'")[0];
?>

<h3 class="text-center">Update User</h3>

<div class="form-floating mb-3">
    <input type="text" class="form-control" id="idUpdate" value="<?= $userData['id_member'] ?>" placeholder="ID">
    <label for="idupdate">ID</label>
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="usernameUpdate" value="<?= $userData['user'] ?>" placeholder="Username">
    <label for="usernameUpdate">Username</label>
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="passwordUpdate" value="<?= $userData['pass'] ?>" placeholder="Password">
    <label for="passwordUpdate">Password</label>
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="nameUpdate" value="<?= $userData['nama_member'] ?>" placeholder="Nama">
    <label for="nameUpdate">Nama</label>
</div>
<div class="form-floating mb-3">
    <input type="text" class="form-control" id="emailUpdate" value="<?= $userData['email'] ?>" placeholder="Email">
    <label for="emailUpdate">Email</label>
</div>
<div class="form-floating">
    <input type="text" class="form-control" id="saldoUpdate" value="<?= $userData['saldo'] ?>" placeholder="Saldo">
    <label for="saldoUpdate">Saldo</label>
</div> <br>

<span id="messageContainer"></span><br>
<button id="updateData" class="btn btn-primary">Update User Data</button>


