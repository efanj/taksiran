<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>PEGANGAN YANG PERTAMA KALI DINILAI - JADUAL C</h4>
            </div>
            <div class="panel-body">
              <div id="jadualc" class="bwizard">
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
                  <li>
                    <a href="#tab3" data-toggle="tab">
                      <span class="step-number">3</span>
                      <span class="step-text">Pemilikan & Pemegang Harta</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="jadualC" method="post" style="font-size:13px;">
                  <div class="tab-content">
                    <div class="tab-pane active" id="tab1">
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Tarikh MJP :</label>
                        </div>
                        <div class="col-md-3">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control input-sm" id="mjc_tkhpl" name="mjcTkhpl" required>
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
                          <div class="control-label tal" id="mjc_tkhtk"></div>
                          <input type="hidden" name="mjcTkhtk" value="" id="mjcTkhtk" />
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Tarikh OC :</label>
                        </div>
                        <div class="col-md-2">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" class="form-control input-sm" data-language="en"
                              data-date-Format="dd/mm/yyyy" id="mjc_tkhoc" name="mjcTkhoc">
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun :</label>
                        </div>
                        <div class="col-md-2">
                          <input type="hidden" name="mjcAkaun" id="mjcAkaun" class="form-control input-sm" />
                          <input type="hidden" name="mjcDigit" id="mjcDigit" class="form-control input-sm" />
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">No. Siri :</label>
                        </div>
                        <div class="col-md-2">
                          <input type="hidden" name="mjcHsiri" id="mjcHsiri" class="form-control input-sm" />
                        </div>
                        <div class="col-md-3">
                          <label class="control-label">Sumbangan Membantu Kadar :</label>
                        </div>
                        <div class="col-md-1">
                          <div class="checkbox-custom">
                            <input type="checkbox" id="dummy_mjc_Stcbk" disabled>
                            <label for="dummy_mjc_Stcbk"></label>
                          </div>
                          <input type="hidden" id="mjc_Stcbk" name="mjcStcbk">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Akaun Lama :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="text" name="mjcOldac">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">No. Bil :</label>
                        </div>
                        <div class="col-md-2">
                          <input type="hidden" name="mjcNobil" id="mjcNobil" class="form-control input-sm" />
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. lot :</label>
                        </div>
                        <div class="col-md-4">
                          <input class="form-control input-sm" type="text" name="mjcNolot" id="mjc_nolot">
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                          <label class="control-label">Bil. Lot :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="number" name="mjcBllot" maxlength="2">
                        </div>
                      </div>

                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Jalan :</label>
                        </div>
                        <div class="col-md-4">
                          <div class="input-group input-group-sm">
                            <input type="hidden" class="form-control input-sm" id="mjc_jlkod" name="mjcJlkod">
                            <input type="text" class="form-control input-sm" id="dummy_mjc_jlkod">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-toggle="modal"
                                data-target="#street_popup"><i class="fa fa-book"></i></button>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                          <label class="control-label">Kawasan :</label>
                        </div>
                        <div class="col-md-2">
                          <input type="hidden" name="kawKwkod" id="kawKwkod">
                          <div class="control-label fl" id="mjc_kwkod"></div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Alamat :</label>
                        </div>
                        <div class="col-md-4">
                          <input class="form-control input-sm" type="text" name="mjcAdpg1" maxlength="50">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-4">
                          <input class="form-control input-sm" type="text" name="mjcAdpg2" maxlength="50">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Kegunaan Tanah :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $htanah = $this->controller->elements->htanah(); ?>
                          <select class="form-control input-sm" name="mjcThkod" required>
                            <option value="" selected>Sila Pilih</option>
                            <?php foreach ($htanah as $row) { ?>
                            <option value="<?= $row["tnh_thkod"] ?>"><?= $row["tnh_tnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Jenis Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hbangn = $this->controller->elements->hbangn(); ?>
                          <select class="form-control input-sm" name="mjcBgkod">
                            <option value="" selected>Sila Pilih</option>
                            <?php foreach ($hbangn as $row) { ?>
                            <option value="<?= $row["bgn_bgkod"] ?>"><?= $row["bgn_bnama"] ?></option>
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
                          <select class="form-control input-sm" name="mjcHtkod" id="mjcHtkod" required>
                            <option value="" selected>Sila Pilih</option>
                            <?php foreach ($hharta as $row) { ?>
                            <option value="<?= $row["hrt_htkod"] ?>"><?= $row["hrt_hnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Struktur Bangunan :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hstbgn = $this->controller->elements->hstbgn(); ?>
                          <select class="form-control input-sm" name="mjcStkod">
                            <option value="" selected>Sila Pilih</option>
                            <?php foreach ($hstbgn as $row) { ?>
                            <option value="<?= $row["stb_stkod"] ?>"><?= $row["stb_snama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Jenis Pemilik :</label>
                        </div>
                        <div class="col-md-4">
                          <?php $hjenpk = $this->controller->elements->hjenpk(); ?>
                          <select class="form-control input-sm" name="mjcJpkod" onchange="semakSumbangan(this.value)">
                            <option value="" selected>Sila Pilih</option>
                            <?php foreach ($hjenpk as $row) { ?>
                            <option value="<?= $row["jpk_jpkod"] ?>"><?= $row["jpk_jnama"] ?></option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="row mb10">
                        <div class="col-md-2">
                          <label class="control-label">Koordinat GPS (X) :</label>
                        </div>
                        <div class="col-md-4">
                          <input class="form-control input-sm" type="text" name="mjcCodex" id="mjc_codex" required>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Koordinat GPS (Y) :</label>
                        </div>
                        <div class="col-md-4">
                          <input class="form-control input-sm" type="text" name="mjcCodey" id="mjc_codey" required>
                        </div>
                      </div>
                      <!-- End .control-group  -->
                    </div>
                    <div class="tab-pane" id="tab2">
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Diskaun :</label>
                        </div>
                        <div class="col-md-2">
                          <div class="input-group input-group-sm">
                            <input type="number" class="form-control input-sm" id="mjc_diskn" name="mjcDiskn"
                              maxlength="3">
                            <span class="input-group-addon">%</span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Caj Sampah :</label>
                        </div>
                        <div class="col-md-2">
                          <div class="input-group input-group-sm">
                            <span class="input-group-addon">RM</span>
                            <input type="number" class="form-control input-sm" name="mjcSmpah" maxlength="9">
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. PT :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="text" name="mjcNompt" id="mjc_nompt">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Rujukan Fail :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="text" name="mjcRjfil">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">No. Pelan :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="text" name="mjcPelan" id="mjc_pelan"
                            maxlength="10">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">No. Hak Milik :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="text" name="mjcHkmlk">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Bil. Pemilik :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="number" name="mjcBilpk" maxlength="16">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Rujukan MMK :</label>
                        </div>
                        <div class="col-md-2">
                          <input class="form-control input-sm" type="text" name="mjcRjmmk" maxlength="15">
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Luas Bangunan :</label>
                        </div>
                        <div class="col-md-2">
                          <div class="input-group input-group-sm">
                            <input type="number" class="form-control input-sm" id="mjc_lsbgn" name="mjcLsbgn" min="0"
                              value="0" step=".01">
                            <span class="input-group-addon">m&sup2;</span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Tanah :</label>
                        </div>
                        <div class="col-md-2">
                          <div class="input-group input-group-sm">
                            <input type="number" class="form-control input-sm" id="mjc_lstnh" name="mjcLstnh" min="0"
                              value="0" step=".01">
                            <span class="input-group-addon">m&sup2;</span>
                          </div>
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">Luas Ansolari :</label>
                        </div>
                        <div class="col-md-2">
                          <div class="input-group input-group-sm">
                            <input type="number" class="form-control input-sm" id="mjc_lsans" name="mjcLsans" min="0"
                              value="0" step=".01">
                            <span class="input-group-addon">m&sup2;</span>
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Sebab-sebab :</label>
                        </div>
                        <div class="col-md-6">
                          <div class="input-group input-group-sm">
                            <input type="hidden" id="mjc_sbkod" name="mjcSbkod">
                            <input type="text" class="form-control input-sm" id="dummy_mjc_sbkod">
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-toggle="modal"
                                data-target="#reason_popup"><i class="fa fa-book"></i></button>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="form-label">Catatan :</label>
                        </div>
                        <div class="col-md-10">
                          <input class="form-control input-sm" type="text" name="mjcMesej">
                        </div>
                      </div>
                      <div class="row mt10 mb10">
                        <div class="col-md-2">
                          <label class="control-label tal">Pegawai Pendaftar :</label>
                        </div>
                        <div class="col-md-4 tal"><label class="control-label"><b><?= $info["workerid"] ?> -
                              <?= $info["name"] ?></b></label>
                        </div>
                      </div>
                    </div>
                    <div class="tab-pane" id="tab3">
                      <div class="page-header">
                        <h4><strong>Pemilikan</strong></h4>
                      </div>
                      <div class="row mb15">
                        <div class="col-md-2">
                          <label class="control-label">Nama Di Bil :</label>
                        </div>
                        <div class="col-md-10">
                          <input class="form-control input-sm" type="text" name="mjcNmbil" id="mjc_nmbil">
                        </div>
                      </div>
                      <div class="page-header">
                        <h4><strong>Pemegang Harta</strong></h4>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">ID Pelanggan :</label>
                        </div>
                        <div class="col-md-3">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control input-sm" id="mjc_plgid" name="mjcPlgid" readonly>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-toggle="modal"
                                data-target="#customer_popup"><i class="fa fa-book"></i></button>
                            </span>
                          </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2">
                          <label class="control-label">ID Alamat :</label>
                        </div>
                        <div class="col-md-3">
                          <div class="input-group input-group-sm">
                            <input type="text" class="form-control input-sm" id="mjc_amtid" name="mjcAmtid" readonly>
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" data-toggle="modal"
                                data-target="#customeraddress_popup"><i class="fa fa-book"></i></button>
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="row mb5">
                        <div class="col-md-2">
                          <label class="control-label">Nama Pemilik :</label>
                        </div>
                        <div class="col-md-10 control-label tal" id="nama_pemilik"></div>
                      </div>
                      <div class="row mb10">
                        <div class="col-md-2">
                          <label class="control-label">Alamat Pemilik :</label>
                        </div>
                        <div class="col-md-10 control-label tal" id="alamat_pemilik"></div>
                        <div class="row">
                          <div class="col-md-2">
                            <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken() ?>" />
                          </div>
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

<div class="modal fade" id="calc_button_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="btn-group">
              <button type="button" class="btn btn-default">Left</button>
              <button type="button" class="btn btn-default">Middle</button>
              <button type="button" class="btn btn-default">Right</button>
              <button type="button" class="btn btn-default">Left</button>
              <button type="button" class="btn btn-default">Middle</button>
              <button type="button" class="btn btn-default">Right</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>