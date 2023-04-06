<div class="page-content sidebar-page clearfix">
    <!-- .page-content-wrapper -->
    <div class="page-content-wrapper">
        <div class="page-content-inner">
            <?php
            $info = $this->controller->engineering->getPermitDetails($fileId);
            $imgs = $this->controller->engineering->getImages($fileId);
            ?>
            <div class="row">
                <div class="col-lg-8 content-scrollbar">
                    <div class="panel">
                        <div class="panel-heading bg-primary">
                            <h5>MAKLUMAT PERMIT</h5>
                        </div>
                        <div class="panel-body">
                            <form method="POST" id="form-permit" role="form">
                                <input type="hidden" value="<?= $info['smk_codex']; ?>" id="codex">
                                <input type="hidden" value="<?= $info['smk_codey']; ?>" id="codey">
                                <div class="row mb5">
                                    <div class="col-md-2"><label class="control-label">No Akaun :</label></div>
                                    <div class="col-md-2 div-label">
                                        <?= $info['prmt_akaun']; ?>
                                        <input type="hidden" name="no_akaun" value="<?= $info['prmt_akaun']; ?>">
                                        <input type="hidden" name="smk_id" value="<?= $info['smk_id']; ?>">
                                    </div>
                                    <div class="col-md-2"><label class="control-label">No Lot :</label></div>
                                    <div class="col-md-2 div-label">
                                        <input type="text" name="no_lot" id="no_lot" class="form-control input-sm" value="<?= $info['prmt_nolot']; ?>" required>
                                    </div>
                                    <div class="col-md-2"><label class="control-label">Memiliki Kelulusan
                                            :</label></div>
                                    <div class="col-md-2">
                                        <select class="form-control input-sm" name="permit" id="permit" required>
                                            <option value="">Sila Pilih</option>
                                            <?php foreach (['0' => 'Tiada', '1' => 'Tidak Berkaitan', '2' => 'Ada'] as $key => $permit) { ?>
                                                <option <?php if ($key == $info['prmt_permit']) {
                                                            echo "selected";
                                                        } ?> value="<?= $key; ?>">
                                                    <?= ucfirst($permit); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt5 mb5">
                                    <div class="col-md-2"><label class="control-label">Alamat Harta :</label></div>
                                    <div class="col-md-10 div-label">
                                        <?php
                                        if ($info['prmt_adpg1'] != "") {
                                            echo $info['prmt_adpg1'] . ", ";
                                        }
                                        if ($info['prmt_adpg2'] != "") {
                                            echo $info['prmt_adpg2'] . ", ";
                                        }
                                        if ($info['prmt_adpg3'] != "") {
                                            echo $info['prmt_adpg3'] . ", ";
                                        }
                                        if ($info['prmt_adpg4'] != "") {
                                            echo $info['prmt_adpg4'];
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="row mb5">
                                    <div class="col-md-2"><label class="control-label">Luas Tanah :</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control input-sm" type="text" name="luastanah" value="<?= $info['prmt_lstnh']; ?>">
                                            <span class="input-group-addon">mp</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"><label class="control-label">Luas Bangunan Asal
                                            :</label></div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control input-sm" type="text" name="luasbgnasal" value="<?= $info['prmt_lsbgn_asal']; ?>">
                                            <span class="input-group-addon">mp</span>
                                        </div>
                                    </div>
                                    <div class="col-md-2"><label class="control-label">Luas Bangunan Tamb
                                            :</label></div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control input-sm" type="text" name="luasbgntamb" id="luasbgntamb" value="<?= $info['prmt_lsbgn_tmbh']; ?>">
                                            <span class="input-group-addon">mp</span>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="bold ul">Fee Pelan</h4>
                                <div class="row mb-4">
                                    <div class="col-md-2"><label class="control-label">Luas dibenarkan :</label>
                                    </div>
                                    <div class="col-md-2 div-label">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control input-sm" type="number" name="luas_dibenarkan" id="luas_dibenarkan" value="<?= $info['prmt_lsbgnallow']; ?>">
                                            <span class="input-group-addon">mp</span>
                                        </div>
                                    </div>
                                    <div class="col-md-8"></div>
                                </div>
                                <div class="row mt5 mb5">
                                    <div class="col-md-2"><label class="control-label">Luas Binaan Tamb
                                            :</label></div>
                                    <div class="col-md-2 div-label">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control input-sm" type="text" value="<?= $info['prmt_lsbgn_tmbh']; ?>" disabled>
                                            <span class="input-group-addon">mp</span>
                                        </div>
                                    </div>
                                    <div class="col-md-1"><label class="control-label">Kadar :</label></div>
                                    <div class="col-md-2 div-label">RM 7 / 9m&sup2;</div>
                                    <div class="col-md-3"><label class="control-label">Jumlah Fee Pelan
                                            :</label>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group input-group-sm">
                                            <span class="input-group-addon">RM</span>
                                            <input class="form-control input-sm" type="number" name="jumlah_denda" id="jumlah_denda" value="<?= $info['prmt_amt']; ?>" min="0.00" step="0.01">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <h4 class="bold ul">Permit Tahunan</h4>
                                <div class="row mt5 mb5">
                                    <div class="col-md-2"><label class="control-label">Permit Tahunan? :</label>
                                    </div>
                                    <div class="col-md-1">
                                        <input type="hidden" id="denda_tahunan" name="denda_tahunan" value="<?= $info['prmt_thnan']; ?>">
                                        <div class="checkbox-custom checkbox-inline">
                                            <input type="checkbox" id="dummy_tahunan" <?php if ($info['prmt_thnan'] === true) {
                                                                                            echo 'checked';
                                                                                        } ?>>
                                            <label for="checkbox6"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb5">
                                    <div class="col-md-2"><label class="control-label">Luas Side Back :</label>
                                    </div>
                                    <div class="col-md-2 div-label">
                                        <div class="input-group input-group-sm">
                                            <input class="form-control input-sm" type="number" name="luas_stbck" id="luas_stbck" value="<?= $info['prmt_lsstbck']; ?>" readonly>
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
                                            <input class="form-control input-sm" type="number" name="jumlah_tahunan" id="jumlah_tahunan" value="<?= $info['prmt_amt_thnan']; ?>" min="0.00" step="0.01" readonly>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- <div class="row mb-1">
                                <div class="col-md-7"></div>
                                <div class="col-md-3"><label class="control-label">Jumlah Keseluruhan :</label></div>
                                <div class="col-md-2">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-addon">RM</span>
                                        <input class="form-control input-sm" type="number" name="jumlah_keseluruhan" id="jumlah_keseluruhan" value="<?= $info['prmt_amt'] + $info['prmt_amt_thnan']; ?>" min="0.00" step="0.01" disabled>
                                    </div>
                                </div>
                            </div> -->
                                <div class="row mt5">
                                    <div class="col-md-12 text-end">
                                        <button type="submit" class="btn btn-primary btn-sm"><i class="icon-save"></i> Simpan Rekod</button>
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
                                                                <input class="check" type="checkbox" value="<?= Encryption::encryptId($file["id"]) ?>" id="checkbox8">
                                                                <label for="checkbox8"></label>
                                                            </div>
                                                            <a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#print-image">
                                                                <i class="fa fa-print mr5"></i>Cetak
                                                            </a>
                                                            <a href="#" class="btn btn-default btn-sm delete-image" data-id="<?= Encryption::encryptId($file["id"]) ?>"><i class="fa fa-trash-o mr5"></i>Padam</a>
                                                        </div>
                                                    </div>
                                                    <div class="panel-body">
                                                        <a href="<?= PUBLIC_ROOT ?>img/big-lightgallry/<?= $file["hashed_filename"] ?>" data-toggle="lightbox" data-gallery="gallerymode" data-title="<?= $file["filename"] ?>" data-parrent>
                                                            <img class="img-responsive" src="<?= PUBLIC_ROOT ?>img/thumb-lightgallry/<?= $file["hashed_filename"] ?>" alt="<?= $file["filename"] ?>" style="height:auto; width: 100%; max-height:250px; max-width:250px">
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
                    <div id="mapView" style="height:100%;"></div>
                </div>
            </div>
        </div>
    </div>
</div>