<?php 
    require "../Controller/functions.php";

    $id_film = $_POST['id_film'];
    $date = $_POST['date'];
    $queryDate = !empty($date) ? " AND s.broadcast_date = '$date' " : "";

    $query = "SELECT COUNT(f.id_film) AS jumlah, t.harga AS harga, 
    COUNT(f.id_film)*t.harga AS total_penjualan, f.start_date AS start_date, f.end_date AS end_date FROM h_movie hm 
    JOIN d_movie dm ON dm.id_nota = hm.id_nota JOIN theater_schedule ts ON ts.id_theater_schedule = hm.id_theater_schedule JOIN theater t ON t.id_theater = ts.id_theater
    JOIN schedule s ON s.id_schedule = ts.id_schedule JOIN film f ON f.id_film = s.id_film WHERE 1 = 1 AND f.id_film = '$id_film'".$queryDate;

    $data = fetchData($query);
    if(!empty($data)){
        $data = $data[0];
    }

    $filmData = fetchData("SELECT * FROM film WHERE id_film = '$id_film'")[0];
?>
<td>
    <img src="Gambar/<?= $filmData['image_path'] ?>" class="rounded" style="width: 200px;"> <br>
    <span class="fw-bold"><?= $filmData['nama_film'] ?></span><br>
    <span class="fw-bold"><?= $filmData['start_date'] ?> - <?= $data['end_date'] ?> </span>
</td>
<td>
    <div class="form-floating">
        <input type="text" hidden value="<?= $id_film ?>">
        <input type="date" class="form-control pilih-tanggal" id="tanggal" placeholder="Pilih Tanggal" value="<?= $date ?>">
        <label for="tanggal">Pilih Tanggal Penjualan</label>
    </div>
</td>
<td>
    <?php if(!empty($data)){ ?>
        <?= $data['jumlah']." Lembar Tiket" ?>
    <?php }else{ ?>
        Data Not Found
    <?php } ?>
</td>
<td>
    <?php if(!empty($data)){ ?>
        <?= "Rp. ".number_format($data['harga'], 0, ',', '.') ?>
    <?php }else{ ?>
        Data Not Found
    <?php } ?>
</td>
<td>
    <?php if(!empty($data)){ ?>
        <?= "Rp. ".number_format($data['total_penjualan'], 0, ',', '.') ?>
    <?php }else{ ?>
        Data Not Found
    <?php } ?>
</td>