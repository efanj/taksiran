<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <?php $hacmja = $this->controller->account->getAccountInfo($fileId); ?>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>PEGANGAN YANG DIHAPUS - JADUAL A</h4>
            </div>
            <div class="panel-body">
              <form class="form-horizontal" role="form" id="form-jadualA" method="post" style="font-size:13px;">
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Tarikh MJP :</label>
                  </div>
                  <div class="col-md-3">
                    <div class="input-group input-group-sm">
                      <input type="text" class="form-control input-sm" id="mja_tkhpl" name="mjaTkhpl" required>
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
                    <div class="control-label tal" id="mja_tkhtk"></div>
                    <input type="hidden" name="mjaTkhtk" id="mjaTkhtk" />
                  </div>
                  <div class="col-md-3">
                    <label class="control-label">Tarikh OC :</label>
                  </div>
                  <div class="col-md-1">
                    <div class="control-label tal" id="mja_tkhoc"></div>
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label">No. Akaun :</label>
                  </div>
                  <div class="col-md-4 control-label tal">
                    <?= $hacmja["peg_akaun"] ?>
                    <input type="hidden" name="mjaAkaun" id="mjaAkaun" value="<?= $hacmja["peg_akaun"] ?>" />
                    <input type="hidden" name="mjaDigit" id="mjaDigit" value="<?= $hacmja["peg_digit"] ?>" />
                  </div>
                  <div class="col-md-2"></div>
                  <div class="col-md-3">
                    <label class="control-label">No. Siri :</label>
                  </div>
                  <div class="col-md-1 control-label tal">
                    <input type="hidden" name="mjaStatf" id="mjaStatf" value="" />
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label">Nama Di Bil :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["pmk_nmbil"] ?></div>
                  <div class="col-md-2"></div>
                  <div class="col-md-3">
                    <label class="control-label tal">Sumbangan Membantu Kadar :</label>
                  </div>
                  <div class="col-md-1">
                    <div class="checkbox-custom">
                      <input type="checkbox" id="dummy_mja_Stcbk" <?php if ($hacmja["peg_stcbk"] === "Y") {
                                                                    echo "checked";
                                                                  } ?>disabled>
                      <label for="dummy_mja_Stcbk"></label>
                    </div>
                    <input type="hidden" id="mja_Stcbk" name="mjaStcbk" value="<?= $hacmja["peg_stcbk"] ?>">
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">No. lot :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["peg_nolot"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Jalan :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["jln_jnama"] ?></div>
                </div>
                <div class="row mb3">
                  <div class="col-md-2">
                    <label class="control-label tal">Alamat :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["adpg1"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Kawasan :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["jln_knama"] ?></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["adpg2"] ?></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["adpg3"] ?>
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["adpg4"] ?>
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">Kegunaan Tanah :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["tnh_tnama"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Jenis Bangunan :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["bgn_bnama"] ?></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">Kegunaan Hartanah :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["hrt_hnama"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Struktur Bangunan :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["stb_snama"] ?></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">Jenis Pemilik :</label>
                  </div>
                  <div class="col-md-4 control-label tal"><?= $hacmja["jpk_jnama"] ?></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">Koordinat GPS (X) :</label>
                  </div>
                  <div class="col-md-4 control-label tal">
                    <div id="codex"><?= $hacmja["peg_codex"] ?></div>
                  </div>
                  <div class="col-md-2">
                    <label class="control-label tal">Koordinat GPS (Y) :</label>
                  </div>
                  <div class="col-md-4 control-label tal">
                    <div id="codey"><?= $hacmja["peg_codey"] ?></div>
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">Nilai Tahunan :</label>
                  </div>
                  <div class="col-md-2 control-label tal"> RM <?= $hacmja["peg_nilth"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Kadar :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["kaw_kadar"] ?> %</div>
                  <div class="col-md-2">
                    <label class="control-label tal">Cukai Taksiran :</label>
                  </div>
                  <div class="col-md-2 control-label tal">RM
                    <?= number_format(($hacmja["peg_nilth"] * $hacmja["kaw_kadar"]) / 100, 2) ?> </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">Diskaun :</label>
                  </div>
                  <div class="col-md-4"><label class="control-label tal"> %</label></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">No. PT :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_nompt"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Rujukan Fail :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_rjfil"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">No. Pelan :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_pelan"] ?></div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label tal">No. Hak Milik :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_bilpk"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Bil.Pemilik :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_bilpk"] ?></div>
                  <div class="col-md-2">
                    <label class="control-label tal">Rujukan MMK :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_rjmmk"] ?></div>
                </div>
                <div class="row mb10">
                  <div class="col-md-2">
                    <label class="control-label tal">Luas Bangunan :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_lsbgn"] ?> m&sup2;</div>
                  <div class="col-md-2">
                    <label class="control-label tal">Luas Tanah :</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_lstnh"] ?> m&sup2;</div>
                  <div class="col-md-2">
                    <label class="control-label tal">Luas Ansolari:</label>
                  </div>
                  <div class="col-md-2 control-label tal"><?= $hacmja["peg_lsans"] ?> m&sup2;</div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label">Sebab-sebab :</label>
                  </div>
                  <div class="col-md-6">
                    <div class="input-group input-group-sm">
                      <input type="hidden" id="mja_sbkod" name="mjaSbkod">
                      <input type="text" class="form-control input-sm" id="dummy_mja_sbkod">
                      <span class="input-group-btn">
                        <button class="btn btn-default" type="button" data-toggle="modal" data-target="#reason_popup"><i
                            class="fa fa-book"></i></button>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="row mb2">
                  <div class="col-md-2">
                    <label class="control-label">Catatan :</label>
                  </div>
                  <div class="col-md-10">
                    <input class="form-control input-sm" type="text" name="mjaMesej">
                  </div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2">
                    <label class="control-label tal">Pegawai Pendaftar :</label>
                  </div>
                  <div class="col-md-4 tal"><label class="control-label"><b><?= $info["workerid"] ?> -
                        <?= $info["name"] ?></b></label>
                  </div>
                </div>
                <hr>
                <div class="row mb5">
                  <div class="col-md-12 tar">
                    <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
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
          <tbody></tbody>
        </table>
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
        <table class="table table-bordered" id="popup_reason" width="100%">
          <thead>
            <tr>
              <th>Kod Sebab</th>
              <th>Sebab-sebab</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>