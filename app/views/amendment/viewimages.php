<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $img = $this->controller->Informations->getSubmitionInfo($fileId); ?>

      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>GALERI GAMBAR</h4>
            </div>
            <div class="panel-body">
              <div class="row gallery sortable-layout">
                <!-- Start .row -->
                <?php
                $filesData = $this->controller->Informations->getAllImgs($fileId);
                echo $this->render(Config::get("VIEWS_PATH") . "amendment/files.php", ["files" => $filesData]);
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div class="panel panel-primary">
            <div class="panel-body">
              <table class="info" width="100%">
                <tr>
                  <td width="50%"><strong>No. Akaun :</strong> <?= $img["no_akaun"]; ?></td>
                  <td width="50%"><strong>No. Lot :</strong> <?= $img["no_lot"]; ?></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>Jenis Harta :</strong> <?= $img["hnama"]; ?></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>Alamat Harta :</strong>
                    <?php
                    if ($img["adpg1"] != "" || $img["adpg1"] != null) {
                      echo $img["adpg1"] . ",";
                    } elseif ($img["adpg2"] != "" || $img["adpg2"] != null) {
                      echo $img["adpg2"] . ",";
                    } elseif ($img["adpg3"] != "" || $img["adpg3"] != null) {
                      echo $img["adpg3"] . ",";
                    } elseif ($img["adpg4"] != "" || $img["adpg4"] != null) {
                      echo $img["adpg4"] . ",";
                    } ?>
                  </td>
                </tr>
                <tr>
                  <td width="20%"><strong>Kawasan :</strong> <?= $img["knama"]; ?></td>
                  <td width="20%"><strong>Jalan :</strong> <?= $img["jnama"]; ?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MUATNAIK GAMBAR</h4>
            </div>
            <div class="panel-body">
              <div class="row mb20">
                <div class="col-lg-12 col-sm-12 col-md-12">
                  <form class="form-horizontal" id="form-upload-file" role="form" method="post"
                    enctype="multipart/form-data" style="font-size:13px;">
                    <input type="hidden" name="no_akaun" value="<?= $img["no_akaun"] ?>">
                    <div class="row mb5">
                      <div class="col-md-12">
                        <label class="control-label">Nama Gambar :</label>
                        <input class="form-control input-sm" type="text" name="filename" required>
                      </div>
                    </div>
                    <div class="row mb5">
                      <div class="col-md-12">
                        <label class="control-label">Penerangan :</label>
                        <textarea class="form-control" name="description" cols="30" rows="2" required></textarea>
                      </div>
                    </div>
                    <div class="row mb10">
                      <div class="col-md-12">
                        <label class="control-label">Silih Pilih :</label>
                        <input type="file" class="form-control input-sm" name="file" id="file">
                        <p class="help-block"><em> Only JPEG, GIF & PNG</em></p>
                        <p class="help-block"><em> Max File Size: 3MB</em></p>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                      </div>
                      <div class="col-md-6 tar">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-upload"></i>
                          Muatnaik</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>