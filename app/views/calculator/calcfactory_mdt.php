<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8 col-lg-offset-2 col-sm-offset-2 col-md-offset-2">
          <?php $info = $this->controller->informations->getSubmitionInfo($siriNo); ?>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>NILAIAN - KILANG</h4>
            </div>
            <div class="panel-body">
              <table style="width:100%">
                <tr>
                  <td style="width:15%"><label class="control-label tal">No. Akaun</label></td>
                  <td style="width:2%">:</td>
                  <td style="width:15%"><?= $info["no_akaun"] ?></td>
                  <td><label class="control-label tal">IC Pemilik</label></td>
                  <td style="width:2%">:</td>
                  <td><?= $info["plgid"] ?></td>
                  <td><label class="control-label tal">Jenis Harta</label></td>
                  <td style="width:2%">:</td>
                  <td><?= $info["hnama"] ?></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Nama Pemilik</label></td>
                  <td>:</td>
                  <td colspan="4" style="width:48%"><?= $info["nmbil"] ?></td>
                  <td></td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Alamat Harta</label></td>
                  <td>:</td>
                  <td colspan="4">
                    <address>
                      <?= $info["adpg1"] ?>,
                      <?= $info["adpg2"] ?>,
                      <?= $info["adpg3"] ?>,
                      <?= $info["adpg4"] ?>
                    </address>
                  </td>
                  <td></td>
                  <td>:</td>
                  <td></td>
                </tr>
                <tr>
                  <td><label class="control-label tal">Alamat Surat Menyurat</label></td>
                  <td>:</td>
                  <td colspan="4">
                    <address>
                      <?= $info["almt1"] ?>,
                      <?= $info["almt2"] ?>,
                      <?= $info["almt3"] ?>,
                      <?= $info["almt4"] ?>,
                      <?= $info["almt5"] ?></br>
                      <?= $info["notel"] ?>
                    </address>
                  </td>
                  <td></td>
                  <td>:</td>
                  <td></td>
                </tr>

              </table>
              <hr class="mdpt">
              <div id="calc-factory" class="bwizard">
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
                      <span class="step-text">Keseluruhan</span>
                    </a>
                  </li>
                </ul>
                <form class="form-horizontal" role="form" id="calcFactory" method="post">
                  <div class="tab-content">
                    <div class=" tab-pane active" id="tab1">
                      <div class="page-header">
                        <h4><strong>PERBANDINGAN</strong></h4>
                      </div>
                      <table class="table table-bordered comparison">
                        <thead>
                          <tr>
                            <th></th>
                            <th style="width:20%">Nama Taman</th>
                            <th style="width:15%">Jenis Bangunan</th>
                            <th style="width:20%">Lokasi</th>
                            <th>Keluasan</th>
                            <th style="width:10%">Nilai Tahunan</th>
                            <th style="width:15%">Sewa SMP(MFA)</th>
                            <th style="width:15%">Sewa SMP(AFA)</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><button class="btn btn-primary btn-xs" id="add" type="button"><i
                                  class="fa fa-plus"></i></button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-danger btn-xs" id="delete" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                          <tr>
                            <td><button class="btn btn-primary btn-xs" id="add" type="button"><i
                                  class="fa fa-plus"></i></button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-danger btn-xs" id="delete" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                          <tr>
                            <td><button class="btn btn-primary btn-xs" id="add" type="button"><i
                                  class="fa fa-plus"></i></button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-danger btn-xs" id="delete" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                          <tr>
                            <td><button class="btn btn-primary btn-xs" id="add" type="button"><i
                                  class="fa fa-plus"></i></button></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><button class="btn btn-danger btn-xs" id="delete" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="page-header">
                        <h4><strong>TANAH</strong></h4>
                      </div>
                      <table class="table table-bordered land">
                        <thead>
                          <tr>
                            <th style="width:30%"></th>
                            <th style="width:15%">Keluasan/Kuantiti</th>
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
                            <td><input type="text" class="form-control input-sm"></td>
                            <td>
                              <select class="form-control input-sm" name="mjbBgkod">
                                <option selected>Sila Pilih</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td>
                              <select class="form-control input-sm" name="mjbBgkod">
                                <option selected>Sila Pilih</option>
                              </select>
                            </td>
                            <td><input type="text" class="form-control input-sm"></td>
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
                          <input type="text" class="form-control input-sm">
                        </div>
                      </div>
                      <button id="add-one" class="btn btn-primary btn-sm mb5" type="button">Add row</button>
                      <table class="table table-bordered one">
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
                        <tbody>
                          <tr>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td>
                              <select class="form-control input-sm" name="mjbBgkod">
                                <option selected>Sila Pilih</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td>
                              <select class="form-control input-sm" name="mjbBgkod">
                                <option selected>Sila Pilih</option>
                              </select>
                            </td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td><button class="btn btn-danger btn-xs" id="DeleteRow" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                        </tbody>
                      </table>

                    </div>
                    <div class="tab-pane" id="tab3">
                      <div class="page-header">
                        <h4><strong>BANGUNAN LUAR</strong></h4>
                      </div>
                      <div class="form-group">
                        <label class="col-lg-2 col-md-3 control-label tal"><strong>Perkara</strong></label>
                        <div class="col-lg-10 col-md-9">
                          <input type="text" class="form-control input-sm">
                        </div>
                      </div>
                      <button id="add-two" class="btn btn-primary btn-sm mb5" type="button">Add row</button>
                      <table class="table table-bordered two">
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
                        <tbody>
                          <tr>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td>
                              <select class="form-control input-sm" name="mjbBgkod">
                                <option selected>Sila Pilih</option>
                              </select>
                            </td>
                            <td style="text-align:center">X</td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td>
                              <select class="form-control input-sm" name="mjbBgkod">
                                <option selected>Sila Pilih</option>
                              </select>
                            </td>
                            <td><input type="text" class="form-control input-sm"></td>
                            <td><button class="btn btn-danger btn-xs" id="DeleteRow" type="button"><i
                                  class="fa fa-trash"></i></button></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="tab-pane" id="tab4">
                      <div class="page-header">
                        <h4><strong>KESELURUHAN</strong></h4>
                      </div>
                      <table style="width:100%" class="calculator mb15">
                        <tr>
                          <td style="width:5%;text-align:center"><strong>A.</strong></td>
                          <td><strong>TANAH :-</strong></td>
                          <td style="width:15%"></td>
                          <td style="width:5%"></td>
                          <td style="width:15%"></td>
                          <td style="width:5%"></td>
                          <td style="width:15%"></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td>23323232 mp</td>
                          <td style="text-align:center">X</td>
                          <td>RM 23 smp</td>
                          <td style="text-align:center">=</td>
                          <td>88788</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>Pelarasan :</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr class="mt20">
                          <td></td>
                          <td>(-)</td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control input-sm" placeholder="Username">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                          <td style="text-align:center">=</td>
                          <td>RM -</td>
                        </tr>
                        <tr>
                          <td style="width:2%;text-align:center"><strong>B.</strong></td>
                          <td><strong>BANGUNAN :-</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong><u>Kilang/Stor (Bangunan Terbuka)</u></strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>MFA</td>
                          <td>-</td>
                          <td style="text-align:center">X</td>
                          <td>RM 122 smp</td>
                          <td style="text-align:center">=</td>
                          <td>RM -</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>AFA</td>
                          <td>32323 mp</td>
                          <td style="text-align:center">X</td>
                          <td>RM 122 smp</td>
                          <td style="text-align:center">=</td>
                          <td>RM 4343</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>Pelarasan :</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>(-) Susut Nilai Bangunan</td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control input-sm" placeholder="Username">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                          <td style="text-align:center">=</td>
                          <td>RM -</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong><u>Pejabat</u></strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>MFA</td>
                          <td>-</td>
                          <td style="text-align:center">X</td>
                          <td>RM 122 smp</td>
                          <td style="text-align:center">=</td>
                          <td>RM -</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>AFA</td>
                          <td>32323 mp</td>
                          <td style="text-align:center">X</td>
                          <td>RM 122 smp</td>
                          <td style="text-align:center">=</td>
                          <td>RM 4343</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>Pelarasan :</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td></td>
                          <td>(-) Susut Nilai Bangunan</td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control input-sm" placeholder="Username">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                          <td style="text-align:center">=</td>
                          <td>RM -</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>NILAI MODAL</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>RM 3223323</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>(SEKSYEN 2 AKTA 171, 10%)</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td style="text-align:center">X</td>
                          <td>10%</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>NILAI SEWA SETAHUN</strong></td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <input type="text" class="form-control input-sm" placeholder="Username">
                              <span class="input-group-addon">%</span>
                            </div>
                          </td>
                          <td></td>
                          <td>RM 3223323</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>NILAI TAHUNAN (DIGENABKAN)</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>
                            <div class="input-group input-group-sm">
                              <span class="input-group-addon">RM</span>
                              <input type="text" class="form-control input-sm" placeholder="Username">
                            </div>
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>Kadar (11.5%)</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>11.5</td>
                        </tr>
                        <tr>
                          <td></td>
                          <td><strong>Cukai Taksiran</strong></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>RM 3223323</td>
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