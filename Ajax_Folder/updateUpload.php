<?php
$old = $_POST['old'];
if ( 0 < $_FILES['file']['error'] ) {
  echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    if(!empty($_FILES['file']['name'])){
        move_uploaded_file($_FILES['file']['tmp_name'], '../Gambar/' . $old);
    }
}

?>