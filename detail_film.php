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
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <button><a href = "index.php">Back</a></button>  
  <hr>

  <div id="poster">
    <img width="256px" height="256px" src= <?="'Gambar/".$movie['image_path']."'"?> alt="">
  </div>
  <h1><?= $movie['nama_film'] ?></h1>

  <h3>Start Date : <?= $movie['start_date'] ?></h3>
  <h3>End Date : <?= $movie['end_date'] ?></h3>
  
  <h3>Genre : </h3>
  <ul>
  <?php 
    for($i = 0;$i < count($genre);$i++) {
      echo "<li>" . $genre[$i]  ."</li>";
    }
  ?>
  </ul>

  <h3>Sinopsis:</h3>
  <p><?=$movie['sinopsis']?></p>
  <div id="trailer">
    <a href=<?= "'".$movie['trailer_link']."'" ?>>trailer!</a>
  </div>

  <form action=<?= "'detail_film.php?id=".$_GET['id']."'" ?> method = "POST">
    <button type="submit" name = "order">Buy Ticket!</button>
  </form>
  
</body>
</html>