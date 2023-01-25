<?php if (empty($amend["data"])) { ?>
<tr class='no-data'>
  <td colspan='8' class='text-muted text-center'>Tiada rekod!</td>
</tr>

<?php } else {foreach ($amend["data"] as $row) { ?>
<tr>
  <td class="text-center"><?= $row["form"] ?></td>
  <td>
    - <?= $row["no_akaun"] ?><br />
    - <?= $row["no_siri"] ?>
  </td>
  <td>
    - <?= $row["tkhpl"] ?><br />
    - <?= $row["tkhtk"] ?>
  </td>
  <td>
    - <?= $row["tnama"] ?><br />
    - <?= $row["bnama"] ?><br />
    - <?= $row["hnama"] ?><br />
    - <?= $row["snama"] ?>
  </td>
  <td>
    - RM <?= $row["nilth"] ?><br />
    - <?= $row["kadar_asal"] ?> %<br />
    - RM <?= $row["cukai_asal"] ?>
  </td>
  <td>
    - RM <?= $row["bnilt"] ?><br />
    - <?= $row["kadar_baru"] ?> %<br />
    - RM <?= $row["cukai_baru"] ?>
  </td>
  <td>
    Sebab² : <?= $row["sebab"] ?><br />
    Catatan : <?= $row["mesej"] ?>
  </td>
  <td><?= $row["status"] ?></td>
  <td>
    - <?= $row["entry"] ?><br />
    - <?= $row["verifier"] ?>
  </td>
  <td>
    <div class="btn-group btn-group-pill btn-group-xs" role="group">
      <a href="<?php if ($row["form"] == "A") {
              echo "../Amendment/jadualacheck/" . $row["noSiri"];
            } elseif ($row["form"] == "B") {
              echo "../Amendment/jadualbcheck/" . $row["noSiri"];
            } elseif ($row["form"] == "C") {
              echo "Jadualccheck/" . $row["noSiri"];
            } ?>" class="btn btn-outline-info btn-xs" type="button" data-bs-toggle="tooltip" data-bs-placement="top"
        title="Maklumat Lengkap"><i class="icon-eye"></i></a>
      <?php if ($row["form"] == "B" || $row["form"] == "C") { ?>
      <a href=<?php if ($row["form"] == "B") {
              echo "calculatorB/" . $row["noSiri"];
            } elseif ($row["form"] == "C") {
              echo "calculatorC/" . $row["noSiri"];
            } ?> class="btn btn-pill btn-outline-secondary btn-air-secondary btn-xs <?php if ($row["calc_id"] == "0") {
   echo "disabled";
 } ?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Borang Nilaian"><i class="fa fa-calculator"></i></a>
      <?php } ?>
      <a href="uploadImages/<?= $row["noAcct"] ?>" class="btn btn-pill btn-outline-secondary btn-air-secondary btn-xs"
        data-bs-toggle="tooltip" data-bs-placement="top" title="Muatnaik Gambar"><i class="fa fa-file-image-o"></i></a>
    </div>
  </td>
</tr>
<?php } ?>
<?php } ?>