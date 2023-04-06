<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $kws = $this->controller->elements->area(); ?>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="panel panel-mdpt">
            <div class="panel-heading">
              <h4>MAKLUMAT SIASATAN TAPAK</h4>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6">
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 mb10 tar pr15">
                  <form class="form-inline" role="form">
                    <div class="form-group">
                      <select class="form-control input-sm" name="area" id="area">
                        <option selected value="">Sila Pilih Kawasan</option>
                        <?php foreach ($kws as $row) { ?>
                        <option value="<?= $row["kws_kwkod"] ?>"><?= $row["kws_knama"] ?></option>
                        <?php } ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <select class="form-control input-sm" name="street" id="street" style="width:100%">
                        <option selected value="">Sila Pilih Jalan</option>
                      </select>
                    </div>
                    <button type="button" class="btn btn-primary btn-sm" id="filter"><i class="fa  fa-search"></i>
                      Saring</button>
                    <!-- <button type="button" class="btn btn-info btn-sm btn-alt ml30" id="print"><i
                        class="fa fa-print"></i>
                      Cetak</button> -->
                  </form>
                </div>
              </div>
              <div class="table-responsive">
                <form role="form" id="form-verifylists">
                  <table id="sitereviews" class="table table-bordered" style="width:100%;">
                    <thead>
                      <tr>
                        <th></th>
                        <th>
                          No. Akaun <br />
                          No. Lot
                        </th>
                        <th>Alamat</th>
                        <th>Nama Jalan</th>
                        <th>Jenis Hartanah</th>
                        <th>
                          Luas Bangunan(mp) <br />
                          Luas Tanah(mp) <br />
                          Luas Ansolari(mp)
                        </th>
                        <th>
                          Luas Bgn Tamb.(mp) <br />
                          Luas Ans Tamb.(mp)
                        </th>
                        <th>
                          Catatan Hadapan <br />
                          Catatan Belakang
                        </th>
                        <th>Jenis Semakan</th>
                        <th>Tarikh Lawatan</th>
                        <th>Pegawai</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <div class="row">
                    <div class="col-lg-12 col-sm-12 col-md-12">
                      <button type="submit" class="btn btn-primary btn-sm" id="send"><i class="fa fa-send"></i>
                        Serah ke PBT</button>
                    </div>
                  </div>
                </form>
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

<div class="modal fade" id="submit_popup" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form method="post" id="submitionreview">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">
            <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">SERAHAN DATA</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail6" class="col-sm-4 control-label">Jalan / Taman</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control input-sm" id="inputEmail6">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail6" class="col-sm-4 control-label">Tarikh</label>
                <div class="col-sm-8">

                </div>
              </div>
            </div>
          </div>
          <div class="row mt5">
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail6" class="col-sm-4 control-label">Kegunaan</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control input-sm" id="inputEmail6">
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="inputEmail6" class="col-sm-4 control-label">Kaedah</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control input-sm" id="inputEmail6">
                </div>
              </div>
            </div>
          </div>
          <div class="row mt5">
            <div class="col-md-12">
              <div class="form-group">
                <label for="inputPassword5" class="col-sm-12 control-label">Pilihan Data</label>
                <div class="col-sm-12">
                  <textarea class="form-control" rows="3" id="id" readonly></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>