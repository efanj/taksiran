<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $docs = $this->controller->Informations->sitereviewinfo($reviewId); ?>
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>GALERI DOKUMEN</h4>
            </div>
            <div class="panel-body">
              <div class="row gallery sortable-layout">
                <?php
                $filesData = $this->controller->vendor->getAllDocs($docs["smk_akaun"]);
                echo $this->render(Config::get("VIEWS_PATH") . "vendor/docs.php", ["files" => $filesData]);
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
                  <td width="50%"><strong>No. Akaun :</strong> <?=$docs["smk_akaun"];?></td>
                  <td width="50%"><strong>No. Lot :</strong> <?=$docs["smk_nolot"];?></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>Jenis Harta :</strong> <?=$docs["hrt_hnama"];?></td>
                </tr>
                <tr>
                  <td colspan="2"><strong>Alamat Harta :</strong>
                    <?php
                    if($docs["smk_adpg1"] != "" || $docs["smk_adpg1"] != null){
                      echo $docs["smk_adpg1"] . ",";
                    } elseif ($docs["smk_adpg2"] != "" || $docs["smk_adpg2"] != null) {
                      echo $docs["smk_adpg2"] . ",";
                    } elseif ($docs["smk_adpg3"] != "" || $docs["smk_adpg3"] != null) {
                      echo $docs["smk_adpg3"] . ",";
                    } elseif ($docs["smk_adpg4"] != "" || $docs["smk_adpg4"] != null) {
                      echo $docs["smk_adpg4"] . ",";
                    }?>
                  </td>
                </tr>
                <tr>
                  <td width="20%"><strong>Kawasan :</strong> <?=$docs["jln_knama"];?></td>
                  <td width="20%"><strong>Jalan :</strong> <?=$docs["jln_jnama"];?></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MUATNAIK DOKUMEN</h4>
            </div>
            <div class="panel-body">
              <div class="row mb20">
                <div class="col-lg-12 col-sm-12 col-md-12">
                  <form class="form-horizontal" id="form-upload-docs" role="form" method="post"
                    enctype="multipart/form-data" style="font-size:13px;">
                    <input type="hidden" name="no_akaun" value="<?= $docs["smk_akaun"] ?>">
                    <div class="row mb5">
                      <div class="col-md-8">
                        <label class="control-label">Nama Dokumen :</label>
                        <input class="form-control input-sm" type="text" name="filename" required>
                      </div>
                      <div class="col-md-4">
                        <label class="control-label">Jenis :</label>
                        <?php $dtype = $this->controller->Informations->docstype(); ?>
                        <select class="form-control input-sm" name="file_type" required>
                          <option value="0" selected>Sila Pilih</option>
                          <?php foreach ($dtype as $row) { ?>
                          <option value="<?= $row["id"] ?>"><?= $row["document"] ?></option>
                          <?php } ?>
                        </select>
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
                        <p class="help-block"><em> Only PDF, PPTX, DOCX</em></p>
                        <p class="help-block"><em> Max File Size: 5MB</em></p>
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