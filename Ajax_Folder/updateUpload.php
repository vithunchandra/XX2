<?php
$old = $_POST['old'];

if(isset($_FILES['file'])){
  if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
  }
  else {
      if(!empty($_FILES['file']['name'])){
          unlink("../Gambar".basename($old));
          move_uploaded_file($_FILES['file']['tmp_name'], '../Gambar/' . $_FILES['file']['name']);
      }
  }
}
?>