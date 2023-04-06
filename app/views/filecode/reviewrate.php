<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8 col-lg-offset-2 col-sm-offset-2 col-md-offset-2">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="ml5">KADAR NILAIAN SEMULA</h4>
            </div>
            <div class="panel-body">
              <table id="reviewrate" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0;">
                <thead>
                  <tr>
                    <th>Nama Kawasan</th>
                    <th>Jenis Harta</th>
                    <th>Kadar Semasa %</th>
                    <th>Kod Kawasan</th>
                    <th>Kod Harta</th>
                    <th>Kadar Nilaian Semula %</th>
                    <th></th>
                  </tr>
                </thead>
              </table>
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

<div class="modal draggable fade" id="modal_add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">KADAR NILAIAN SEMULA</h4>
      </div>
      <div class="modal-body">
        <table id="modal_table" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0;">
          <thead>
            <tr>
              <th>Nama Kawasan</th>
              <th>Jenis Harta</th>
              <th>Kadar Semasa %</th>
              <th>Nilaian Semula %</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td width="32%">
                <div class="control-label fl" id="area"></div>
                <input type="hidden" name="kwsKwkod" id="kws_kwkod">
              </td>
              <td width="32%">
                <div class="control-label fl" id="property"></div>
                <input type="hidden" name="hrtHtkod" id="hrt_htkod">
              </td>
              <td width="18%">
                <div class="control-label fl" id="current_rate"></div>
              </td>
              <td width="18%">
                <input name="newRate" id="new_rate" type="number" class="form-control input-sm" min="0" value="0"
                  step=".05">
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button id="add_action" type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>