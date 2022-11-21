<?php
    require "../Controller/functions.php";

    $userID = $_POST['userID'];
    crud("UPDATE member SET status = 0 WHERE id_member = '$userID'");
?>