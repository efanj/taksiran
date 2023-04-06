<div class="page-content sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              <div class="row">
                <div class="col">
                  <h4 class="ml15">Log Aktiviti Pengguna</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <table id="users-activity" class="table table-hover">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Activity</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                                    $logData = $this->controller->admin->getLogActivity();

                                    foreach ($logData as $log) { ?>
                  <tr>
                    <td><?= $log["name"]; ?></td>
                    <td><?= $log["activity"]; ?></td>
                    <td><?= date("D, d/m/Y H:i:s", strtotime($log["date"])); ?></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.panel-body -->
          </div>
        </div>
        <!-- END Newsfeed Block -->
      </div>

    </div>
  </div>