<?php
  require('Controller/connect.php');

  $movie = "";
  if(isset($_GET['id'])) {
    if(isset($_SESSION['login'])) {
      $sql = "Select * from film where id_film = " . $_GET['id'];
      $movie = mysqli_fetch_assoc($conn->query($sql));

      $sql_option = "Select id_theater,nama_theater from theater where 1";
      $option_list = $conn->query($sql_option);

      echo "<script>var movieNow = ".$_GET['id']."</script>";
    } else {
      header("Location:login.php?err='Anda harus login terlebih dahulu'");
    }
  }
  else {
    header("Location:index.php");
  }
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <button><a href = "index.php">Back</a></button>  
  <hr>

  <h1><?= $movie['nama_film'] ?></h1>

  <h3>Pilih Theater:</h3>
  <select onchange="update_pilih_tgl()" name="theater" id="theater">
    <?php
      while($row = mysqli_fetch_assoc($option_list)) {
        echo "<option value = '".$row['id_theater']."'>".$row['nama_theater']."</option>";
      }
    ?>
  </select>
  
  <div id="pilih_tgl" >
    <h3>Beli Tiket Untuk Tanggal</h3>
    <select name="tanggal" id="tanggal">
    </select>
    
  </div>


  <h3>Jumlah Tiket:</h3>
  <input id = 'jum_tiket' type="text">
  <button onclick="show_seat()">Ok</button>
</body>
</html>

<script>
  var theater = "";
  var jumlah_tiket = 0;
  var choosen_seat = -1;

  function update_pilih_tgl() {
    theater = document.getElementById('theater').value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;
          var rows = JSON.parse(responseText);

          var pilih_tgl = document.getElementById('pilih_tgl');
          tempHTML = "<h3>Beli Tiket Untuk Tanggal</h3>";
          tempHTML += "<select>";

          for(var i = 0;i < rows.length;i++) {
            tempHTML += "<option>"+rows[i]['tgl']+"</option>";
          }
          tempHTML += "</select>";
          
          pilih_tgl.innerHTML = tempHTML;
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_all_broadcast_date=1&theater="+theater + "&film="+movieNow   );
    xhttp.send();
  }

      
  
  function show_seat() {
    theater = document.getElementById('theater').value;
    jumlah_tiket = document.getElementById('jum_tiket').value;
    tanngal = document.getElementById('tanngal').value;
    movieNow = <?="'".$movie['id_film']."'"?>
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;
          
          console.log(responseText);
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_seat=1&theater="+theater+"&tanggal='"+tanngal+"'&film="+movieNow   );
    xhttp.send();
  }
  
  update_pilih_tgl();
</script>