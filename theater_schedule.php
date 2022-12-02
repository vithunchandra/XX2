<?php
  require("Controller/connect.php");
  $theaterList = fetch("select * from theater order by id_theater asc");
  echo "<script>var allTheater = JSON.parse('" . json_encode($theaterList) . "')</script>";
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PhotoFolio Bootstrap Template - About</title>
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
  
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- my import -->
  <script src = "bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
  <script src = "jquery-3.6.1.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#myModal').modal('show');
    });
    
    function openModal() {
      $('#myModal').modal('show');
    }
  </script>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>

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
          
          <li><button onclick="openModal()"  class="btn btn-success">Choose Theater</button></li>
        </ul>
      </nav><!-- .navbar -->

      <div class="header-social-links">
        <?php 
        if(isset($_SESSION['login'])) {
            echo '<a href = "#"><button class="btn btn-info" data-toggle="modal" data-target="#exampleModal">Top Up</button></a>';
            echo '<a href = "#"><form action = "Controller/controller_member.php" method = "POST"><button class="btn btn-info" name = "logout" type = "submit">logout</button></form></a>';
        } else {
            echo '<a href = "login.php"><button class="btn btn-info">Login</button></a>';
        }
        ?>
        
        
      </div>

      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= End Page Header ======= -->
    <div class="page-header d-flex align-items-center">
      <div class="container position-relative">
        <div class="row d-flex justify-content-center">
          <div class="col-lg-6 text-center">
            <h3>Movie Schedule</h3>
            <div class="part1">
              <h5><label id = 'title'></label> </h5>
              <h5><label id = 'ukuran'></label></h5>
              <h5><label id = 'harga'></label> </h5>
              <h5><label id = 'desc'></label> </h5>
            </div>

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->
    <div class="container">
      <div id="schedule"></div>
    </div>

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

  


  <!-- Modal -->
  <div class="modal fade " id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content  bg-dark">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Choose Theater!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select class="form-select bg-dark text-white" name="theater_select" id="theater_select">
            <?php
              for($i = 0;$i < count($theaterList);$i++) {
                echo "<option value = ".$theaterList[$i]['id_theater'].">".$theaterList[$i]['nama_theater']."</option>";
              }
            ?>
          </select>
        </div>
        <div class="modal-footer">
          <button onclick = "load_page()" type="button" class="btn btn-secondary" data-bs-dismiss="modal">Choose</button>
        </div>
      </div>
    </div>
  </div>

</body>

</html>

<script>

  function load_page() {
    var sel = document.getElementById('theater_select').value - 1;
    document.getElementById('title').innerHTML = allTheater[sel]['nama_theater'] ;
    document.getElementById('ukuran').innerHTML = "Ukuran : " + allTheater[sel]['width'] + " x " +  allTheater[sel]['height'];
    document.getElementById('harga').innerHTML = "Harga : Rp." + allTheater[sel]['harga'] ;
    document.getElementById('desc').innerHTML = allTheater[sel]['description'] ;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          //summary.innerHTML = summary.innerHTML + xhttp.responseText;
          
          var responseNow = JSON.parse(xhttp.responseText);
          console.log(responseNow);

          var tempHTML = "";
          if(responseNow.length > 0 ) {
            var tempDate = responseNow[0]['broadcast_date'];
            tempHTML += "<div class = 'row'>"
            tempHTML += "<hr><h5>"+tempDate+"</h5><hr>";
            for(var i = 0;i < responseNow.length;i++) {
              if(responseNow[i]['broadcast_date'] != tempDate) {
                tempHTML += "</div>"
                tempDate = responseNow[i]['broadcast_date'];
                tempHTML += "<h5>"+tempDate+"</h5><hr>";
                tempHTML += "<div class = 'row'>"
              }
              tempHTML += '<div class="card bg-dark" style="width: 18rem;float:left;">';
                tempHTML += '<img width = "200px" height = "300px" class="card-img-top" src="Gambar/' + responseNow[i]['image_path'] +'" alt="'+responseNow[i]['nama_film']+'">';
                tempHTML += '<div class="card-body">';
                  tempHTML += '<h5 class="card-title">'+ responseNow[i]['nama_film'] +'</h5>';
                  tempHTML += '<h5>'+responseNow[i]['session_start'] + " - " + responseNow[i]['session_end'] +'</h5>'
                  tempHTML += '<a  href="detail_film.php?id='+responseNow[i]['id_film']+' " class="btn btn-primary">Detail</a>';
                tempHTML += '</div>';
              tempHTML += '</div>';
            }
            tempHTML += "</div>";
            
          }
          
          console.log(tempHTML);
          document.getElementById('schedule').innerHTML = tempHTML;
          
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_all_film_theater=1&id_theater=" + (sel + 1)  );
    xhttp.send();

  }


 
</script>