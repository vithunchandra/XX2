<?php
    require('connect.php');

    if(isset($_POST['register'])) {

        if($_POST['nama'] == "" || $_POST['email'] == "" || $_POST['user'] == "" || $_POST['pass'] == "" ) {
            header("Location:../register.php?err='Pastikan Seluruh Field Telah Terisi!'");
        }
        else if($_POST['pass'] != $_POST['confpass']) {
            header("Location:../register.php?err='Password dan confirm password harus sama!'");
        }
        else {
            $p = md5($_POST['pass']);
            $sql = "INSERT INTO `member`( `nama_member`, `email`, `user`, `pass`, `saldo`) 
            VALUES ('".$_POST['nama']."','".$_POST['email']."','".$_POST['user']."','".$p."',0)";
            $conn->query($sql);
            
            header("Location:../login.php");
        }
    }

    if(isset($_POST['login'])) {
        
        if($_POST['user'] == 'admin' && $_POST['pass']== 'admin') {
            $_SESSION['login'] = "admin";
            header("Location:../admin.php");
        } 
        else {
            $p = $_POST['pass'];
            $p = md5($p);
            $sql = "SELECT * FROM `member` 
            WHERE (user = '".$_POST['user']."' or email = '" .$_POST['user']. "') and pass = '".$p."' and status = 1 ";
            
            $result = $conn->query($sql);
            
            $counter = 0;
            while($row = mysqli_fetch_assoc($result)) {
                $_SESSION['login'] = $row;
                $counter = $counter + 1;
                header("Location:../index.php");
            }
            if($counter == 0) {
                header("Location:../login.php?err='Pastikan Username dan Password Sudah Benar'");
            }
        }
        
    }

    if(isset($_GET['get_point'])) {
        $member = $_GET['id'];
        $sql= "SELECT saldo from member where id_member= $member";
        $saldo = fetch($sql)[0]['saldo'];
        echo $saldo;
    }

    if(isset($_GET['request_point'])) {
        $jumlah = $_GET['jumlah'];
        $user = $_GET['id_user'];
        $sql = "INSERT INTO `point_request`(`id_member`, `jumlah_point`, `status`) 
        VALUES ($user,$jumlah,1)";
        $conn->query($sql);
        echo "order sucess!";
    }

    if(isset($_POST['logout'])) {
        unset($_SESSION['login']);
        header("Location:../index.php");
    }
    if(isset($_POST['masterFilm'])){
        header("Location: ../masterfilm.php");
    }elseif(isset($_POST['masterUser'])){
        header("Location: ../admin.php");
    }elseif(isset($_POST['masterSchedule'])){
        header("Location: ../masterschedule.php");
    }elseif(isset($_POST['masterReport'])){
        header("Location: ../master_report.php");
    }
?>