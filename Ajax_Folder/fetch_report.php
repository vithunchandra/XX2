<?php 
    require "../Controller/functions.php";

    $id_films = fetch("SELECT id_film FROM film");
?>
<thead>
    <tr>
        <th>Film</th>
        <th>Pilih Tanggal</th>
        <th>Jumlah Penjualan</th>
        <th>Harga</th>
        <th>Total Penghasilan</th>
    </tr>
</thead>
<tbody>
    <?php 
        foreach($id_films as $key => $value){
            $id_film = $value['id_film'];
            $query = "SELECT f.nama_film AS nama_film, f.image_path AS image_path, COUNT(f.id_film) AS jumlah, t.harga AS harga, 
            COUNT(f.id_film)*t.harga AS total_penjualan, f.start_date AS start_date, f.end_date AS end_date 
            FROM h_movie hm JOIN theater_schedule ts ON ts.id_theater_schedule = hm.id_theater_schedule JOIN theater t ON t.id_theater = ts.id_theater 
            JOIN schedule s ON s.id_schedule = ts.id_schedule JOIN film f ON f.id_film = s.id_film JOIN d_movie dm ON dm.id_nota = hm.id_nota
            WHERE s.id_film = '$id_film' GROUP BY s.id_film";
            $filmData = fetch($query); 
            if(!empty($filmData)){
                $data = $filmData[0]; ?>
                <tr>
                    <td>
                        <img src="Gambar/<?= $data['image_path'] ?>" class="rounded" style="width: 200px;"> <br>
                        <span class="fw-bold"><?= $data['nama_film'] ?></span><br>
                        <span class="fw-bold"><?= $data['start_date'] ?> - <?= $data['end_date'] ?> </span>
                    </td>
                    <td>
                        <div class="form-floating">
                            <input type="text" hidden value="<?= $id_film ?>">
                            <input type="date" class="form-control pilih-tanggal" id="tanggal" placeholder="Pilih Tanggal">
                            <label for="tanggal">Pilih Tanggal Penjualan</label>
                        </div>
                    </td>
                    <td>
                        <?= $data['jumlah']." Lembar Tiket" ?>
                    </td>
                    <td>
                        <?= "Rp. ".number_format($data['harga'], 0, ',', '.') ?>
                    </td>
                    <td>
                        <?= "Rp. ".number_format($data['total_penjualan'], 0, ',', '.') ?>
                    </td>
                </tr>
            <?php } ?>
        <?php } ?>
</tbody>