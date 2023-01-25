<!-- Page Content-->
<div class="page-body">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row mt-3">
            <div class="col-sm-10 col-md-10 offset-md-1 offset-sm-1">
                <div class="card card-default content-scrollbar">
                    <?php
                    $info = $this->controller->user->getProfileInfo($userId);
                    ?>
                    <div class="card-header bg-primary" style="padding:15px;">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Kemas-kini profil</h5>
                            </div>
                            <!--end col-->
                            <div class="col-auto">
                                <button class="btn btn-pill btn-light btn-air-light btn-xs" onclick="history.back();">KEMBALI</button>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <div class="block-section text-center">
                                        <img src="<?= $info["image"]; ?>" class="img-circle profile-pic-lg">
                                        <h3><strong><?= $info["name"]; ?></strong></h3>
                                        <h4>
                                            <span class="label label-default"><?= ucfirst($info["role"]); ?></span>
                                        </h4>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-secondary" style="padding:15px;">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title">Update Profile</h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" id="form-update-user-info" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Name</label>
                                                        <input dir="auto" type="text" name="name" value="<?= $info["name"]; ?>" class="form-control form-control-sm" maxlength="128">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php 
                                                        $datajabatan = $this->controller->admin->getJabatan();
                                                        ?>
                                                        <label class="form-label">Department</label>
                                                        <select class="form-select form-select-sm" name="department">
                                                            <option value="">Sila Pilih</option>
                                                            <?php 
                                                            foreach ($datajabatan as $jab) { ?>
                                                                <option value="<?= $jab["department_name"]; ?>" <?php if ($info["department"] == $jab["department_name"]) {
                                                                        echo "selected";
                                                                    } ?>><?= $jab["department_name"]; ?></option>
                                                            <?php } ?>
                                                            
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php 
                                                        $datajawatan = $this->controller->admin->getJawatan();
                                                        ?>
                                                        <label class="form-label">Jawatan</label>
                                                        <select name="position" class="form-select form-select-sm" size="1">
                                                            <option value="">Sila Pilih</option>
                                                            <?php 
                                                            foreach ($datajawatan as $jaw) { ?>
                                                                <option value="<?= $jaw["position_name"]; ?>" <?php if ($info["position"] == $jaw["position_name"]) {
                                                                        echo "selected";
                                                                    } ?>><?= $jaw["position_name"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Email</label>
                                                        <input type="email" name="email" value="<?= $info["email"]; ?>" class="form-control form-control-sm" maxlength="64" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-actions text-right">
                                                <button type="submit" name="submit" value="submit" class="btn btn-md btn-primary">
                                                    <i class="fa fa-check"></i> Update Profile
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-secondary" style="padding:15px;"
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title">Update Password</h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" id="form-update-user-password" method="post">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Password</label>
                                                        <input autocomplete="new-password" type="password" name="password" id="password" class="form-control form-control-sm" minlength="6">
                                                        <p class="help-block font-danger">Passwords must contain at least one uppercase, one lowercase, one number, and not less than 6 characters</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Confirm Password</label>
                                                        <input autocomplete="new-password" type="password" name="confirm_password" id="confirm_password" class="form-control form-control-sm">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <table width="100%">
                                                        <tr>
                                                            <th colspan="2" class="p-b-10"><input type="text" class="form-control form-control-sm" placeholder="Create password" id="passwordBox" readonly></th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-start">
                                                                <div id="button" class="btn btn-pill btn-primary btn-air-primary btn-xs" onclick="password_generator()">Generate</div>
                                                            </th>
                                                            <th class="text-end"><a id="button" class="btn btn-pill btn-secondary btn-air-secondary btn-xs" onclick="copyPassword()">Copy</a></th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group form-actions text-right">
                                                <button type="submit" value="submit" class="btn btn-md btn-primary">
                                                    <i class="fa fa-check"></i> Update Password
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header bg-secondary" style="padding:15px;"
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h5 class="card-title">Update Account</h5>
                                            </div>
                                            <!--end col-->
                                            <div class="col-auto">
                                            </div>
                                            <!--end col-->
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="#" id="form-update-user-account" method="post">
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Peranan</label>
                                                        <select name="role" class="form-select form-select-sm" size="1">
                                                            <option value="">Sila Pilih</option>
                                                            <?php foreach (['admin', 'penilaian', 'jurutera', 'public'] as $role) { ?>
                                                            <?php if ($role === $info['role']) { ?>
                                                            <option selected value="<?= $info['role']; ?>"><?= ucfirst($info['role']); ?></option>
                                                            <?php } else { ?>
                                                            <option value="<?= $role; ?>"><?= ucfirst($role); ?></option>
                                                            <?php } ?>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <?php
                                                        $datakumpulan = $this->controller->admin->getKumpulan();
                                                        ?>
                                                        <label class="form-label">Kumpulan</label>
                                                        <select name="group" class="form-select form-select-sm" required>
                                                            <option value="">Sila Pilih</option>
                                                            <?php 
                                                            foreach ($datakumpulan as $kum) { ?>
                                                                <option value="<?= strtolower($kum["group_name"]); ?>" <?php if (strtoupper($info["group"]) == $kum["group_name"]) {
                                                                        echo "selected";
                                                                    } ?>><?= $kum["group_name"]; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="form-label">Activate User Account</label>
                                                        <select name="activate" class="form-select form-select-sm" size="1">
                                                            <option value="">Select</option>
                                                            <?php foreach (['0' => 'Not Active', '1' => 'Active'] as $key => $activate) { ?>
                                                            <option <?php if ($key === $info['is_email_activated']) {
                                                                            echo "selected";
                                                                        } ?> value="<?= $key; ?>"><?= ucfirst($activate); ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group form-actions text-right">
                                                <button type="submit" value="submit" class="btn btn-md btn-primary">
                                                    <i class="fa fa-check"></i> Update Account
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- END Update Profile -->
                            </div>
                            <!-- /.col-lg-6 (nested) -->
                        </div>
                        <!-- /.row (nested) -->
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
            <!-- END Profile Block -->
        </div>
        <!-- /.row -->
    </div>
</div>
</div>
<!-- /#page-wrapper -->