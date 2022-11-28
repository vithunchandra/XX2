<?php
  require('Controller/connect.php');

  $movie = "";
  $genre = [];
  if(isset($_GET['id'])) {
    $sql = "Select * from film where id_film = " . $_GET['id'];
    $movie = mysqli_fetch_assoc($conn->query($sql));

    $sql_genre = "SELECT g.nama_genre as gen FROM `film_genre` fg,`genre`g,`film` f WHERE fg.id_genre = g.id_genre and f.id_film = fg.id_film 
    and f.id_film = " . $_GET['id'];

    $temp_genre = $conn->query($sql_genre);
    $counter = 0;
    while($row = mysqli_fetch_assoc($temp_genre)) {
      $genre[$counter] = $row['gen'];
      $counter +=1;
    }

    if(isset($_POST['order'])) {
      if(isset($_SESSION['login'])) {
        header('Location:order.php?id=' . $_GET['id']);
      } else {
        header("Location:login.php?err='Anda harus login terlebih dahulu'");
      }
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

  <title>Film Details</title>
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
  <style>
    .mycenter {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
  </style>
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
            <h2> <?= $movie['nama_film'] ?> </h2>
            <p>Buy Your Ticket Now, Before it's gone !</p>

            <form action=<?= "'detail_film.php?id=".$_GET['id']."'" ?> method = "POST">
              <button class = "btn btn-primary"  type="submit" name = "order">Buy Now !</button>
            </form>
            <!-- <a class="cta-btn" href="contact.html">Buy</a> -->

          </div>
        </div>
      </div>
    </div><!-- End Page Header -->

    <!-- ======= Gallery Single Section ======= -->
    <section id="gallery-single" class="gallery-single">
      <div class="container">

        <div class="position-relative h-100">
          <div class="swiper">
            <div class="swiper-wrapper align-items-center">

              <div class="swiper-slide">
                <img class = "mycenter"  height="768px" src= <?="'Gambar/".$movie['image_path']."'"?> alt="">
              </div>
              <div class="swiper-slide">
                <iframe height="768" width="100%"
                  src="<?= str_replace("watch?v=","embed/", $movie['trailer_link'] )  ?>">
                  
                </iframe>
              </div>
              <!--
              <div class="swiper-slide">
                <img src="assets/img/gallery/gallery-10.jpg" alt="">
              </div>
              <div class="swiper-slide">
                <img src="assets/img/gallery/gallery-11.jpg" alt="">
              </div>
              <div class="swiper-slide">
                <img src="assets/img/gallery/gallery-12.jpg" alt="">
              </div>
              <div class="swiper-slide">
                <img src="assets/img/gallery/gallery-13.jpg" alt="">
              </div> -->

            </div>
            <div class="swiper-pagination"></div>
          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>

        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8">
            <div class="portfolio-description">
              <h2>Synopsis of <?= $movie['nama_film'] ?>  </h2>
              <p><?=$movie['sinopsis']?></p>
              <br>
              <h4>Genre : </h4>
              <ul>
              <?php 
                for($i = 0;$i < count($genre);$i++) {
                  echo "<li>" . $genre[$i]  ."</li>";
                }
              ?>
              </ul>
            </div>
          </div>

          <div class="col-lg-3">
            <div class="portfolio-info">
              <h3>More Information</h3>
              <ul>
                <li><strong>Start Date</strong> <span><?= $movie['start_date'] ?></span></li>
                <li><strong>End Date</strong> <span><?= $movie['end_date'] ?></span></li>

                <form action=<?= "'detail_film.php?id=".$_GET['id']."'" ?> method = "POST">
                  <button class = "btn btn-primary"  type="submit" name = "order">Get Your Seat Now !</button>
                </form>
              </ul>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Gallery Single Section -->

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

  <script>
    const slider = document.querySelector('.swiper');
    const sl = new Swiper(slider, {
      slidesPerView: 'auto',
      loop: false,
      speed: 1000,
      slidesPerView: '1',
      autoplay: {
        enabled: false,
        delay: 100000,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    });
  </script>

</body>

</html>