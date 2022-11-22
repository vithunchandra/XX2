<?php 
    require "../Controller/functions.php";

    $userID = $_POST['userID'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $saldo = $_POST['saldo'];
    $message = "";

    if(!empty($userID) && !empty($username) && !empty($password) && !empty($name) && !empty($email) && !empty($saldo)){
        $isExist = fetchScalar("SELECT EXISTS (SELECT * FROM member WHERE user = '$username' AND id_member != '$userID')");
        if($isExist == '0'){
            crud("UPDATE member SET user = '$username', pass = '$password', nama_member = '$name', email = '$email', saldo = '$saldo' WHERE id_member = '$userID'");
        }else{
            $message = "Username tidak boleh kembar";
        }
    }else{
        $message = "Field tidak boleh kosong";
    }
?>

<?= $message ?>