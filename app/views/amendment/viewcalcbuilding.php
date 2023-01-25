<div class="page-content clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-4 col-sm-4 col-md-4">
          <?php $info = $this->controller->informations->getSubmitionInfo($siriNo); ?>
          <?php $calc = $this->controller->informations->getCalculationInfo($siriNo); ?>
          <?php $mfalength = sizeof($calc['mfa']); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MAKLUMAT PEGANGAN</h4>
            </div>
            <div class="panel-body">
              <table class="info" style="width:100%;font-size:13px;">
                <tr>
                  <td style="width:15%"><label class="control-label tal">No. Akaun</label></td>
                  <td style="width:2%">:</td>
                  <td style="width:15%"><?= $info["no_akaun"] ?></td>
                  <td><label class="control-label tal">IC Pemilik</label></td>
                  <td style="width:2%">:</td>
                  <td><?= $info["plgid"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Nama Pemilik</label></td>
                  <td>:</td>
                  <td colspan="4" style="width:48%"><?= $info["nmbil"] ?></td>
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
                </tr>
                <tr>
                  <td><label class="control-label tal">Kegunaan Tanah</label></td>
                  <td>:</td>
                  <td colspan="4"><?= $info["hnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Kegunaan Hartanah</label></td>
                  <td>:</td>
                  <td colspan="4"><?= $info["hnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Jenis Bangunan</label></td>
                  <td>:</td>
                  <td colspan="4"><?= $info["bnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Struktur Bangunan</label></td>
                  <td>:</td>
                  <td colspan="4"><?= $info["snama"] ?></td>
                </tr>
              </table>
            </div>
          </div>

        </div>
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>NILAIAN - BANGUNAN</h4>
            </div>
            <div class="panel-body">
              <div id="calc-building" class="bwizard">
                <!-- Start .bwizard -->
                <ul class="bwizard-steps">
                  <li class="active">
                    <a href="#tab1" data-toggle="tab">
                      <span class="step-number">1</span>
                      <span class="step-text">Perbandingan & Tanah</span>
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
                <form class="form-horizontal" role="form" id="calcBuilding" method="post">
                  <input type="hidden" name="siri_no" value="<?= $info["no_siri"] ?>">
                  <input type="hidden" name="akaun" value="<?= $info["no_akaun"] ?>">
                  <div class="tab-content">
                    <div class=" tab-pane active" id="tab1">
                      <div class="page-header">
                        <h4><strong>PERBANDINGAN</strong></h4>
                      </div>
                      <table class="table table-bordered comparison" style="font-size:13px;">
                        <thead>
                          <tr>
                            <th style="width:20%">Nama Taman</th>
                            <th style="width:15%">Jenis Bangunan</th>
                            <th>Keluasan</th>
                            <th style="width:10%">Nilai Tahunan</th>
                            <th style="width:15%">Sewa SMP(MFA)</th>
                            <th style="width:15%">Sewa SMP(AFA)</th>
                          </tr>
                        </thead>
                        <tbody id="comparison_table">
                          <?php foreach ($calc['comparison'] as $row) { ?>
                          <tr id="0">
                            <td>
                              <input type="hidden" name="comparison[]" id="comparison" value="<?= $row['id'] ?>">
                              <div class='control-label tal' id='jlname'><?= $row['jln_jnama'] ?></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='bgtype'><?= $row['bgn_bnama'] ?></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='breadth'><?= $row['peg_lsbgn'] ?></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='nilth'><?php echo "RM " . $row['peg_nilth'] ?></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='mfa'><?php echo "RM " . $row['mfa'] ?></div>
                            </td>
                            <td>
                              <div class='control-label tal' id='afa'><?php echo "RM " . $row['afa'] ?></div>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <div class="page-header">
                        <h4><strong>TANAH</strong></h4>
                      </div>
                      <table class="table table-bordered land">
                        <thead>
                          <tr>
                            <th style="width:30%"></th>
                            <th style="width:15%">Keluasan</th>
                            <th style="width:10%">Jenis</th>
                            <th></th>
                            <th style="width:15%">Nilai Unit</th>
                            <th style="width:10%">Jenis</th>
                            <th style="width:15%">Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td></td>
                            <td><?= $calc['land']["breadth"] ?></td>
                            <td>mp</td>
                            <td style="text-align:center">X</td>
                            <td><?= $calc['land']["price"] ?></td>
                            <td>smp</td>
                            <td>RM <?= $calc['land']["total"] ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab2">
                      <div class="page-header">
                        <h4><strong>BANGUNAN UTAMA</strong></h4>
                      </div>
                      <div class="section_one">
                        <?php foreach ($calc['mfa'] as $section) { ?>
                        <section id="<?= $section['id'] ?>">
                          <div class="form-group">
                            <label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara : </strong></label>
                            <div class="col-lg-10 col-md-9">
                              <?= $section['title'] ?>
                            </div>
                          </div>
                          <table class="table table-bordered one" id="zero" style="font-size:13px;">
                            <thead>
                              <tr>
                                <th style="width:30%">Perkara</th>
                                <th style="width:15%">Keluasan/Kuantiti</th>
                                <th style="width:10%">Jenis</th>
                                <th></th>
                                <th style="width:15%">Nilai Unit</th>
                                <th style="width:10%">Jenis</th>
                                <th style="width:15%">Jumlah</th>
                              </tr>
                            </thead>
                            <tbody id="zero">
                              <?php foreach ($section['items'] as $row) { ?>
                              <tr id="<?= $row['id'] ?>">
                                <td><?= $row['title'] ?></td>
                                <td><?= $row["breadth"] ?></td>
                                <td><?= $row["breadthtype"] ?></td>
                                <td style="text-align:center">X</td>
                                <td><?= $row['price'] ?></td>
                                <td><?= $row['pricetype'] ?>pricetype</td>
                                <td>RM <?= $row['total'] ?></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </section>
                        <?php } ?>
                      </div>
                      <table class="table mb10">
                        <tbody>
                          <tr>
                          <tr>
                            <td style="width:25%"></td>
                            <td style="width:15%"></td>
                            <td style="width:10%"></td>
                            <td></td>
                            <td style="width:15%"></td>
                            <td style="width:15%">Jumlah</td>
                            <td colspan="2">
                              <div class="input-group input-group-sm">
                                <span class="input-group-addon">RM</span>
                                <input type="text" class="form-control input-sm ttl_partly" id="overall_one"
                                  value="<?= $calc['totalmfa']; ?>" readonly>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab3">
                      <div class="page-header">
                        <h4><strong>BANGUNAN LUAR</strong></h4>
                      </div>
                      <div class="section_two">
                        <?php foreach ($calc['afa'] as $section2) { ?>
                        <section id="<?= $section2['id']; ?>">
                          <div class="form-group">
                            <label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara : </strong></label>
                            <div class="col-lg-10 col-md-9">
                              <?= $section2['title']; ?>
                            </div>
                          </div>
                          <table class="table table-bordered two" id="zero" style="font-size:13px;">
                            <thead>
                              <tr>
                                <th style="width:30%">Perkara</th>
                                <th style="width:15%">Keluasan/Kuantiti</th>
                                <th style="width:10%">Jenis</th>
                                <th></th>
                                <th style="width:15%">Nilai Unit</th>
                                <th style="width:10%">Jenis</th>
                                <th style="width:15%">Jumlah</th>
                              </tr>
                            </thead>
                            <tbody id="zero">
                              <?php foreach ($section2['items'] as $row) { ?>
                              <tr id="<?= $row['id'] ?>">
                                <td><?= $row['title'] ?></td>
                                <td><?= $row['breadth'] ?></td>
                                <td><?= $row['breadthtype'] ?></td>
                                <td style="text-align:center">X</td>
                                <td><?= $row['price'] ?></td>
                                <td><?= $row['pricetype'] ?></td>
                                <td>RM <?= $row['total'] ?></td>
                              </tr>
                              <?php } ?>
                            </tbody>
                          </table>
                        </section>
                        <?php } ?>
                      </div>
                      <table class="table mb10">
                        <tbody>
                          <tr>
                          <tr>
                            <td style="width:25%"></td>
                            <td style="width:15%"></td>
                            <td style="width:10%"></td>
                            <td></td>
                            <td style="width:15%"></td>
                            <td style="width:15%">Jumlah</td>
                            <td colspan="2">
                              <div class="input-group input-group-sm">
                                <span class="input-group-addon">RM</span>
                                <input type="text" class="form-control input-sm ttl_partly"
                                  value="<?= $calc['totalafa']; ?>" id="overall_two" readonly>
                              </div>
                            </td>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab4">
                      <div class="page-header">
                        <h4><strong>PENGIRAAN</strong></h4>
                      </div>
                      <table style="width:100%;font-size:13px;" class="calculator mb15">
                        <tr>
                          <td style="width:63%" colspan="2"><strong>ANGGARAN SEWA BULANAN</strong></td>
                          <td style="width:20%">
                            RM <span class="control-label tal" id="dummy_rental"><?= $calc['rental']; ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td style="width:65%"><strong>DISKAUN</strong></td>
                          <td><?= $calc['discount']; ?> %</td>
                          <td>RM
                            <span class="control-label tal" id="dummy_discount">
                              <?php if ($calc['discount'] < 1) {
                                echo $calc['rental'];
                              } else if ($calc['discount'] == "" || $calc['discount'] == 0 || $calc['discount'] >= 1) {
                                echo $calc['rental'] - ($calc['rental'] * ($calc['discount'] / 100));
                              }
                              ?>
                            </span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>SEWA BULANAN DIGENAPKAN</strong></td>
                          <td>RM <?= $calc['even']; ?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>TEMPOH TAHUNAN</strong></td>
                          <td>X 12 BULAN</td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>NILAI TAHUNAN</strong></td>
                          <td>
                            RM <span class="control-label tal" id="dummy_yearly"><?= $calc['yearly_price']; ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>KADAR</strong></td>
                          <td>
                            <span class="control-label tal" id="dummy_rate"><?= $calc["rate"] ?></span> %
                          </td>
                        </tr>
                        <tr>
                          <td colspan="2"><strong>CUKAI TAKSIRAN</strong></td>
                          <td>
                            <strong>RM</strong> <span class="control-label tal bold"
                              id="dummy_tax"><?= $calc["assessment_tax"] ?></span>
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
                  <li class="next finish" style="display:none;"><a href="#">Tamat</a>
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
          $data = $this->controller->informations->comparisontable("1", $info["kwkod"], $info["htkod"]);
          echo $this->render(Config::get("VIEWS_PATH") . "calculator/comparison.php", ["data" => $data]);
          ?>
        </div>
      </div>
    </div>
  </div>