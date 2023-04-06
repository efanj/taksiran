<?php if (empty($notis)) { ?>
<tr>
    <td colspan="8" style="text-align: center;">Tiada Rekod!</td>
</tr>
<?php
} else {
    foreach ($notis as $row) {
    ?>
<tr>
    <td></td>
    <td><?php echo $row['prmt_akaun'] . "<br/>" . $row['prmt_nolot'] ?></td>
    <td>
        <?php
                echo $row['nmbil'] . "<br/>";
                echo $row['adpg1'] . "<br/>";
                if ($row['adpg2'] != '') {
                    echo $row['adpg2'] . "<br/>";
                }
                if ($row['adpg3'] != '') {
                    echo $row['adpg3'] . "<br/>";
                }
                if ($row['adpg4'] != '') {
                    echo $row['adpg4'];
                }
                ?>
    </td>
    <td><?php echo $row['prmt_lsbgn_asal'] . "<br/>" . $row['prmt_lstnh']  ?></td>
    <td><?php echo $row['prmt_lsbgn_tmbh']; ?></td>
    <td><?php echo $row['prmt_tahun']; ?></td>
    <td><?php echo $row['name']; ?></td>
    <td></td>
</tr>
<?php } ?>
<?php } ?>