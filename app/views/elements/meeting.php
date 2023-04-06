<table class="table table-bordered" id="popup_meeting">
  <thead>
    <tr>
      <th>Bilangan</th>
      <th>Bulan</th>
      <th>Tarikh Mesyuarat</th>
      <th>Tarikh Kuatkuasa</th>
      <th>No. Kertas Kerja</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row) { ?>
      <tr>
        <td><?= $row["mcm_blngn"] ?></td>
        <td><?= $row["eld3"] ?></td>
        <td><?= $row["mcm_tkhpl"] ?></td>
        <td><?= $row["mcm_tkhtk"] ?></td>
        <td><?= $row["mcm_kkrja"] ?></td>
      </tr>
    <?php } ?>
  </tbody>
</table>