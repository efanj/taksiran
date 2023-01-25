<table class="table table-bordered" id="popup_reason" width="100%">
  <thead>
    <tr>
      <th>Kod Sebab</th>
      <th>Sebab-sebab</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $row) { ?>
    <tr>
      <td><?= $row["acm_sbkod"] ?></td>
      <td width="70%"><?= $row["acm_sbktr"] ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>