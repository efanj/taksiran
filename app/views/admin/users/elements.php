<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Jabatan</h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Senarai Jabatan
                    </div>
                    <div class="panel-body">
                      <table class="table element" id="list-department">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="90%">Jabatan</th>
                            <th scope="col" class="text-center"><i class="fa fa-cog"></i></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $datajabatan = $this->controller->admin->getJabatan();

                          foreach ($datajabatan as $jab) { ?>
                          <tr id="<?= Encryption::encryptId($jab["id"]); ?>">
                            <td><?= $jab["id"]; ?></td>
                            <td><?= $jab["department_name"]; ?></td>
                            <td class="text-center">
                              <a class="btn btn-outline-danger btn-xs delete"><i class="icon-close"></i></a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Daftar Baru
                    </div>
                    <div class="panel-body">
                      <form method="post" id="form-jabatan">
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Name Jabatan</label>
                              <input type="text" name="jabatan" value="" class="form-control form-control-sm"
                                maxlength="128">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <button class="btn btn-primary btn-sm" type="submit"><i class="icon-save"></i>
                                Simpan</button>
                            </div>
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
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h5 class="panel-title">Jawatan</h5>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Senarai Jawatan
                    </div>
                    <div class="panel-body">
                      <table class="table element" id="list-position">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="90%">Jawatan</th>
                            <th scope="col" class="text-center"><i class="fa fa-cog"></i></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $datajawatan = $this->controller->admin->getJawatan();

                          foreach ($datajawatan as $jaw) { ?>
                          <tr id="<?= Encryption::encryptId($jaw["id"]); ?>">
                            <td><?= $jaw["id"]; ?></td>
                            <td><?= $jaw["position_name"]; ?></td>
                            <td class="text-center">
                              <a class="btn btn-outline-danger btn-xs delete"><i class="icon-close"></i></a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Daftar Baru
                    </div>
                    <div class="panel-body">
                      <form method="post" id="form-jawatan">
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Name Jawatan</label>
                              <input type="text" name="jawatan" value="" class="form-control form-control-sm"
                                maxlength="128">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <button class="btn btn-primary btn-sm" type="submit"><i class="icon-save"></i>
                                Simpan</button>
                            </div>
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
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading bg-primary" style="padding:8px 15px;">
              <h5 class="panel-title">Kumpulan</h5>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Senarai Kumpulan
                    </div>
                    <div class="panel-body">
                      <table class="table element" id="list-group">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="90%">Kumpulan</th>
                            <th scope="col" class="text-center"><i class="fa fa-cog"></i></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $datakumpulan = $this->controller->admin->getKumpulan();

                          foreach ($datakumpulan as $kum) { ?>
                          <tr id="<?= Encryption::encryptId($kum["id"]); ?>">
                            <td><?= $kum["id"]; ?></td>
                            <td><?= $kum["group_name"]; ?></td>
                            <td class="text-center">
                              <a class="btn btn-outline-danger btn-xs delete"><i class="icon-close"></i></a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Daftar Baru
                    </div>
                    <div class="panel-body">
                      <form method="post" id="form-kumpulan">
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Name Kumpulan</label>
                              <input type="text" name="kumpulan" value="" class="form-control form-control-sm"
                                maxlength="128">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <button class="btn btn-primary btn-sm" type="submit"><i class="icon-save"></i>
                                Simpan</button>
                            </div>
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
      <div class="row">
        <div class="col-sm-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading bg-primary" style="padding:8px 15px;">
              <h5 class="panel-title">Kumpulan</h5>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Senarai Kumpulan
                    </div>
                    <div class="panel-body">
                      <table class="table element" id="list-group">
                        <thead>
                          <tr>
                            <th scope="col" width="5%">#</th>
                            <th scope="col" width="90%">Kumpulan</th>
                            <th scope="col" class="text-center"><i class="fa fa-cog"></i></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $datakumpulan = $this->controller->admin->getKumpulan();

                          foreach ($datakumpulan as $kum) { ?>
                          <tr id="<?= Encryption::encryptId($kum["id"]); ?>">
                            <td><?= $kum["id"]; ?></td>
                            <td><?= $kum["group_name"]; ?></td>
                            <td class="text-center">
                              <a class="btn btn-outline-danger btn-xs delete"><i class="icon-close"></i></a>
                            </td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="col-sm-6 col-md-6">
                  <div class="panel">
                    <div class="panel-heading bg-primary" style="padding:8px 15px;">
                      Daftar Baru
                    </div>
                    <div class="panel-body">
                      <form method="post" id="form-kumpulan">
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <label class="form-label">Name Kumpulan</label>
                              <input type="text" name="kumpulan" value="" class="form-control form-control-sm"
                                maxlength="128">
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-12">
                            <div class="form-group">
                              <button class="btn btn-primary btn-sm" type="submit"><i class="icon-save"></i>
                                Simpan</button>
                            </div>
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
    </div>
  </div>
</div>