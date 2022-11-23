<?php 
    require "../Controller/functions.php";

    $pointRequest = $_POST['saldo'];
    $memberID = $_POST['id_member'];

    echo $memberID;
    $query = "INSERT INTO point_request(id_member, jumlah_point) VALUES('$memberID', '$pointRequest')";
    crud($query);
?>