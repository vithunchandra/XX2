<?php 
  require('Controller/connect.php');
  $sql = "select nama_film,sum(subtotal) as total from 
    (SELECT f.nama_film,(count(t.id_theater)*t.harga) as subtotal 
      from schedule s,theater_schedule ts ,h_movie hm,d_movie dm,film f,theater t 
      where DAYOFWEEK(s.broadcast_date) = 6 
        and s.id_schedule = ts.id_schedule 
        and hm.id_theater_schedule = ts.id_theater_schedule 
        and hm.id_nota = dm.id_nota 
        and s.id_film = f.id_film 
        and t.id_theater = ts.id_theater 
      group by f.id_film,ts.id_theater) as merged1 
    group by nama_film;";

  $hasil = fetch($sql);
  echo "<script> var queryRes = JSON.parse('" .  json_encode($hasil) . "')</script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <script
    src="https://www.gstatic.com/charts/loader.js">
  </script>
</head>
<body>
  <div id="myChart" style="max-width:700px; height:400px"></div>
</body>
</html>

<script>
  console.log(queryRes);
  google.charts.load('current',{packages:['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
  var data = [];
  total = 0;
  for(var i = 0;i < queryRes.length;i++) {
    total = total + parseFloat(queryRes[i]['total']);
  }

  data.push(["nama film","total"]);
  for(var i = 0;i < queryRes.length;i++) {
    data.push([queryRes[i]['nama_film'], parseFloat(queryRes[i]['total']) ]) ;
  }

  var data = google.visualization.arrayToDataTable(data);

  var options = {
    title:'Penjualan Pada Hari Sabtu'
  };

  var chart = new google.visualization.PieChart(document.getElementById('myChart'));
    chart.draw(data, options);
  }

</script>