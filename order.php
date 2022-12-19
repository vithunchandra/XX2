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
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PhotoFolio Bootstrap Template - Contact</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Cardo:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: PhotoFolio - v1.1.1
  * Template URL: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <!-- ======= Header ======= -->
  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center  me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>XX2</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a id = "point" class="active" href="#">point : </a></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <?php 
          if(isset($_SESSION['login'])) {
              echo '<a href = "#"><form action = "Controller/controller_member.php" method = "POST"><button class="btn btn-info" name = "logout" type = "submit">logout</button></form></a>';
          } else {
              echo '<a href = "login.php"><button class="btn btn-info">Login</button></a>';
          }
        ?>
      </div>
      

    </div>
  </header><!-- End Header -->
  
  

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h2>Order Seat</h2>
            <h3><?= $movie['nama_film'] ?></h3>
          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="row gy-4 justify-content-center">

          <div class="col-lg-2">
            <div class="info-item d-flex">
              <div>
                <h4>Jumlah Tiket:</h4>
                <p id = "jum_tiket">0</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-lg-2">
            <div class="info-item d-flex">
              <div>
                <h4>Total Harga :</h4>
                <p id = "total">0</p>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="row justify-content-center mt-4">

          <div class="col-lg-9">
            <div class="row">
              <div class="form-group mt-3" style="padding:10px;">
                <select onchange="update_pilih_tgl()" name="theater" id="theater"  class="form-select text-white bg-dark" aria-label="Default select example">
                  <option value = "NULL" selected>Choose The Theater!</option>
                  <?php
                    while($row = mysqli_fetch_assoc($option_list)) {
                      echo "<option value = '".$row['id_theater']."'>".$row['nama_theater']."</option>";
                    }
                  ?>
                </select>
              </div>
              <div id = "pilih_tgl" class="col-md-6 form-group">
                <select id="tanggal" onchange="update_pilih_sesi()"  class="form-select text-white bg-dark" aria-label="Default select example">
                  <option selected>Available Date</option>
                </select>
                <!-- <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required> -->
              </div>
              
              <div id = "pilih_sesi" class="col-md-6 form-group mt-3 mt-md-0">
                <select id="sesi" onchange="resetNumber()"  class="form-select text-white bg-dark" aria-label="Default select example">
                  <option selected>Available Session</option>
                </select>
              </div>
            </div>
            
            <div class="text-center" style="padding:10px;"><button class="btn btn-info" onclick="show_seat()" >See Available Seat!</button></div>
            <br>
            <div id="av_seat"></div>

          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>PhotoFolio</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/photofolio-bootstrap-photography-website-template/ -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader">
    <div class="line"></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>

