<!-- Page Content-->
<div class="page-body">
    <div class="container-fluid">
        <!-- /.row -->
        <div class="row mt-3">
            <div class="col-sm-2 col-lg-2"></div>
            <div class="col-sm-8 col-lg-8">
                <div class="card card-default content-scrollbar">
                    <div class="card-header">
                        <h5>Kemas-Kini Profil</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form action="<?php echo PUBLIC_ROOT; ?>User/updateProfileInfo" id="form-profile-info" method="post">
                                    <div class="form-group">
                                        <div class="block-section text-center">
                                            <img src="<?= $info["image"];?>" class="img-circle profile-pic-lg">
                                            <h3 class="font-light"><strong><?= $info["name"];?></strong></h3>
                                            <h4>
                                                <span class="label label-primary"><?= ucfirst($info["role"]);?></span>
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Nama Pengguna</label>
                                        <input dir="auto" type="text" name="name" value="<?= $info["name"];?>" class="form-control form-control-sm" required maxlength="30" placeholder="Your Name..">
                                        <small class="form-text text-muted">The maximum number of characters allowed is <strong>30</strong></small>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Jawatan</label>
                                        <input dir="auto" type="text" name="position" value="<?= $info["position"];?>" class="form-control form-control-sm" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Kata-Laluan</label>
                                        <input type="password" name="password" id="password" class="form-control form-control-sm" placeholder="Password">
                                        <small class="form-text text-muted font-danger">Passwords must contain at least one uppercase, one lowercase, one number, and not less than 6 characters</small>
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
                                    <div class="form-group">
                                        <label class="form-label">Emel</label>
                                        <input type="email" name="email" value="<?= $this->encodeHTML($info["email"]); ?>" class="form-control form-control-sm" maxlength="50" placeholder="Your Email..">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="confirm_email" value="" class="form-control form-control-sm" maxlength="50" placeholder="Confirm Email">
                                        <small class="form-text text-muted">Please enter your email again.</small>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>" />
                                    </div>
                                    <div class="form-group form-actions text-right">
                                        <button type="submit" name="submit" value="submit" class="btn btn-md btn-primary">
                                            <i class="fa fa-check"></i> Kemas-Kini
                                        </button>
                                    </div>
                                </form>

                                <?php 
										if(!empty(Session::get('profile-info-errors'))){
											echo $this->renderErrors(Session::getAndDestroy('profile-info-errors'));
										}else if(!empty(Session::get('profile-info-success'))){
											echo $this->renderSuccess(Session::getAndDestroy('profile-info-success'));
										}
									?>

                                <?php if(!empty($emailUpdates["success"])):?>
                                <div class="success">
                                    <div class="alert alert-success">
                                        <i class="fa fa-check-circle"></i> <?= $emailUpdates["success"]; ?>
                                    </div>
                                </div>
                                <?php elseif(!empty($emailUpdates["errors"])):?>
                                <div class="error">
                                    <div class="alert alert-danger">
                                        <i class="fa fa-times-circle"></i> <strong>Heads Up!</strong>
                                        <br><i class="fa fa-angle-right"></i> <?= $emailUpdates["errors"][0]; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                                <!-- END Update Profile -->

                                <hr>
                                <!-- Upload Profile Picture -->
                                <form action="<?php echo PUBLIC_ROOT; ?>User/updateProfilePicture" id="form-profile-picture" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label class="form-label">Profile Picture</label>
                                        <input type="file" name="file" required>
                                        <p class="help-block"><em> Only JPEG, JPG, PNG & GIF Files</em></p>
                                        <p class="help-block"><em> Max File Size: 2MB</em></p>
                                    </div>
                                    <!-- Hidden By default-->
                                    <div class="progress progress-striped active display-none">
                                        <div class="progress-bar progress-bar-success" style="width: 0%"></div>
                                    </div>
                                    <div class="form-group">
                                        <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>" />
                                    </div>
                                    <div class="form-group form-actions text-right">
                                        <button type="submit" value="submit" class="btn btn-md btn-primary btn-sm">
                                            <i class="fa fa-upload"></i> Upload
                                        </button>
                                    </div>
                                </form>
                                <?php 
                                    if(!empty(Session::get('profile-picture-errors'))){
                                        echo $this->renderErrors(Session::getAndDestroy('profile-picture-errors'));
                                    }
                                ?>

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
    <!-- /#page-wrapper -->
</div>