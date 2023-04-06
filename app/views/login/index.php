<div class="container login-container">
  <div class="login-panel panel panel-default plain animated bounceIn">
    <!-- Start .panel -->
    <div class="panel-heading">
      <h4 class="panel-title text-center">
        <img id="logo" src="<?php echo PUBLIC_ROOT; ?>img/logo/logolg.png" alt="<?= Config::get('WEBSITE_NAME'); ?> logo">
      </h4>
    </div>
    <div class="panel-body">
      <form class="form-horizontal mt0" action="<?php echo PUBLIC_ROOT; ?>Login/login" id="login-form" role="form" method="post">
        <div class="form-group">
          <label for="workerid" class="col-sm-12 control-label">ID Perkerja</label>
          <div class="col-sm-12">
            <div class="input-group input-icon">
              <span class="input-group-addon"><i class="glyphicon glyphicon-user s16"></i></span>
              <input type="text" class="form-control input-sm" name="workerid" id="workerid" placeholder="1010">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="password" class="col-sm-12 control-label">Kata-laluan</label>
          <div class="col-sm-12">
            <div class="input-group input-icon">
              <span class="input-group-addon"><i class="fa fa-key s16"></i></span>
              <input type="password" class="form-control input-sm" name="password" id="password" placeholder="*********">
            </div>
          </div>
        </div>
        <?php if (!empty($redirect)) { ?>
          <div class="form-group">
            <input type="hidden" name="redirect" value="<?= $this->encodeHTML($redirect); ?>" />
          </div>
        <?php } ?>
        <div class="form-group">
          <input type="hidden" name="csrf_token" value="<?= Session::generateCsrfToken(); ?>" />
        </div>
        <div class="form-group mb0">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4 mb25">
            <button class="btn btn-default pull-right" type="submit">Login</button>
          </div>
        </div>
        <div class="form-group mb0">
          <?php
          if (!empty(Session::get('login-errors'))) {
            echo $this->renderErrors(Session::getAndDestroy('login-errors'));
          }
          ?>
        </div>
      </form>
    </div>
  </div>
  <!-- End .panel -->
</div>