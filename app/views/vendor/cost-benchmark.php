<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $kws = $this->controller->elements->area(); ?>
      <?php $hbangn = $this->controller->elements->hbangn(); ?>
      <div class="row">
        <div class="col-lg-7 col-sm-7 col-md-7">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>Senarai Aras Nilaian - Kadar Kos</h4>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="cost-benchmark" class="table table-bordered"
                  style="border-collapse: collapse; border-spacing: 0;">
                  <thead>
                    <tr>
                      <th width="5%"></th>
                      <th width="18%">
                        No. Akaun<br>
                        Nama Pemilik
                      </th>
                      <th width="17%">
                        Jalan/Taman<br>
                        Kawasan
                      </th>
                      <th width="18%">
                        Kegunaan Hartanah
                      </th>
                      <th width="18%">
                        Jenis Bangunan<br>
                        Bgn Utama/Luar
                      </th>
                      <th width="9%">Kadar Sewa (smp)</th>
                      <th width="20%">Keterangan</th>
                      <th class="nowrap" width="10%"></th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5">
          <div class="row">
            <div class="col-lg-12">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4>Kemasukan Aras Nilaian - Kadar Kos</h4>
                </div>
                <div class="panel-body">
                  <form class="form-horizontal" role="form" id="form-cost-benchmark" method="post">
                    <input type="hidden" name="ratetype" value="2">
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="col-sm-12 control-label">No. Akaun :</label>
                          <div class="col-sm-12">
                            <div class="input-group input-group-sm">
                              <input type="hidden" class="form-control input-sm" id="akaun" name="akaun">
                              <input type="text" class="form-control input-sm" id="dummy_akaun">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button" data-toggle="modal"
                                  data-target="#akaun_popup"><i class="fa fa-book"></i></button>
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-8">
                        <div class="form-group">
                          <label class="col-sm-12 control-label">Nama Pemilik :</label>
                          <div class="col-sm-12">
                            <input type="text" class="form-control input-sm" name="pemilik" id="pemilik" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-12 control-label">Jalan / Taman :</label>
                          <div class="col-sm-12">
                            <input type="hidden" name="jlkod" id="jlkod">
                            <input type="text" class="form-control input-sm" id="dummy_jlkod" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-12 control-label">Kawasan :</label>
                          <div class="col-sm-12">
                            <input type="hidden" name="kwkod" id="kwkod">
                            <input type="text" class="form-control input-sm" id="dummy_kwkod" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="col-sm-12 control-label">Jenis Hartanah :</label>
                          <div class="col-sm-12">
                            <input type="hidden" name="htkod" id="htkod">
                            <input type="text" class="form-control input-sm" id="dummy_htkod" readonly>
                          </div>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <button id="add-cost" class="btn btn-primary btn-xs mb5" type="button">Add row</button>
                    <table class="table table-bordered cost" style="font-size:13px;">
                      <thead>
                        <tr>
                          <th style="width:20%">Jenis Bangunan</th>
                          <th style="width:20%">Bangunan</th>
                          <th style="width:20%">Sewa smp (RM)</th>
                          <th style="width:40%">Keterangan</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody id="cost-table">
                        <tr id="0">
                          <td>
                            <select class="form-control input-sm" name="items_cost[0][bgtype]" id="bgtype" required>
                              <option value="0" selected>Sila Pilih</option>
                              <?php foreach ($hbangn as $row) { ?>
                              <option value="<?= $row["bgn_bgkod"] ?>"><?= $row["bgn_bnama"] ?></option>
                              <?php } ?>
                            </select>
                          </td>
                          <td>
                            <select class="form-control input-sm" name="items_cost[0][bgside]" id="bgside" required>
                              <option value="0" selected>Sila Pilih</option>
                              <option value="1">MFA</option>
                              <option value="2">AFA</option>
                            </select>
                          </td>
                          <td>
                            <input type="number" class="form-control input-sm" name="items_cost[0][costprice]" value="0"
                              min="0.00" max="10000.00" step="0.01">
                          </td>
                          <td>
                            <input type="text" class="form-control input-sm" name="items_cost[0][costnote]">
                          </td>
                          <td></td>
                        </tr>
                      </tbody>
                    </table>
                    <hr>
                    <div class="row mt5">
                      <div class="col-md-12 tar">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-save"></i> Simpan</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End .row -->
    </div>
    <!-- End .page-content-inner -->
  </div>
  <!-- / page-content-wrapper -->
</div>

<div class="modal fade" id="akaun_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">SENARAI AKAUN</h4>
      </div>
      <div class="modal-body">
        <?php
        $data = $this->controller->elements->accounttable();
        echo $this->render(Config::get("VIEWS_PATH") . "elements/account.php", ["data" => $data]);
        ?>
      </div>
    </div>
  </div>
</div>