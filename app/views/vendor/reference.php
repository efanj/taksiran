<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6">
          <div class="card">
            <div class="card-header">
              <h3>Data Rujukan</h3>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="rujukan" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0;">
                  <thead>
                    <tr>
                      <th>No. Akaun</th>
                      <th>No. Lot</th>
                      <th>Alamat Harta</th>
                      <th>Jenis Bangunan</th>
                      <th>Keluasan</th>
                      <th>Nilai Tahunan</th>
                      <!-- <th class="nowrap"></th> -->
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6">
          <div class="row">
            <div class="col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h3>Kemasukan Data Rujukan</h3>
                  <hr>
                </div>
                <div class="card-body">
                  <form>
                    <div class="row mb4">
                      <div class="col-md-2">
                        <label class="form-label text-start">No. Akaun :</label>
                      </div>
                      <div class="col-md-4">
                        <div class="input-group">
                          <input type="text" class="form-control input-sm" id="inputAkaun">
                          <span class="input-group-btn">
                            <button class="btn btn-default btn-sm" type="button" data-toggle="modal"
                              data-target="#dataAkaun"><i class="fa fa-book"></i></button>
                          </span>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt20">
            <div class="col-lg-12">
              <div id="mapViewSmall" class="mapView"></div>
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

<div class="modal fade modal-style5" id="dataAkaun" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title">Data Akaun</h4>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>