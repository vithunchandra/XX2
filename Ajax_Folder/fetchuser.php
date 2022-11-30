<?php
    require "../Controller/functions.php";

    $userData = fetchData("SELECT * FROM member");
?>

<thead>
    <tr>
        <th>No</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th>Saldo</th>
        <th>Action</th>
    </tr>
</thead>
<tbody>
    <?php
        $counter = 1;
        foreach($userData as $value){
            if($value['status']){ ?>
                <tr>
                    <td><?= $counter ?></td>
                    <td><?= $value['user'] ?></td>
                    <td><?= $value['nama_member'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['saldo'] ?></td>
                    <td>
                        <button class="updateUser btn btn-info" value="<?= $value['id_member'] ?>">Update</button>
                        <button class="deleteUser btn btn-danger" value="<?= $value['id_member'] ?>">Deactivate</button>
                    </td>
                </tr>
            <?php $counter++; } ?>
        <?php } ?>
</tbody>