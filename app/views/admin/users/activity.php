<!-- Page Content-->
<div class="page-body">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-12 col-lg-12">
                <!-- Users Block -->
                <div class="card card-default">
                    <div class="card-header bg-primary" style="padding:15px;">
                        <h5 class="card-title">Log Aktiviti Pengguna</h5>
                    </div>
                    <div class="card-body">
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

										foreach($logData as $log){?>
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