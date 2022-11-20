<?php
    require "functions.php";

    $userData = fetchData("SELECT * FROM member");
?>

<tr>
    <th>No</th>
    <th>Username</th>
    <th>Name</th>
    <th>Email</th>
    <th>Saldo</th>
    <th>Action</th>
</tr>
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
                    <button class="deleteUser" value="<?= $value['id_member'] ?>">Deactivate</button>
                </td>
            </tr>
        <?php $counter++; } ?>
    <?php } ?>