<?php 
    require "../Controller/functions.php";

    $userData = fetchData("SELECT * FROM point_request pr JOIN member m ON m.id_member = pr.id_member");
?>

<tr>
    <th>No</th>
    <th>Member</th>
    <th>Jumlah Point</th>
    <th>Action</th>
</tr>
<?php 
    $counter = 1;
    foreach($userData as $value){ ?>
        <tr>
            <td><?= $counter ?></td>
            <td><?= $value['id_member'] ?></td>
            <td><?= $value['jumlah_point'] ?></td>
            <td>
                <button class="accept-button" value="<?= $value['id_request'] ?>">Accept</button>
                <button class="cancel-button" value="<?= $value['id_request'] ?>">Cancel</button>
            </td>
        </tr>  
    <?php } ?>