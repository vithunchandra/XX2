<?php
  require("Controller/connect.php");
  $theaterList = fetch("select * from theater order by id_theater asc");
  echo "<script>var allTheater = JSON.parse('" . json_encode($theaterList) . "')</script>";
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap-5.2.1-dist/css/bootstrap.css">
  
  <script src = "bootstrap-5.2.1-dist/js/bootstrap.min.js"></script>
  <script src = "bootstrap-5.2.1-dist/js/bootstrap.bundle.min.js"></script>
  <script src = "jquery-3.6.1.min.js"></script>

  <style>
    .row {
      width: 100%;
      height: 500px;
    }
    form {
      display: inline;
    }
  </style>

  <script>
    $(document).ready(function() {
      $('#myModal').modal('show');
    });
    
    function openModal() {
      $('#myModal').modal('show');
    }
  </script>

</head>
<body>
  <button ><a href = 'index.php'>Home</a></button>
  <button type="button" class="btn btn-primary" onclick="openModal()" >
    Choose Theater
  </button>

  <?php 
    if(isset($_SESSION['login'])) {
      echo '<form action = "Controller/controller_member.php" method = "POST"><button name = "logout" type = "submit">logout</button></form>';
    } else {
      echo '<button><a href = "login.php">Login</a></button>';
    }
  ?>
  <hr>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Choose Theater!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <select name="theater_select" id="theater_select">
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
  
  <div class="container">
    <h3 id = "title"></h3>
    <h4 id = 'ukuran'></h4>
    <h4 id = 'harga'></h4>
    <p id = 'desc'></p>
    <hr>
    <div id="schedule"></div>
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
            tempHTML += "<h5>"+tempDate+"</h5><hr>";
            for(var i = 0;i < responseNow.length;i++) {
              if(responseNow[i]['broadcast_date'] != tempDate) {
                tempHTML += "</div>"
                tempDate = responseNow[i]['broadcast_date'];
                tempHTML += "<h5>"+tempDate+"</h5><hr>";
                tempHTML += "<div class = 'row'>"
              }
              tempHTML += '<div class="card" style="width: 18rem;float:left;">';
                tempHTML += '<img width = "200px" height = "300px" class="card-img-top" src="Gambar/' + responseNow[i]['image_path'] +'" alt="'+responseNow[i]['nama_film']+'">';
                tempHTML += '<div class="card-body">';
                  tempHTML += '<h5 class="card-title">'+ responseNow[i]['nama_film'] +'</h5>';
                  tempHTML += '<h5>'+responseNow[i]['session_start'] + " - " + responseNow[i]['session_end'] +'</h5>'
                  tempHTML += '<a  href="detail_film.php?id='+responseNow[i]['id_film']+' " class="btn btn-primary">Detail</a>';
                tempHTML += '</div>';
              tempHTML += '</div>';
            }
            tempHTML += "</div>"
          }
          console.log(tempHTML);
          document.getElementById('schedule').innerHTML = tempHTML;
          
        }
    };
    xhttp.open("GET", "Controller/controller_theater.php?get_all_film_theater=1&id_theater=" + (sel + 1)  );
    xhttp.send();

  }

 
</script>