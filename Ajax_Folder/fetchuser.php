<?php
    require "../Controller/functions.php";

    $userData = fetchData("SELECT * FROM member");
?>
<link rel="stylesheet" href="bootstrap-5.2.1-dist/css/bootstrap.css">
<link rel="stylesheet" href="mycss.css">


<tr class="tbl">
    <th class="back">No</th>
    <th class="back">Username</th>
    <th class="back">Name</th>
    <th class="back">Email</th>
    <th class="back">Saldo</th>
    <th class="back">Action</th>
</tr>
<?php
    $counter = 1;
    foreach($userData as $value){
        if($value['status']){ ?>
       
            <tr class="tbl">
                <td class="back"><?= $counter ?></td>
                <td class="back"><?= $value['user'] ?></td>
                <td class="back"><?= $value['nama_member'] ?></td>
                <td class="back"><?= $value['email'] ?></td>
                <td class="back"><?= $value['saldo'] ?></td>
                <td class="back">
                    <button class="updateUser btn btn-info" value="<?= $value['id_member'] ?>">Update</button>
                    <button class="deleteUser btn btn-danger" value="<?= $value['id_member'] ?>">Deactivate</button>
                </td>
            </tr>

        
        <?php $counter++; } ?>
    <?php } ?>
