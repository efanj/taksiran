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
                  <h4 class="ml15"><i class="fa fa-users"></i> Pengguna</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                  <a href="<?php echo PUBLIC_ROOT; ?>Admin/register" id="link-register"
                    class="btn btn-primary btn-xs mt5 mr5">Daftar Pengguna</a>
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">
              <div class="table-responsive">
                <table id="list-users" class="table table-bordered dt-responsive nowrap"
                  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                  <thead>
                    <tr>
                      <th width="20%">Name</th>
                      <th>Worker ID</th>
                      <th>Group</th>
                      <th>Role</th>
                      <th>Jawatan</th>
                      <th>Department</th>
                      <th>Email</th>
                      <th width="5%">Activate</th>
                      <th class="text-center"><i class="fa fa-cog"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $usersData = $this->controller->admin->getUsers();

                    foreach ($usersData['users'] as $user) { ?>
                    <tr id="user-<?= Encryption::encryptId($user["id"]); ?>">
                      <td><?= $user["name"]; ?></td>
                      <td><?= $user["workerid"]; ?></td>
                      <td><?= $user["group"]; ?></td>
                      <td><?= $user["role"]; ?></td>
                      <td><?= $user["position"]; ?></td>
                      <td><span <?php if ($user["department"] === "admin") {
                                    echo 'class="badge rounded-pill badge-primary">';
                                  } elseif ($user["role"] === "penilaian") {
                                    echo 'class="badge rounded-pill badge-secondary">';
                                  } elseif ($user["role"] === "jurutera") {
                                    echo 'class="badge rounded-pill badge-success">';
                                  }
                                  echo ucfirst($user["department"]); ?> </span></td>
                      <?php if (empty($user["email"])) { ?>
                      <td class='text-danger'>Not Available</td>
                      <?php } else { ?>
                      <td><?= $this->encodeHTML($user["email"]); ?></td>
                      <?php } ?>
                      <td class="text-center"><?php if ($user["is_email_activated"] === 1) {
                                                  echo '<i class="fa fa-check" style="color:green;"></i>';
                                                } else {
                                                  echo '<i class="fa fa-close" style="color:red;"></i>';
                                                } ?></td>
                      <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                          <?php
                            if (Session::getUserRole() == "administrator") { ?>
                          <a href="<?= PUBLIC_ROOT . "Admin/viewUser/" . urlencode(Encryption::encryptId($user["id"])); ?>"
                            class="btn btn-default btn-sm" type="button" type="button">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <?php }
                            // current admin can't delete himself!
                            if (Session::getUserId() !== $user["id"]) { ?>
                          <a class="btn btn-danger btn-sm delete"><i class="fa fa-times"></i></a>
                          <?php } ?>
                        </div>
                      </td>
                    </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- /.panel-body -->
          </div>
        </div>
        <!-- /.panel-body -->
      </div>
    </div>
    <!-- END Newsfeed Block -->
  </div>
  <!-- /.row -->
</div>
<!-- /#page-wrapper -->