<script>
  var theater = "";
  var seat = [];
  var jumlah_tiket = 0;
  var choosen_seat = [];

  function update_pilih_tgl() {
    document.getElementById('av_seat').innerHTML = "";
    theater = document.getElementById('theater').value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;
          var rows = JSON.parse(responseText);
          // <select id="sesi" onchange="update_pilih_sesi()"  class="form-select text-white bg-dark" aria-label="Default select example">
          //   <option selected>Available Session</option>
          // </select>
          var pilih_tgl = document.getElementById('pilih_tgl');

          var tempHTML = "";
          tempHTML += '<select id="tanggal" onchange="update_pilih_sesi()"  class="form-select text-white bg-dark" aria-label="Default select example">'
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
    document.getElementById('av_seat').innerHTML = "";
    jumlah_tiket = 0;
    document.getElementById('jum_tiket').innerHTML = 0;
    document.getElementById('total').innerHTML = 0;

    theater = document.getElementById('theater').value;
    var tgl_choosen = document.getElementById('tanggal').value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          var responseText = xhttp.responseText;
          var rows = JSON.parse(responseText);
          var pilih_sesi = document.getElementById('pilih_sesi');
          // <select id="sesi" onchange="update_pilih_sesi()"  class="form-select text-white bg-dark" aria-label="Default select example">
          //   <option selected>Available Session</option>
          // </select>
          tempHTML = "";
          tempHTML += '<select id="sesi" onchange="resetNumber()"  class="form-select text-white bg-dark" aria-label="Default select example">';

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

  function resetNumber() {
    document.getElementById('av_seat').innerHTML = "";
    jumlah_tiket = 0;
    document.getElementById('jum_tiket').innerHTML = 0;
    document.getElementById('total').innerHTML = 0;
  }
      
  
  function show_seat() {
    resetNumber();
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
          tempHTML = tempHTML + "<div class='d-flex justify-content-around bg-secondary' style = 'padding:20px;'><h3>Layar</h3></div>";
          for(var i = 0;i < seat.length;i++) {
            tempHTML = tempHTML + "<div class='d-flex justify-content-around' style = 'padding:20px;'>";
            textNow = String.fromCharCode(65 + i);
            for(var j = 0;j < seat[i].length;j++) {
              if(seat[i][j] == 1) {
                tempHTML = tempHTML + "<div onclick = 'choose_seat(this)' ><button class='btn rounded-0 btn-light' value = '"+i+";"+j+"'>"+ textNow+j +"</button></div>";
              } else {
                tempHTML = tempHTML + "<div onclick = 'choose_seat(this)'><button disabled class='btn rounded-0 btn-light' value = '"+i+";"+j+"'>"+ textNow+j +"</button></div>";
              }
              
            }
            tempHTML = tempHTML + "</div>";
          }
          tempHTML = tempHTML + '<div class="d-flex justify-content-center" ><button class="btn btn-success" onclick="buy()">Buy!</button></div>';
          document.getElementById('av_seat').innerHTML = tempHTML;
          
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_seat=1&theater="+theater+"&tanggal='"+tanngal+"'&film="+movieNow + "&sesi=" + sesi  );
    xhttp.send();
  }
  
  function choose_seat(evt) {
    e = evt.firstElementChild;
    if(!e.disabled) {
      jumlah_tiket = jumlah_tiket + 1;
      document.getElementById('jum_tiket').innerHTML = jumlah_tiket;  
      e.disabled = true;
      var idx_i = parseInt(e.value.split(';')[0]);
      var idx_j = parseInt(e.value.split(';')[1]);
      choosen_seat.push([idx_i,idx_j]);

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            document.getElementById('total').innerHTML = (xhttp.responseText*jumlah_tiket).toLocaleString();
          }
      };

      xhttp.open("GET", "Controller/controller_theater.php?get_theater_price=1&theater=" +  document.getElementById('theater').value);
      xhttp.send();
    }else{
      alert("Kursi sudah terisi");
    }
    
  }

  function buy() {
    var uang = parseInt(document.getElementById('point').innerHTML.split(":")[1].replaceAll(",",""));
    var harga = parseInt(document.getElementById('total').innerHTML.replaceAll(",",""));
    //console.log(document.getElementById('point').innerHTML.split(":")[1] + " " + uang + " " + harga);
    //console.log(document.getElementById('point').innerHTML.split(":")[1].replaceAll(",",""));
    
    if(uang >= harga) {
      theater = document.getElementById('theater').value;
      tanngal = document.getElementById('tanggal').value;
      sesi = document.getElementById('sesi').value;
      
      

      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            update_pilih_tgl();
            refreshPoint();
            alert("Pembelian Berhasil!");
          }
      };
      xhttp.open("GET", "Controller/controller_theater.php?buy=1&seat="+JSON.stringify(choosen_seat)+"&theater="+theater + "&tanggal='"+tanngal+"'&film="+movieNow + "&sesi=" + sesi + "&user=" + userNow + "&total=" + harga  );
      xhttp.send();

    }
    else {
      alert('Uang Anda Tidak Cukup!');
    }
  }

  function refreshPoint() {
    var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
            var responseNum = parseInt(xhttp.responseText);
            document.getElementById('point').innerHTML = "point : " + responseNum.toLocaleString();
          }
      };
      xhttp.open("GET", "Controller/controller_member.php?get_point=1&id=" +  userNow);
      xhttp.send();
  }

  refreshPoint();
  // update_pilih_tgl();
  
</script>