<?php
    session_start();

    $userData = "";
    if(isset($_SESSION['login'])) {
        if($_SESSION['login'] == 'admin') {
            header("Location:admin.php");
        }else{
            $userData = $_SESSION['login'];
            echo "<script>var id_member = ". $userData['id_member'] .";</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PhotoFolio Bootstrap Template - Index</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

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
  <!-- <link rel = "stylesheet" href = "mycss.css"> -->

  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


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
        <!-- <i class="bi bi-camera"></i> -->
        <h1>XX2</h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          
          <li><a onclick="now_playing()" href="#">Now Playing</a></li>
          <li><a onclick="upcoming()" href="#">Upcoming</a></li>
          <li><a href="theater_schedule.php">Schedule</a></li>
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

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex flex-column justify-content-center align-items-center" data-aos="fade" data-aos-delay="1500">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-6 text-center">
          <h2>Welcome To XX2</h2>
          <h3 id = 'title'></h3>
          <input placeholder="Search Title" onchange="search()" id = "search_key" type="text">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main" data-aos="fade" data-aos-delay="1500">

    <!-- ======= Gallery Section ======= -->
    <section id="gallery" class="gallery">
      <div class="container-fluid">
        <div id = 'movie_list'></div>
      </div>
    </section><!-- End Gallery Section -->

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

  <!-- start animation -->
  <div id="preloader">
    <div class="line"></div>
  </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Top Up</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="topup_popup" class="popup_container">
            <div class="popup">
                <div class="d-flex flex-wrap w-100" style="color:black;">
                    <div class="w-33 text-center">
                        <h2 style = 'text-align:center;'>Top Up</h2>
                    </div>
                    <div class="w-33 text-center">
                        <img src="Assets/point.png" class="w-50">
                    </div>
                    <div class="w-33 text-center" style="margin-left: auto;margin-right: auto;">
                        <input type="text" id = 'jumlah_req'>
                    </div>
                </div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button onclick="requestPoint()" type="button" class="btn btn-primary" data-dismiss="modal">Order</button>
      </div>
    </div>
  </div>
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
    var is_now_playing = 1;
    // var id_member = document.getElementById("id_member").value;

    function refresh(responseNow) {
        var movie_list = document.getElementById('caraousel-ajax');
        var indicators = document.getElementById("indicators");
        movie_list.innerHTML = "";

        var refreshContent = '';
        for(var i=0; i<responseNow.length; i++) {
            var data = "data-bs-slide-to=" + (i) + "";
            if(i == 0){
                data += " Class=active";
            }
            indicators.innerHTML += '<button type="button" data-bs-target="#carouselExampleCaptions" '+ data +'></button>';
        }
        for(var i = 0;i < responseNow.length;i++) {
            var active = "";
            if(i == 0){
                active = " active";
            }
            refreshContent += '<div class="carousel-item' + active + '"' + '>';
                refreshContent += '<img src="Gambar/' + responseNow[i]['image_path'] + '"' + ' class=\"d-block w-100 background-cover\" alt=\"...\">';
                '<div class="carousel-caption d-none d-md-block">';
                    refreshContent += '<h5>' + responseNow[i]['nama_film'] + '</h5>';
                    refreshContent += '<a  href="detail_film.php?id='+responseNow[i]['id_film']+'" class="btn">Detail</a>';
                refreshContent += '</div>';
            refreshContent += '</div>';
        }
        movie_list.innerHTML = refreshContent;
    }

    function refresh(responseNow) {
        var movie_list = document.getElementById('movie_list');
        movie_list.innerHTML = "";

        var refreshContent = '';
        var needEndDiv = 1;
        for(var i = 0;i < responseNow.length;i++) {
        //<a  href="detail_film.php?id='+responseNow[i]['id_film']+' "
        if(i % 4 == 0) {
            refreshContent += '<div class="row gy-4 justify-content-center">';
            needEndDiv = 1;
        }
        refreshContent += '<div class="col-xl-3 col-lg-4 col-md-6">';
        refreshContent += '<a href="detail_film.php?id='+responseNow[i]['id_film']+' ">';
            refreshContent += '<div class="gallery-item h-100 d-flex justify-content-center">';
                refreshContent += '<img style = "height:400px" src="Gambar/' + responseNow[i]['image_path'] +'" class="img-fluid" alt="">';
                // refreshContent += '<img  src="assets/img/gallery/gallery-1.jpg" class="img-fluid" alt="">';
                refreshContent += '<div class="gallery-links d-flex align-items-center justify-content-center">';
                    refreshContent += '<h3 style = "text-align:center;">'+responseNow[i]['nama_film']+'</h3>'
                refreshContent += '</div>';
            refreshContent += '</div>';
        refreshContent = refreshContent + "</a>";
        refreshContent += '</div>';
        if(i % 4 == 3) {
            refreshContent += '</div>';
            needEndDiv = 0;
        }
        }
        if(needEndDiv) {
            refreshContent += '</div>';
        }
        
        movie_list.innerHTML = refreshContent;
    }

    function now_playing() {
        is_now_playing = 1;
        document.getElementById('title').innerHTML = "Now Playing!";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            
            var responseNow = JSON.parse(xhttp.responseText);
            refresh(responseNow);
            }
        };
        xhttp.open("GET", "Controller/controller_film.php?get_current_movie=1"  );
        xhttp.send();
    }

    function upcoming() {
        is_now_playing = 0;
        document.getElementById('title').innerHTML = "Upcoming!";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            
            var responseNow = JSON.parse(xhttp.responseText);
            refresh(responseNow);
            }
        };
        xhttp.open("GET", "Controller/controller_film.php?get_upcoming_movie=1"  );
        xhttp.send();
    }

    function search() {
        //document.getElementById('title').innerHTML = "Now Playing!";
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            var responseNow = JSON.parse(xhttp.responseText);
            refresh(responseNow);
            }
        };

        var like_filter = document.getElementById('search_key').value;
        if(is_now_playing == 1) {
        xhttp.open("GET", "Controller/controller_film.php?get_current_movie=1&title_like=" + like_filter   );
        } else if(is_now_playing == 0) {
        xhttp.open("GET", "Controller/controller_film.php?get_upcoming_movie=1&title_like=" + like_filter  );
        }

        xhttp.send();
    }

    function requestPoint() {
        var xhttp = new XMLHttpRequest();
        var jumlahReq = document.getElementById('jumlah_req').value;
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
            //summary.innerHTML = summary.innerHTML + xhttp.responseText;
            console.log(xhttp.responseText);
            document.getElementById('jumlah_req').value = 0;
            }
        };
        xhttp.open("GET", "Controller/controller_member.php?request_point=1&jumlah=" + jumlahReq + "&id_user=" + id_member   );
        xhttp.send();
    }
    now_playing();

    

    


</script>