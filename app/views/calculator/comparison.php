	<table class="table table-bordered" id="popup_comparison" width="100%">
	  <thead>
	    <tr>
	      <th></th>
	      <th>Nama Jalan</th>
	      <th>Jenis Bangunan</th>
	      <th>Keluasan</th>
	      <th>Nilai Tahunan</th>
	      <th>Sewa SMP(MFA)</th>
	      <th>Sewa SMP(AFA)</th>
	    </tr>
	  </thead>
	  <tbody>
	    <?php if (empty($data)) { ?>
	    <tr>
	      <td colspan='5' class='text-muted text-center'>There is no data</td>
	    </tr>
	    <?php } else {
				foreach ($data as $row) { ?>
	    <tr>
	      <td><?= $row["id"] ?></td>
	      <td><?= $row["jln_jnama"] ?></td>
	      <td><?= $row["bgn_bnama"] ?></td>
	      <td><?= $row["peg_lsbgn"] ?></td>
	      <td>RM <?= $row["peg_nilth"] ?></td>
	      <td>RM <?= $row["mfa"] ?></td>
	      <td>RM <?= $row["afa"] ?></td>
	    </tr>
	    <?php }
			} ?>
	  </tbody>
	</table>