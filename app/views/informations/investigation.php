<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <?php $info = $this->controller->account->getAccountInfo($fileId); ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>SEMAKAN - DESKTOP</h4>
            </div>
            <div class="panel-body">
              <form method="post" id="semak-desktop">
                <div class="form-group">
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <label>No.IC / Daftar Syarikat :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["pmk_plgid"] ?>" name="plgid" readonly>
                    </div>
                    <div class="col-md-6">
                      <label>Nama Dibil :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["pmk_nmbil"] ?>" name="nmbil" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-2">
                    <div class="col-md-6">
                      <label>Alamat :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["adpg1"] ?>" name="adpg1">
                    </div>
                    <div class="col-md-6">
                      <label>Alamat 2 :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["adpg2"] ?>" name="adpg2">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <label>No. Akaun :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_akaun"] ?>" name="noAkaun">
                    </div>
                    <div class="col-md-4">
                      <label>No. Lot :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_nolot"] ?>" name="noLot">
                    </div>
                    <div class="col-md-4">
                      <label>No. PT :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_nompt"] ?>" name="noPT">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <label>Luas Tanah :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_lstnh"] ?>" name="lstnh" readonly>
                    </div>
                    <div class="col-md-4">
                      <label>Luas Bangunan :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_lsbgn"] ?>" name="lsbgn" readonly>
                    </div>
                    <div class="col-md-4">
                      <label>Luas Ansolari :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_lsans"] ?>" name="lsans" readonly>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-2">
                    <div class="col-md-4">
                      <label>Luas Bangunan Tamb. :</label>
                      <input class="form-control input-sm" type="text" value="" name="lsbgn_tamb">
                    </div>
                    <div class="col-md-4">
                      <label>Luas Ansolari Tamb. :</label>
                      <input class="form-control input-sm" type="text" value="" name="lsans_tamb">
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-4">
                    <div class="col-md-6">
                      <label>koordinat X :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_codex"] ?>" name="codex" id="codex" required>
                    </div>
                    <div class="col-md-6">
                      <label>koordinat Y :</label>
                      <input class="form-control input-sm" type="text" value="<?= $info["peg_codey"] ?>" name="codey" id="codey" required>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <div class="row mb-4">
                    <div class="col-md-8">
                    </div>
                    <div class="col-md-4 tar">
                      <button type="submit" class="btn btn-square btn-primary btn-sm"><i class="icon-save"></i> Simpan
                        Rekod</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div id="mapView" class="mapView"></div>
        </div>
      </div>
      <!-- End .row -->
    </div>
    <!-- End .page-content-inner -->
  </div>
  <!-- / page-content-wrapper -->
</div>