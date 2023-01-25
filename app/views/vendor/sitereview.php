<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $kws = $this->controller->elements->area(); ?>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row align-items-center">
                <div class="col">
                  <h4 class="ml5">MAKLUMAT SIASATAN TAPAK</h4>
                </div>
              </div>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-lg-6 col-sm-6 col-md-6">
                </div>
                <div class="col-lg-6 col-sm-6 col-md-6 tar">
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
                  </form>
                </div>
              </div>
              <div class="table-responsive">
                <table id="sitereview" class="table table-bordered"
                  style="border-collapse: collapse; border-spacing: 0;" style="font-size:13px">
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
                      <th>Jenis Semakan</th>
                      <th>
                        Catatan Hadapan <br />
                        Catatan Belakang
                      </th>
                      <th>Tarikh Lawatan</th>
                      <th>Pegawai</th>
                      <th class="nowrap"></th>
                    </tr>
                  </thead>
                </table>
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