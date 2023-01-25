<div class="page-content clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8 col-lg-offset-2 col-sm-offset-2 col-md-offset-2">
          <?php $info = $this->controller->informations->getSubmitionInfo($siriNo); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>NILAIAN - KEDIAMAN</h4>
            </div>
            <div class="panel-body">
              <table style="width:100%;font-size:13px;">
                <tr>
                  <td style="width:15%"><label class="control-label tal">No. Akaun</label></td>
                  <td style="width:2%">:</td>
                  <td style="width:15%"><?= $info["no_akaun"] ?></td>
                  <td><label class="control-label tal">IC Pemilik</label></td>
                  <td style="width:2%">:</td>
                  <td><?= $info["plgid"] ?></td>
                  <td><label class="control-label tal">Kegunaan Tanah</label></td>
                  <td style="width:2%">:</td>
                  <td><?= $info["tnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Nama Pemilik</label></td>
                  <td>:</td>
                  <td colspan="4" style="width:48%"><?= $info["nmbil"] ?></td>
                  <td><label class="control-label tal">Kegunaan Hartanah</label></td>
                  <td>:</td>
                  <td><?= $info["hnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Alamat Harta</label></td>
                  <td>:</td>
                  <td colspan="4">
                    <?php
                    if ($info["adpg1"] != "") {
                      echo $info["adpg1"] . ", ";
                    }
                    if ($info["adpg2"] != "" && $info["adpg2"] != "-") {
                      echo $info["adpg2"] . ", ";
                    }
                    if ($info["adpg3"] != "" && $info["adpg3"] != "-") {
                      echo $info["adpg3"] . ", ";
                    }
                    if ($info["adpg4"] != "" && $info["adpg4"] != "-") {
                      echo $info["adpg4"];
                    }
                    ?>
                  </td>
                  <td><label class="control-label tal">Jenis Bangunan</label></td>
                  <td>:</td>
                  <td><?= $info["bnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Alamat Surat Menyurat</label></td>
                  <td>:</td>
                  <td colspan="4">
                    <?php
                    if ($info["almt1"] != "") {
                      echo $info["almt1"] . ", ";
                    }
                    if ($info["almt2"] != "" && $info["almt2"] != "-") {
                      echo $info["almt2"] . ", ";
                    }
                    if ($info["almt3"] != "" && $info["almt3"] != "-") {
                      echo $info["almt3"] . ", ";
                    }
                    if ($info["almt4"] != "" && $info["almt4"] != "-") {
                      echo $info["almt4"] . ", ";
                    }
                    if ($info["almt5"] != "" && $info["almt5"] != "-") {
                      echo $info["almt5"];
                    }
                    ?>
                  </td>
                  <td><label class="control-label tal">Struktur Bangunan</label></td>
                  <td>:</td>
                  <td><?= $info["snama"] ?></td>
                </tr>
              </table>
              <hr class="mdpt">
              <div id="calc-residence" class="bwizard">
                <!-- Start .bwizard -->
                <ul class="bwizard-steps">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab">
                      <span class="step-number">1</span>
                      <span class="step-text">Perbandingan</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab2" data-toggle="tab">
                      <span class="step-number">2</span>
                      <span class="step-text">Bangunan Utama</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab3" data-toggle="tab">
                      <span class="step-number">3</span>
                      <span class="step-text">Bangunan Luar</span>
                    </a>
                  </li>
                  <li>
                    <a href="#tab4" data-toggle="tab">
                      <span class="step-number">4</span>
                      <span class="step-text">Pengiraan</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="calcResidence" method="post">
                  <input type="hidden" name="siri_no" value="<?= $info["no_siri"] ?>">
                  <input type="hidden" name="akaun" value="<?= $info["no_akaun"] ?>">
                  <div class="tab-content">
                    <div class=" tab-pane active" id="tab1">
                      <div class="page-header">
                        <h4><strong>PERBANDINGAN</strong></h4>
                      </div>
                      <button id="add-comparison" class="btn btn-primary btn-sm mb5" type="button">Add row</button>
                      <table class="table table-bordered comparison" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th></th>
                            <th style="width:20%">Nama Taman</th>
                            <th style="width:15%">Jenis Bangunan</th>
                            <th>Keluasan</th>
                            <th style="width:10%">Nilai Tahunan</th>
                            <th style="width:15%">Sewa SMP(MFA)</th>
                            <th style="width:15%">Sewa SMP(AFA)</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="comparison_table">
                          <tr id="0">
                            <td><button class="btn btn-primary btn-xs" id="add" type="button"><i
                                  class="fa fa-plus"></i></button></td>
                            <td>
                              <input type="hidden" name="comparison[]" id="comparison">
                              <div class='control-label tal' id='jlname'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='bgtype'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='breadth'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='nilth'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='mfa'></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='afa'></div>
                            </td>
                            <td><button class="btn btn-danger btn-xs" id="delete" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <div class="page-header">
                        <h4><strong>BANGUNAN UTAMA</strong></h4>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>
                        <div class="col-lg-10 col-md-9">
                          <input type="text" class="form-control input-sm" name="main_title">
                        </div>
                      </div>
                      <button id="add-one" class="btn btn-primary btn-sm mb5" type="button">Add row</button>
                      <table class="table table-bordered one" id="table_one" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th style="width:30%">Perkara</th>
                            <th style="width:15%">Keluasan/Kuantiti</th>
                            <th style="width:10%">Jenis</th>
                            <th></th>
                            <th style="width:15%">Nilai Unit</th>
                            <th style="width:10%">Jenis</th>
                            <th style="width:15%">Jumlah</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="one_table">
                          <tr id="0">
                            <td><input type="text" class="form-control input-sm" name="item_one[0][title_one]"></td>
                            <td><input type="number" class="form-control input-sm" name="item_one[0][breadth_one]"
                                id="breadth_one" value="<?= $info["ttl_bgn"] ?>"></td>
                            <td>
                              <select class="form-control input-sm" name="item_one[0][breadthtype_one]">
                                <option value="">Sila Pilih</option>
                                <option value="mp" selected>Meter</option>
                                <option value="ft">Kaki</option>
                                <option value="unit">Unit</option>
                                <option value="petak">Petak</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-sm" name="item_one[0][price_one]"
                                id="price_one" value="0"></td>
                            <td>
                              <select class="form-control input-sm" name="item_one[0][pricetype_one]">
                                <option value="">Sila Pilih</option>
                                <option value="smp" selected>Meter Persegi</option>
                                <option value="sft">Kaki Persegi</option>
                                <option value="p/unit">Per-Unit</option>
                                <option value="sepetak">Sepetak</option>
                              </select>
                            </td>
                            <td><input type="number" class="form-control input-sm ttl_partly"
                                name="item_one[0][total_one]" id="total_one" readonly></td>
                            <td></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="5"></th>
                            <th>Jumlah</th>
                            <th colspan="2">
                              <div class="input-group input-group-sm">
                                <span class="input-group-addon">RM</span>
                                <input type="text" class="form-control input-sm" id="overall_one" readonly>
                              </div>
                            </th>
                          </tr>
                        </tfoot>
                      </table>

                    </div>
                    <div class="tab-pane" id="tab3">
                      <div class="page-header">
                        <h4><strong>BANGUNAN LUAR</strong></h4>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>
                        <div class="col-lg-10 col-md-9">
                          <input type="text" class="form-control input-sm" name="external_title">
                        </div>
                      </div>
                      <button id="add-two" class="btn btn-primary btn-sm mb5" type="button">Add row</button>
                      <table class="table table-bordered two" id="table_two" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th style="width:30%">Perkara</th>
                            <th style="width:15%">Keluasan/Kuantiti</th>
                            <th style="width:10%">Jenis</th>
                            <th></th>
                            <th style="width:15%">Nilai Unit</th>
                            <th style="width:10%">Jenis</th>
                            <th style="width:15%">Jumlah</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody id="two_table">
                          <tr id="0">
                            <td><input type="text" class="form-control input-sm" name="item_two[0][title_two]"></td>
                            <td><input type="number" class="form-control input-sm" name="item_two[0][breadth_two]"
                                id="breadth_two" value="<?= $info["ttl_ans"] ?>"></td>
                            <td>
                              <select class="form-control input-sm" name="item_two[0][breadthtype_two]">
                                <option selected>Sila Pilih</option>
                                <option value="mp">Meter</option>
                                <option value="ft">Kaki</option>
                                <option value="unit">Unit</option>
                                <option value="petak">Petak</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="number" class="form-control input-sm" name="item_two[0][price_two]"
                                id="price_two" value="0"></td>
                            <td>
                              <select class="form-control input-sm" name="item_two[0][pricetype_two]">
                                <option value="" selected>Sila Pilih</option>
                                <option value="smp">Meter Persegi</option>
                                <option value="sft">Kaki Persegi</option>
                                <option value="p/unit">Per-Unit</option>
                                <option value="sepetak">Sepetak</option>
                              </select>
                            </td>
                            <td><input type="number" class="form-control input-sm ttl_partly"
                                name="item_two[0][total_two]" id="total_two" readonly></td>
                            <td></td>
                          </tr>
                        </tbody>
                        <tfoot>
                          <tr>
                            <th colspan="5"></th>
                            <th>Jumlah</th>
                            <th colspan="2">
                              <div class="input-group input-group-sm">
                                <span class="input-group-addon">RM</span>
                                <input type="text" class="form-control input-sm" id="overall_two" readonly>
                              </div>
                            </th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab4">
                      <div class="page-header">
                        <h4><strong>PENGIRAAN</strong></h4>
                      </div>
                      <table style="width:100%;font-size:13px;" class="calculator mb15">
                        <tr>
                          <td style="width:63%"><strong>ANGGARAN SEWA BULANAN</strong></td>
                          <td style="width:17%">
                            <div class="input-group input-group-sm">
                              <input type="number" class="form-control input-sm" name="discount" id="discount"
                                placeholder="Diskaun">
                              <span class=" input-group-addon">%</span>
                            </div>
                          </td>
                          <td style="width:20%">
                            <input type="hidden" name="rental" id="rental">
                            RM <span class="control-label tal" id="dummy_rental"></span>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>
                            <div class="checkbox-custom">
                              <input type="checkbox" id="dummy_corner">
                              <label for="corner">Corner Lot 10%</label>
                            </div>
                            <input type="hidden" id="corner" name="corner" value="false">
                          </td>
                          <td>
                            RM <span class="control-label tal" id="value_corner"></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>SEWA BULANAN DIGENAPKAN</strong></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon">RM</span>
                              <input type="number" class="form-control input-sm" name="even" id="even">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>TEMPOH TAHUNAN</strong></td>
                          <td>X 12 BULAN</td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                          <td>
                            <input type="hidden" name="yearly" id="yearly">
                            RM <span class="control-label tal" id="dummy_yearly"></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>KADAR</strong></td>
                          <td>
                            <input type="hidden" name="rate" value="<?= $info["kadar_asal"] ?>">
                            <span class="control-label tal" id="dummy_rate"><?= $info["kadar_asal"] ?></span> %
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>CUKAI TAKSIRAN</strong></td>
                          <td>
                            <input type="hidden" name="tax" id="tax">
                            <strong>RM</strong> <span class="control-label tal bold" id="dummy_tax"></span>
                          </td>
                        </tr>
                      </table>
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
      </div>
    </div>
  </div>

  <div class="modal fade" id="comparison_popup" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xlg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">SENARAI DATA PERBANDINGAN</h4>
        </div>
        <div class="modal-body">
          <?php
          $data = $this->controller->informations->comparisontable("1",$info["kwkod"],$info["htkod"]);
          echo $this->render(Config::get("VIEWS_PATH") . "calculator/comparison.php", ["data" => $data]);
          ?>
        </div>
      </div>
    </div>
  </div>