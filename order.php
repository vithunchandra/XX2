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
      echo "<script>var userNow = ".$_SESSION['login']['id_member']."</script>";
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
    <select id="tanggal">
    </select>
  </div>

  <div id="pilih_sesi" >
    <h3>Sesi</h3>
    <select id="sesi">
    </select>
  </div>

  <button onclick="show_seat()">Ok</button>

  <div id="av_seat"></div>

  <h3>Jumlah Tiket:</h3>
  <input disabled value = 0 id = 'jum_tiket' type="text">

  <button onclick="buy()">Buy!</button>

</body>
</html>

<script>
  var theater = "";
  var seat = [];
  var jumlah_tiket = 0;
  var choosen_seat = [];

  function update_pilih_tgl() {
    theater = document.getElementById('theater').value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;
          var rows = JSON.parse(responseText);

          var pilih_tgl = document.getElementById('pilih_tgl');
          tempHTML = "<h3>Beli Tiket Untuk Tanggal</h3>";
          tempHTML += "<select id = 'tanggal' onchange = 'update_pilih_sesi()'>";

          for(var i = 0;i < rows.length;i++) {
            tempHTML += "<option>"+rows[i]['tgl']+"</option>";
          }
          tempHTML += "</select>";
          
          pilih_tgl.innerHTML = tempHTML;

          update_pilih_sesi();
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_all_broadcast_date=1&theater="+theater + "&film="+movieNow   );
    xhttp.send();
  }

  function update_pilih_sesi() {
    theater = document.getElementById('theater').value;
    var tgl_choosen = document.getElementById('tanggal').value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;
          var rows = JSON.parse(responseText);

          var pilih_sesi = document.getElementById('sesi');
          tempHTML = "<h3>Sesi</h3>";
          tempHTML += "<select id = 'sesi'>";

          for(var i = 0;i < rows.length;i++) {
            tempHTML += "<option value = "+rows[i]['id']+">"+rows[i]['starts'] + " - " + rows[i]['ends'] +"</option>";
          }
          tempHTML += "</select>";
          
          pilih_sesi.innerHTML = tempHTML;
        }
    };
    
    xhttp.open("GET", "Controller/controller_theater.php?get_all_session=1&theater="+theater + "&film="+movieNow +"&date='"+tgl_choosen+"'"  );
    xhttp.send();
  }

      
  
  function show_seat() {
    choosen_seat = [];
    jumlah_tiket = 0;

    theater = document.getElementById('theater').value;
    tanngal = document.getElementById('tanggal').value;
    sesi = document.getElementById('sesi').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;    
          
          var seatRep = JSON.parse(responseText);
          seat = seatRep;

          var tempHTML = "";
          for(var i = 0;i < seat.length;i++) {
            for(var j = 0;j < seat[i].length;j++) {
              tempHTML = tempHTML + "<button onclick = 'choose_seat(this)' value = '"+i+";"+j+"'>"+seat[i][j]+"</button>";
            }
            tempHTML = tempHTML + "<br>";
          }
          document.getElementById('av_seat').innerHTML = tempHTML;
          
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_seat=1&theater="+theater+"&tanggal='"+tanngal+"'&film="+movieNow + "&sesi=" + sesi  );
    xhttp.send();
  }
  
  function choose_seat(e) {
    if(e.innerHTML == 1) {
      jumlah_tiket = jumlah_tiket + 1;
      document.getElementById('jum_tiket').value = jumlah_tiket;  
      e.innerHTML = 0;
      var idx_i = parseInt(e.value.split(';')[0]);
      var idx_j = parseInt(e.value.split(';')[1]);
      choosen_seat.push([idx_i,idx_j]);
    }
  }

  function buy() {
    theater = document.getElementById('theater').value;
    tanngal = document.getElementById('tanggal').value;
    sesi = document.getElementById('sesi').value;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          console.log(xhttp.responseText);
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?buy=1&seat="+JSON.stringify(choosen_seat)+"&theater="+theater + "&tanggal='"+tanngal+"'&film="+movieNow + "&sesi=" + sesi + "&user=" + userNow  );
    xhttp.send();
  }

  update_pilih_tgl();
</script>