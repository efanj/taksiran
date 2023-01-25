<!-- Page Content-->
<div class="page-body">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-8 col-md-8 offset-md-2 offset-sm-2">
                <div class="card card-default content-scrollbar">
                    <div class="card-header bg-primary" style="padding:15px;">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Daftar Pengguna</h5>
                            </div>
                            <!--end col-->
                            <div class="col-auto">
                                <button class="btn btn-pill btn-light btn-air-light btn-xs" onclick="history.back();">KEMBALI</button>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if (empty(Session::get('register-success'))) { ?>
                        <form action="<?php echo PUBLIC_ROOT; ?>Login/register" id="form-register" method="post" autocomplete="off">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Emel</label>
                                        <input type="email" name="email" class="form-control form-control-sm" maxlength="64" required>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Nama</label>
                                        <input dir="auto" type="text" name="name" class="form-control form-control-sm" minlength="5" maxlength="128" required>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        $datajabatan = $this->controller->admin->getJabatan();
                                        ?>
                                        <label class="form-label">Jabatan</label>
                                        <select class="form-select form-select-sm" name="workplace">
                                            <option value="">Sila Pilih</option>
                                            <?php 
                                            foreach ($datajabatan as $jab) { ?>
                                            <option value="<?= $jab["department_name"]; ?>"><?= $jab["department_name"]; ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php 
                                        $datajawatan = $this->controller->admin->getJawatan();
                                        ?>
                                        <label>Jawatan</label>
                                        <select name="position" class="form-select form-select-sm" size="1">
                                            <option value="">Sila Pilih</option>
                                            <?php foreach ($datajawatan as $jaw) { ?>
                                            <option value="<?= $jaw['position_name']; ?>"><?= ucfirst($jaw['position_name']); ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Hubungi No.</label>
                                        <input class="form-control form-control-sm" name="contact_no" type="text">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">ID Pekerja</label>
                                        <input dir="auto" type="text" name="worker_id" class="form-control form-control-sm" maxlength="50" required>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Kumpulan</label>
                                        <select name="group" class="form-select form-select-sm" required>
                                            <option value="">Sila Pilih</option>
                                            <?php foreach (['penginput' => 'PENGINPUT', 'penyelia' => 'PENYELIA'] as $key => $group) { ?>
                                            <option value="<?= $key; ?>"><?= ucfirst($group); ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Kata-Laluan</label>
                                        <input autocomplete="new-password" type="password" name="password" id="password" class="form-control form-control-sm" minlength="6" required>
                                        <div class="password-show-hide"><span class="show"> </span></div>
                                        <small class="form-text text-muted">Passwords must contain at least one uppercase, lowercase and number</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Pengesahan Kata-Laluan</label>
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
                            <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Peranan</label>
                                        <select name="role" class="form-select form-select-sm" required>
                                            <option value="">Sila Pilih</option>
                                            <?php foreach (['admin', 'penilaian', 'jurutera', 'public'] as $role) { ?>
                                            <?php if ($role === $info['role']) { ?>
                                            <option selected value="<?= $info['role']; ?>"><?= ucfirst($info['role']); ?></option>
                                            <?php } else { ?>
                                            <option value="<?= $role; ?>"><?= ucfirst($role); ?></option>
                                            <?php } ?>
                                            <?php } ?>
                                        </select>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Aktifkan Akaun Pengguna</label>
                                        <select name="activate" class="form-select form-select-sm" required>
                                            <option value="">Sila Pilih</option>
                                            <?php foreach (['0' => 'Not Active', '1' => 'Active'] as $key => $activate) { ?>
                                            <option value="<?= $key; ?>"><?= ucfirst($activate); ?></option>
                                            <?php } ?>
                                        </select>
                                        <small class="form-text text-muted">* Wajib</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>" />
                            </div>
                            <div class="form-group form-actions text-right">
                                <button type="submit" name="submit" class="btn btn-sm btn-primary">
                                    <i class="fa fa-check"></i> Daftar
                                </button>
                            </div>
                        </form>
                        <?php } else {
                            echo $this->renderSuccess(Session::getAndDestroy('register-success'));
                        } ?>
                        <?php
                        if (!empty(Session::get('register-errors'))) {
                            echo $this->renderErrors(Session::getAndDestroy('register-errors'));
                        }
                        ?>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /#page-wrapper -->