<div class="page-content clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <?php $hacmjb = $this->controller->account->viewamendBdetail($siriNo); ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>PEGANGAN YANG DIPINDA NILAI TAHUNAN - JADUAL B</h4>
            </div>
            <div class="panel-body">
              <div id="jadualb" class="bwizard">
                <!-- Start .bwizard -->
                <ul class="bwizard-steps">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab">
                      <span class="step-number">1</span>
                      <span class="step-text">Maklumat Akaun</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab2" data-toggle="tab">
                      <span class="step-number">2</span>
                      <span class="step-text">Maklumat Rujukan</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="jadualB" method="post" style="font-size:13px;">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Tarikh MJP :</label>
                        </div>
                        <div class="col-md-3">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control input-sm" id="mjb_tkhpl" name="mjbTkhpl"
                              value="<?= $hacmjb["mjb_tkhpl"] ?>" required>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-toggle="modal"
                                data-target="#mesyuarat_popup">
                                <i class="fa fa-book"></i>
                              </button>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Tarikh K/Kuasa :</label>
                        </div>
                        <div class="col-md-1 tal">
                          <div class="control-label tal" id="mjb_tkhtk"><?= $hacmjb["mjb_tkhtk"] ?></div>
                          <input type="hidden" name="mjbTkhtk" id="mjbTkhtk" value="<?= $hacmjb["mjb_tkhtk"] ?>" />
                        </div>
                        <div class="col-md-3">
                          <label class="control-label">Tarikh OC :</label>
                        </div>
                        <div class="col-md-1">
                          <div class="control-label tal" id="mjb_tkhoc"></div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["mjb_akaun"] ?>
                          <input type="hidden" name="mjbAkaun" id="mjbAkaun" value="<?= $hacmjb["mjb_akaun"] ?>" />
                          <input type="hidden" name="mjbDigit" id="mjbDigit" value="<?= $hacmjb["mjb_digit"] ?>" />
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                          <label class="control-label">No. Siri :</label>
                        </div>
                        <div class="col-md-1 control-label tal"><?= $hacmjb["mjb_nsiri"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun Lama :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["peg_oldac"] ?></div>
                        <div class="col-md-2"></div>
                        <div class="col-md-3">
                          <label class="control-label tal">Sumbangan Membantu Kadar :</label>
                        </div>
                        <div class="col-md-1">
                          <div class="checkbox-custom">
                            <input type="checkbox" id="dummy_mjb_Stcbk" <?php if ($hacmjb["mjb_stcbk"] === "Y") {
                              echo "checked";
                            } ?>disabled>
                            <label for="dummy_mjb_Stcbk"></label>
                          </div>
                          <input type="hidden" id="mjb_stcbk" name="mjbStcbk" value="<?= $hacmjb["mjb_stcbk"] ?>">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Nama Di Bil :</label>
                        </div>
                        <div class="col-md-10 control-label tal"><?= $hacmjb["pmk_nmbil"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. lot :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["peg_nolot"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Jalan :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["jln_jnama"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Alamat :</label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg1"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Kawasan :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["jln_knama"] ?>
                          <input type="hidden" value="<?= $hacmjb["kaw_kwkod"] ?>" name="kawKwkod" id="kawKwkod">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label"></label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg2"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label"></label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg3"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label"></label>
                        </div>
                        <div class="col-md-4 control-label tal"><?= $hacmjb["adpg4"] ?></div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Kegunaan Tanah :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $htanah = $this->controller->elements->htanah(); ?>
                          <select class="form-control input-sm" name="mjbThkod">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($htanah as $row) { ?>
                            <option <?php if ($row["tnh_thkod"] == $hacmjb["mjb_thkod"]) {
                              echo "selected";
                            } ?> value="<?= $row["tnh_thkod"] ?>"><?= $row["tnh_tnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Jenis Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hbangn = $this->controller->elements->hbangn(); ?>
                          <select class="form-control input-sm" name="mjbBgkod">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($hbangn as $row) { ?>
                            <option <?php if ($row["bgn_bgkod"] == $hacmjb["mjb_bgkod"]) {
                              echo "selected";
                            } ?> value="<?= $row["bgn_bgkod"] ?>"><?= $row["bgn_bnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Kegunaan Hartanah :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hharta = $this->controller->elements->hharta(); ?>
                          <select class="form-control input-sm" id="mjb_htkod" name="mjbHtkod"
                            onchange="semakKadar(this.value)">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($hharta as $row) { ?>
                            <option <?php if ($row["hrt_htkod"] == $hacmjb["mjb_htkod"]) {
                              echo "selected";
                            } ?> value="<?= $row["hrt_htkod"] ?>"><?= $row["hrt_hnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Struktur Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hstbgn = $this->controller->elements->hstbgn(); ?>
                          <select class="form-control input-sm" name="mjbStkod">
                            <option selected>Sila Pilih</option>
                            <?php foreach ($hstbgn as $row) { ?>
                            <option <?php if ($row["stb_stkod"] == $hacmjb["mjb_stkod"]) {
                              echo "selected";
                            } ?> value="<?= $row["stb_stkod"] ?>"><?= $row["stb_snama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>

                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Jenis Pemilik :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <?= $hacmjb["jpk_jnama"] ?>
                          <input type="hidden" name="mjbJpkod" value="<?= $hacmjb["mjb_jpkod"] ?>">
                        </div>
                      </div>
                      <div class="row mb15">
                        <div class="col-md-2">
                          <label class="control-label">Koordinat GPS
                            (X) :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <div id="codex"><?= $hacmjb["peg_codex"] ?></div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Koordinat GPS
                            (Y) :</label>
                        </div>
                        <div class="col-md-4 control-label tal">
                          <div id="codey"><?= $hacmjb["peg_codey"] ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <div class="row mb-1">
                        <div class="col-md-2">
                          <label class="control-label">Diskaun :</label>
                        </div>
                        <div class="col-md-4 control-label tal">%</div>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-2">
                          <label class="control-label">No. PT :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_nompt"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Rujukan Fail :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_rjfil"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">No. Pelan :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_pelan"] ?></div>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-2">
                          <label class="control-label">No. Hak Milik :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["pmk_hkmlk"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Bil.Pemilik :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_bilpk"] ?></div>
                        <div class="col-md-2">
                          <label class="control-label">Rujukan MMK :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_rjmmk"] ?></div>
                      </div>
                      <div class="row mb-1">
                        <div class="col-md-2">
                          <label class="control-label">Luas Bangunan :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lsbgn"] ?> m&sup2;</div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Tanah :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lstnh"] ?> m&sup2;
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Ansolari :</label>
                        </div>
                        <div class="col-md-2 control-label tal"><?= $hacmjb["peg_lsans"] ?> m&sup2;</div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Sebab-sebab :</label>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group input-group-sm">
                            <input type="hidden" id="mjb_sbkod" name="mjbSbkod" value="<?= $hacmjb["mjb_sbkod"] ?>">
                            <input type="text" class="form-control input-sm" id="dummy_mjb_sbkod"
                              value="<?= $hacmjb["mjb_sbkod"] ?>">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-toggle="modal"
                                data-target="#reason_popup"><i class="fa fa-book"></i></button>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Catatan :</label>
                        </div>
                        <div class="col-md-10">
                          <input class="form-control input-sm" type="text" name="mjbMesej"
                            value="<?= $hacmjb["mjb_mesej"] ?>">
                        </div>
                      </div>
                      <div class="row mt10 mb10">
                        <div class="col-md-2">
                          <label class="control-label tal">Pegawai Pendaftar :</label>
                        </div>
                        <div class="col-md-4 tal"><label class="control-label"><b><?= $hacmjb["mjb_onama"] ?> -
                              <?= $hacmjb["name"] ?></b></b></label>
                        </div>
                        <div class="col-md-2">
                          <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>" />
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
                <ul class="pager">
                  <li class="previous"><a href="#">&larr; Sebelumnya</a>
                  </li>
                  <li class="next"><a href="#">Seterusnya &rarr;</a>
                  </li>
                  <li class="next finish" style="display:none;"><a href="#">Simpan</a>
                  </li>
                </ul>
              </div>
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

<div class="modal fade" id="mesyuarat_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI TARIKH MESYUARAT</h4>
      </div>
      <div class="modal-body">
        <?php
        $data = $this->controller->elements->meetingtable();
        echo $this->render(Config::get("VIEWS_PATH") . "elements/meeting.php", ["data" => $data]);
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="street_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI JALAN</h4>
      </div>
      <div class="modal-body">
        <?php
        $data = $this->controller->elements->streettable();
        echo $this->render(Config::get("VIEWS_PATH") . "elements/street.php", ["data" => $data]);
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="reason_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI SEBAB-SEBAB</h4>
      </div>
      <div class="modal-body">
        <?php
        $data = $this->controller->elements->reasontable();
        echo $this->render(Config::get("VIEWS_PATH") . "elements/reason.php", ["data" => $data]);
        ?>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="customer_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI PELANGGAN</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="popup_customer" width="100%">
          <thead>
            <tr>
              <th>Pelanggan ID</th>
              <th>Nama Pelanggan</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="customeraddress_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">SENARAI ALAMAT</h4>
      </div>
      <div class="modal-body">
        <table class="table table-bordered" id="popup_customeraddress" width="100%">
          <thead>
            <tr>
              <th>Pelanggan ID</th>
              <th>Nama Pelanggan</th>
              <th>Alamat</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>