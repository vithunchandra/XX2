<?php 
    require "../Controller/functions.php";

    $idPointRequest = $_POST['id_point_request'];
    $status = $_POST['value'];
    $jumlah = fetchScalar("SELECT jumlah_point FROM point_request WHERE id_request = '$idPointRequest'");

    if($status){
        $memberID = fetchScalar("SELECT id_member FROM point_request WHERE id_request = '$idPointRequest'");
        crud("UPDATE member SET saldo = saldo + '' WHERE id_member = '$memberID'");
    }
    crud("UPDATE point_request SET status = 0 WHERE id_request = '$idPointRequest'");
?>