<table class="table table-bordered display" id="popup_account" width="100%">
  <thead>
    <tr>
      <th>No. Akaun</th>
      <th>Pemilik</th>
      <th>Nama Jalan</th>
      <th>Jenis Hartanah</th>
      <th></th>
      <th></th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row) { ?>
    <tr>
      <td><?= $row["peg_akaun"] ?></td>
      <td><?= $row["pmk_nmbil"] ?></td>
      <td><?= $row["jln_jnama"] ?></td>
      <td><?= $row["hrt_hnama"] ?></td>
      <td><?= $row["jln_jlkod"] ?></td>
      <td><?= $row["jln_kwkod"] ?></td>
      <td><?= $row["jln_knama"] ?></td>
      <td><?= $row["peg_htkod"] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>