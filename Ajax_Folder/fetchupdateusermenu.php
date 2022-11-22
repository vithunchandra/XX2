<?php 
    require "../Controller/functions.php";

    $userID = $_POST['userID'];
    $userData = fetchData("SELECT * FROM member WHERE id_member = '$userID'")[0];
?>

ID : <input id="idUpdate" type="text" value="<?= $userData['id_member'] ?>" disabled> <br>
Username : <input id="usernameUpdate" type="text" value="<?= $userData['user'] ?>"> <br>
Password : <input id="passwordUpdate" type="text" value="<?= $userData['pass'] ?>"> <br>
Name : <input id="nameUpdate" type="text" value="<?= $userData['nama_member'] ?>"> <br>
Email : <input id="emailUpdate" type="text" value="<?= $userData['email'] ?>"> <br>
Saldo : <input id="saldoUpdate" type="text" value="<?= $userData['saldo'] ?>"> <br>
<span id="messageContainer"></span>
<button id="updateData">Update User Data</button>