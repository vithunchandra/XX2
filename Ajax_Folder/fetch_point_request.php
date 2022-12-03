<?php 
    require "../Controller/functions.php";

    $userData = fetchData("SELECT m.id_member AS id_member, pr.jumlah_point AS jumlah_point, pr.id_request AS id_request, pr.status AS status 
    FROM point_request pr JOIN member m ON m.id_member = pr.id_member");
?>

<tr>
    <th>No</th>
    <th>Member</th>
    <th>Jumlah Point</th>
    <th>Action</th>
</tr>
<?php 
    $counter = 1;
    foreach($userData as $value){ 
        if($value['status']){ ?>
            <tr>
                <td><?= $counter ?></td>
                <td><?= $value['id_member'] ?></td>
                <td><?= $value['jumlah_point'] ?></td>
                <td>
                    <button class="accept-button btn btn-info" value="<?= $value['id_request'] ?>">Accept</button>
                    <button class="cancel-button btn btn-danger" value="<?= $value['id_request'] ?>">Cancel</button>
                </td>
            </tr>  
        <?php } ?>
    <?php } ?>