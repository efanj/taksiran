<!-- Page Content-->
<div class="page-body">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row mt-3">
            <div class="col-sm-12 col-md-12">
                <div class="card card-default">
                    <div class="card-header bg-primary" style="padding:15px;">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title"><i class="fa fa-users"></i> Pengguna</h4>
                            </div>
                            <div class="col-auto">
                                <a href="<?php echo PUBLIC_ROOT; ?>Admin/register" id="link-register" class="btn btn-pill btn-light btn-air-light btn-xs">Daftar Pengguna</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="list-users" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                        <td><span class="text-primary"><?= $user["name"]; ?></span></td>
                                        <td><span class="text-primary"><?= $user["workerid"]; ?></span></td>
                                        <td><span class="text-primary"><?= $user["group"]; ?></span></td>
                                        <td><span class="text-primary"><?= $user["role"]; ?></span></td>
                                        <td><span class="text-primary"><?= $user["position"]; ?></span></td>
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
                                            <div class="btn-group btn-group-xs">
                                                <?php
                                                    if (Session::getUserRole() == "admin") { ?>
                                                <a href="<?= PUBLIC_ROOT . "Admin/viewUser/" . urlencode(Encryption::encryptId($user["id"])); ?>" class="btn btn-outline-primary btn-xs">
                                                    <i class="icon-pencil"></i>
                                                </a>
                                                <?php }
                                                    // current admin can't delete himself!
                                                    if (Session::getUserId() !== $user["id"]) { ?>
                                                <a class="btn btn-outline-danger btn-xs delete"><i class="icon-close"></i></a>
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