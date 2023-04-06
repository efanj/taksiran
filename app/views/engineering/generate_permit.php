<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php
            $info = $this->controller->engineering->getDetails($fileId);
            $imgs = $this->controller->engineering->getImages($info['no_akaun']);
            // print_r($imgs);
            ?>
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml5">PERMIT BARU</h4>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <form action="" method="POST" id="form-permit">
                <input type="hidden" value="<?= $info['codex']; ?>" id="codex">
                <input type="hidden" value="<?= $info['codey']; ?>" id="codey">
                <div class="row mb5">
                  <div class="col-md-2"><label class="control-label">No Akaun :</label></div>
                  <div class="col-md-2 div-label">
                    <?= $info['no_akaun']; ?>
                    <input type="hidden" name="no_akaun" value="<?= $info['no_akaun']; ?>">
                    <input type="hidden" name="smk_id" value="<?= $info['smk_id']; ?>">
                  </div>
                  <div class="col-md-2"><label class="control-label">No Lot :</label></div>
                  <div class="col-md-2">
                    <input type="text" name="no_lot" id="no_lot" class="form-control input-sm"
                      value="<?= $info['peg_nolot']; ?>" required>
                  </div>
                  <div class="col-md-2"><label class="control-label">Memiliki Kelulusan
                      :</label></div>
                  <div class="col-md-2">
                    <select class="form-control input-sm" name="permit" id="permit" required>
                      <option value="">Sila Pilih</option>
                      <?php foreach (['0' => 'Tiada', '1' => 'Ada', '2' => 'Tidak Berkaitan'] as $key => $permit) { ?>
                      <option value="<?= $key; ?>"><?= ucfirst($permit); ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="row mt5 mb5">
                  <div class="col-md-2"><label class="control-label">Alamat Harta :</label></div>
                  <div class="col-md-10 div-label">
                    <?php
                                        if ($info['adpg1'] != "") {
                                            echo $info['adpg1'] . ", ";
                                        }
                                        if ($info['adpg2'] != "") {
                                            echo $info['adpg2'] . ", ";
                                        }
                                        if ($info['adpg3'] != "") {
                                            echo $info['adpg3'] . ", ";
                                        }
                                        if ($info['adpg4'] != "") {
                                            echo $info['adpg4'];
                                        }
                                        ?>
                  </div>
                </div>
                <div class="row mb5">
                  <div class="col-md-2"><label class="control-label">Luas Tanah :</label>
                  </div>
                  <div class="col-md-2">
                    <div class="input-group">
                      <input class="form-control input-sm" type="text" name="luastanah"
                        value="<?= $info['peg_lstnh']; ?>">
                      <span class="input-group-addon">mp</span>
                    </div>
                  </div>
                  <div class="col-md-2"><label class="control-label">Luas Binaan Asal
                      :</label></div>
                  <div class="col-md-2">
                    <div class="input-group input-group-sm">
                      <input class="form-control input-sm" type="text" name="luasbgnasal"
                        value="<?= $info['peg_lsbgn']; ?>">
                      <span class="input-group-addon">mp</span>
                    </div>
                  </div>
                  <div class="col-md-2"><label class="control-label">Luas Binaan Tamb
                      :</label></div>
                  <div class="col-md-2">
                    <div class="input-group input-group-sm">
                      <input class="form-control input-sm" type="text" name="luasbgntamb" id="luasbgntamb"
                        value="<?= $info['bgn_tmbh']; ?>">
                      <span class="input-group-addon">mp</span>
                    </div>
                  </div>
                </div>
                <hr>
                <h4 class="bold ul">Fee Pelan</h3>
                  <div class="row mb5">
                    <div class="col-md-2"><label class="control-label">Luas dibenarkan :</label>
                    </div>
                    <div class="col-md-2 div-label">
                      <div class="input-group input-group-sm">
                        <input class="form-control input-sm" type="number" name="luas_dibenarkan" id="luas_dibenarkan"
                          value="">
                        <span class="input-group-addon">mp</span>
                      </div>
                    </div>
                    <div class="col-md-8"></div>
                  </div>
                  <div class="row mb5">
                    <div class="col-md-2"><label class="control-label">Luas Binaan Tamb
                        :</label></div>
                    <div class="col-md-2 div-label">
                      <div class="input-group input-group-sm">
                        <input class="form-control input-sm" type="text" value="<?= $info['bgn_tmbh']; ?>" disabled>
                        <span class="input-group-addon">mp</span>
                      </div>
                    </div>
                    <div class="col-md-1"><label class="control-label">Kadar :</label></div>
                    <div class="col-md-2 div-label">RM 7 / 9m&sup2;</div>
                    <div class="col-md-3"><label class="control-label">Jumlah Fee :</label>
                    </div>
                    <div class="col-md-2">
                      <div class="input-group input-group-sm">
                        <span class="input-group-addon">RM</span>
                        <input class="form-control input-sm" type="number" name="jumlah_denda" id="jumlah_denda"
                          value="" min="0.00" step="0.01">
                      </div>
                    </div>
                  </div>
                  <hr>
                  <h4 class="bold ul">Permit Tahunan</h3>
                    <div class="row mt5  mb-1">
                      <div class="col-md-2"><label class="control-label">Permit Tahunan :</label>
                      </div>
                      <div class="col-md-1">
                        <div class="checkbox-custom checkbox-inline">
                          <input type="checkbox" id="dummy_tahunan">
                          <label for="checkbox6"></label>
                        </div>
                        <input type="hidden" id="denda_tahunan" name="denda_tahunan" value="false">
                      </div>
                    </div>
                    <div class="row mb5">
                      <div class="col-md-2"><label class="control-label">Luas Side Back :</label>
                      </div>
                      <div class="col-md-2 div-label">
                        <div class="input-group input-group-sm">
                          <input class="form-control input-sm" type="number" name="luas_stbck" id="luas_stbck" value=""
                            readonly>
                          <span class="input-group-addon">mp</span>
                        </div>
                      </div>
                      <div class="col-md-1"><label class="control-label">Kadar :</label></div>
                      <div class="col-md-2 div-label">RM 5 / 9m&sup2;</div>
                      <div class="col-md-3"><label class="control-label">Jumlah Permit Tahunan
                          :</label></div>
                      <div class="col-md-2">
                        <div class="input-group input-group-sm">
                          <span class="input-group-addon">RM</span>
                          <input class="form-control input-sm" type="number" name="jumlah_tahunan" id="jumlah_tahunan"
                            value="" min="0.00" step="0.01" readonly>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <!-- <div class="row mb-1">
                                        <div class="col-md-7"></div>
                                        <div class="col-md-3"><label class="form-label align-self-center text-start">Jumlah Keseluruhan :</label></div>
                                        <div class="col-md-2">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text">RM</span>
                                                <input class="form-control form-control-sm" type="number" name="jumlah_keseluruhan" id="jumlah_keseluruhan" value="" min="0.00" step="0.01" disabled>
                                            </div>
                                        </div>
                                    </div> -->
                    <div class="row mt5">
                      <div class="col-md-12 text-end">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save"></i> Simpan
                          Rekod</button>
                      </div>
                    </div>
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="panel">
                <div class="panel-heading bg-primary">
                  <h5>Gambar</h5>
                </div>
                <div class="panel-body">
                  <div class="row gallery sortable-layout">
                    <?php
                                        foreach ($imgs as $row) {
                                        ?>
                    <div class="col-xs-12 col-md-3 imagePanel">
                      <div class="panel panel-default plain panelMove">
                        <div class="panel-heading">
                          <h4 class="panel-title"><strong><?= $file["filename"] ?></strong><br>
                            <small><?= $file["description"] ?></small>
                          </h4>
                          <div class="btn-group" role="group">
                            <div class="checkbox-custom">
                              <input class="check" type="checkbox" value="<?= Encryption::encryptId($file["id"]) ?>"
                                id="checkbox8">
                              <label for="checkbox8"></label>
                            </div>
                            <a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#print-image">
                              <i class="fa fa-print mr5"></i>Cetak
                            </a>
                            <a href="#" class="btn btn-default btn-sm delete-image"
                              data-id="<?= Encryption::encryptId($file["id"]) ?>"><i
                                class="fa fa-trash-o mr5"></i>Padam</a>
                          </div>
                        </div>
                        <div class="panel-body">
                          <a href="<?= PUBLIC_ROOT ?>img/big-lightgallry/<?= $file["hashed_filename"] ?>"
                            data-toggle="lightbox" data-gallery="gallerymode" data-title="<?= $file["filename"] ?>"
                            data-parrent>
                            <img class="img-responsive"
                              src="<?= PUBLIC_ROOT ?>img/thumb-lightgallry/<?= $file["hashed_filename"] ?>"
                              alt="<?= $file["filename"] ?>"
                              style="height:auto; width: 100%; max-height:250px; max-width:250px">
                          </a>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="row">
            <div class="col-lg-12">
              <div id="mapView" style="height:100%;"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>