<?php
  require("Controller/connect.php");
  $theaterList = fetch("select id_theater,nama_theater from theater");
  
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

  <script>
    $(document).ready(function() {
      $('#myModal').modal('show');
    });

  </script>

</head>
<body>
  <button ><a href = 'index.php'>Home</a></button>
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

    <div class="schedule"></div>
  </div>
  
</body>
</html>

<script>
  function load_page() {
    var sel = document.getElementById('theater_select');
    document.getElementById('title').innerHTML = sel.options[sel.selectedIndex].text ;
  }

 
</script>