<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $docs = $this->controller->Informations->benchmarkinfo($id); ?>
      <div class="row">
        <div class="col-lg-7 col-sm-7 col-md-7">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>GALERI DOKUMEN</h4>
            </div>
            <div class="panel-body">
              <div class="row gallery sortable-layout">
                <?php
                $data = $this->controller->vendor->getBenchMarkInfo($docs['id']);
                echo $this->render(Config::get("VIEWS_PATH") . "vendor/benchmarkdocs.php", ["files" => $data]);
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-sm-5 col-md-5">
          <table class="table table-bordered info mb20" style="width:100%; font-size:13px;">
            <thead>
              <tr>
                <th width="13%">Jalan/Taman</th>
                <th width="22%">Nama Pemilik</th>
                <th width="18%">Jenis Bangunan</th>
                <th width="12%">Kadar Sewa (smp)</th>
                <th width="20%">Keterangan</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?=$docs['jln_jnama'];?></td>
                <td><?=$docs['nmbil'];?></td>
                <td><?=$docs['bgn_bnama'];?></td>
                <td>RM <?=$docs['nilai'];?></td>
                <td><?=$docs['nota'];?></td>
              </tr>
              <?php foreach ($docs['childs'] as $row) { ?>
              <tr>
                <td colspan="2"></td>
                <td><?=$row['bgn_bnama'];?></td>
                <td>RM <?=$row['nilai'];?></td>
                <td><?=$row['nota'];?></td>
              </tr>
              <?php } ?>
            </tbody>
          </table>
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>MUATNAIK DOKUMEN</h4>
            </div>
            <div class="panel-body">
              <div class="row mb20">
                <div class="col-lg-12 col-sm-12 col-md-12">
                  <form class="form-horizontal" id="form-upload-docs-benchmark" role="form" method="post"
                    enctype="multipart/form-data" style="font-size:13px;">
                    <input type="hidden" name="id" value="<?=$id;?>">
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