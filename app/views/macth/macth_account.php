<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>PADANAN DATA</h4>
            </div>
            <div class="panel-body">
              <?php $info = $this->controller->macthing->getAccountInfo($fileId); ?>
              <form method="POST" role="form" id="macth-account">
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">No. Lot :</label>
                  </div>
                  <div class="col-md-2">
                    <input class="form-control input-sm" name="nolot" type="text" value="<?= $info["peg_nolot"] ?>"
                      id="nolot">
                  </div>
                  <div class="col-md-2">
                    <input name="no_akaun" type="hidden" value="<?= $info["peg_akaun"] ?>" id="no_akaun">
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Bil. Lot :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["peg_bilpk"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Alamat Harta :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["adpg1"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Jalan :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["peg_jlkod"] ?> - <?= $info["jln_jnama"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2"></div>
                  <div class="col-md-4 control-label"><?= $info["adpg2"] ?></div>
                  <div class="col-md-4"></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2"></div>
                  <div class="col-md-4 control-label"><?= $info["adpg3"] ?></div>
                  <div class="col-md-4"></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2"></div>
                  <div class="col-md-4 control-label"><?= $info["adpg4"] ?></div>
                  <div class="col-md-4"></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Kegunaan Tanah :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["tnh_tnama"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Jenis Bangunan :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["bgn_bnama"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Kegunaan Hartatanah :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["hrt_hnama"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Struktur Bangunan :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["stb_snama"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Jenis Pemilik :</label>
                  </div>
                  <div class="col-md-4 control-label"><?= $info["jpk_jnama"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Tarikh MJP :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_tkhtk"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Tarikh Kuatkuasa :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_tkhpl"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Tarikh O.C :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_tkhoc"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">No. PT :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_nompt"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Rujuk Fail :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_rjfil"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">No. Pelan :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_pelan"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Koordinat X :</label>
                  </div>
                  <div class="col-md-2"><input class="form-control input-sm" name="codex" type="text"
                      value="<?= $info["peg_codex"] ?>" id="codex"></div>
                  <div class="col-md-2"></div>
                  <div class="col-md-2">
                    <label class="control-label">Koordinat Y :</label>
                  </div>
                  <div class="col-md-2"><input class="form-control input-sm" name="codey" type="text"
                      value="<?= $info["peg_codey"] ?>" id="codey"></div>
                  <div class="col-md-2"></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Caj Sampah :</label>
                  </div>
                  <div class="col-md-2 control-label">RM <?= $info["peg_smpah"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">No. Hak Milik
                      :</label>
                  </div>
                  <div class="col-md-2 control-label"></div>
                  <div class="col-md-2">
                    <label class="control-label">Bil. Pemilik :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_bilpk"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label">Rujukan MMK :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_rjmmk"] ?></div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Luas Bangunan
                      :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_lsbgn"] ?> mp</div>
                  <div class="col-md-2">
                    <label class="control-label">Luas Tanah :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_lstnh"] ?> mp</div>
                  <div class="col-md-2">
                    <label class="control-label">Luas Ansolari
                      :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_lsans"] ?> mp</div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Status Pegangan
                      :</label>
                  </div>
                  <div class="col-md-2 control-label"><?= $info["peg_statf"] ?></div>
                </div>
                <hr>
                <div class="row mb5">
                  <div class="col-md-4">
                  </div>
                  <div class="col-md-8 tar">
                    <button type="submit" class="btn btn-primary btn-sm mr5 mb10"><i class="fa fa-save"></i> Simpan
                      Rekod</button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div id="mapView" class="mapView">
            <!-- <div class="google" width="30%">
              <input type="text" class="form-control input-sm" id="google_term">
            </div> -->
          </div>
        </div>
      </div>
      <!-- End .row -->
    </div>
    <!-- End .page-content-inner -->
  </div>
  <!-- / page-content-wrapper -->
</div>