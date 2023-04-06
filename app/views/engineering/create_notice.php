<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <?php
      $info = $this->controller->engineering->getPermitAccount($fileId);
      // print_r($info);
      ?>
      <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col">
                  <h4 class="ml5">NOTIS PENGUBAHSUAIAN</h4>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <form action="" method="POST" id="form-permit-pengubahan">
                <input type="hidden" name="file_id" value="<?= $fileId; ?>">
                <div class="row mb5">
                  <div class="col-md-2"><label class="control-label">Pemilik Harta :</label>
                  </div>
                  <div class="col-md-4 div-label"><?= $info['prmt_nmpmk'] ?></div>
                  <div class="col-md-2"><label class="control-label">No. Akaun :</label></div>
                  <div class="col-md-1 div-label"><?= $info['prmt_akaun'] ?></div>
                  <div class="col-md-1"></div>
                  <div class="col-md-1"><label class="control-label">No. Lot :</label></div>
                  <div class="col-md-1 div-label"><?= $info['prmt_nolot'] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2"><label class="control-label">Alamat Harta :</label>
                  </div>
                  <div class="col-md-10 div-label">
                    <?php
                    if ($info['prmt_adpg1'] != "") {
                      echo $info['prmt_adpg1'] . ", ";
                    }
                    if ($info['prmt_adpg2'] != "") {
                      echo $info['prmt_adpg2'] . ", ";
                    }
                    if ($info['prmt_adpg3'] != "") {
                      echo $info['prmt_adpg3'] . ", ";
                    }
                    if ($info['prmt_adpg4'] != "") {
                      echo $info['prmt_adpg4'];
                    }
                    ?>
                  </div>
                </div>
                <hr>
                <div class="row mt5 mb5">
                  <div class="col-md-2"><label class="control-label">Tarikh Notis :</label>
                  </div>
                  <div class="col-md-2 div-label">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control input-sm" data-language="en" data-date-Format="dd/mm/yyyy"
                        name="tarikh_notis" id="tarikh_notis" value="">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-2"><label class="control-label">Rujukan Pejabat :</label>
                  </div>
                  <div class="col-md-2 div-label">
                    <input type="text" class="form-control input-sm" name="ruj_pejabat" id="ruj_pejabat" value="">
                  </div>
                </div>
                <div class="row mt5">
                  <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save"></i> Simpan Rekod</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt5">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading bg-primary">
              <h5>Senarai Notis Denda</h5>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="notis" class="table table-bordered dt-responsive"
                  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                    <tr>
                      <th></th>
                      <th>
                        No. Akaun<br />
                        No. Lot
                      </th>
                      <th>
                        Nama Pemilik<br />
                        Alamat Harta
                      </th>
                      <th>
                        Luas Bangunan(mp)<br />
                        Luas Tanah(mp)
                      </th>
                      <th>Luas Binaan Tambahan(mp)</th>
                      <th>Permit Tahun</th>
                      <th>Pegawai</th>
                      <th></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <!--end card-body-->
          </div>
          <!--end card-->
        </div>
      </div>
    </div>
  </div>
</div>