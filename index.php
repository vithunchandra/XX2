<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="bootstrap-5.2.1-dist/css/bootstrap.css">
</head>
<body>
  <button onclick = "now_playing()" >Now Playing</button>
  <button onclick = "upcoming()" >Upcoming</button>
  <button><a href = "login.php">Login</a></button>
  <hr>

  <h1 id = 'title'>Title</h1>
  <div id="movie_list"></div>


</body>
</html>

<script>
  function refresh(responseNow) {
    var movie_list = document.getElementById('movie_list');
    movie_list.innerHTML = "";

    var refreshContent = '';
    for(var i = 0;i < responseNow.length;i++) {
      refreshContent += '<div class="card" style="width: 18rem;">';
        refreshContent += '<img class="card-img-top" src="Gambar/' + responseNow[i]['image_path'] +'" alt="'+responseNow[i]['nama_film']+'">';
        refreshContent += '<div class="card-body">';
          refreshContent += '<h5 class="card-title">'+ responseNow[i]['nama_film'] +'</h5>';
          refreshContent += '<a  href="detail_film.php?id='+responseNow[i]['id_film']+' " class="btn btn-primary">Detail</a>';
        refreshContent += '</div>';
      refreshContent += '</div>';
    }
    movie_list.innerHTML = refreshContent;
  }

  function now_playing() {
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

  now_playing();
</script>