<table class="table table-bordered" id="popup_street" width="100%">
  <thead>
    <tr>
      <th>Kod Jalan</th>
      <th>Kod Kawasan</th>
      <th width="50%">Nama Jalan</th>
      <th width="10%">Poskod</th>
      <th width="30%">Nama Kawasan</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row) { ?>
    <tr>
      <td><?= $row["jln_jlkod"] ?></td>
      <td><?= $row["kws_kwkod"] ?></td>
      <td><?= $row["jln_jnama"] ?></td>
      <td><?= $row["jln_poskd"] ?></td>
      <td><?= $row["kws_knama"] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>