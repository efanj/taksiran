</div>
<div id="footer">
  <div class="footer-copyright">
    <div class="container">
      <p class="pull-left"><?= Config::get("COPYRIGHT") . " " . date("Y") ?></p>
    </div>
  </div>
</div>
<!-- / #footer -->
<!-- Back to top -->
<div id="back-to-top"><a href="#">Back to Top</a>
</div>
<!-- Javascripts -->
<!-- Load pace first -->
<script src="<?= PUBLIC_ROOT ?>plugins/core/pace/pace.min.js"></script>
<!-- Important javascript libs(put in all pages) -->
<script src="<?= PUBLIC_ROOT ?>js/libs/jquery-2.1.1.min.js"></script>
<script src="<?= PUBLIC_ROOT ?>js/libs/jquery-ui-1.10.4.min.js"></script>
<!-- Bootstrap plugins -->
<script src="<?= PUBLIC_ROOT ?>js/bootstrap/bootstrap.js"></script>
<!-- Core plugins ( not remove ) -->
<script src="<?= PUBLIC_ROOT ?>js/libs/modernizr.custom.js"></script>
<!-- Remove click delay in touch -->
<!-- Handle responsive view functions -->
<script src="<?= PUBLIC_ROOT ?>js/jRespond.min.js"></script>
<!-- Datatables -->
<script src="<?= PUBLIC_ROOT ?>plugins/tables/datatables/jquery.dataTables.js"></script>
<script src="<?= PUBLIC_ROOT ?>plugins/tables/datatables/dataTables.bootstrap.js"></script>
<!-- Custom scroll for sidebars,tables and etc. -->
<script src="<?= PUBLIC_ROOT ?>plugins/core/slimscroll/jquery.slimscroll.min.js"></script>
<script src="<?= PUBLIC_ROOT ?>plugins/core/slimscroll/jquery.slimscroll.horizontal.min.js"></script>
<!-- Remove click delay in touch -->
<script src="<?= PUBLIC_ROOT ?>plugins/core/fastclick/fastclick.js"></script>
<!-- Increase jquery animation speed -->
<script src="<?= PUBLIC_ROOT ?>plugins/core/velocity/jquery.velocity.min.js"></script>
<!-- Bootbox fast bootstrap modals -->
<script src="<?= PUBLIC_ROOT ?>plugins/ui/bootbox/bootbox.js"></script>
<script src="<?= PUBLIC_ROOT ?>js/libs/main.js"></script>
<script src="<?= PUBLIC_ROOT ?>js/main.js"></script>
<script src="<?= PUBLIC_ROOT ?>js/setting.js" type="text/javascript"></script>
<!-- Other plugins ( load only nessesary plugins for every page) -->
<script src="<?= PUBLIC_ROOT ?>js/pages/table-macthing.js" type="text/javascript"></script>

<?php Config::setJsConfig("csrfToken", Session::generateCsrfToken()); ?>
<!-- Assign all configration variables -->
<script>
config = <?= json_encode(Config::getJsConfig()) ?>;
</script>
<!-- Run the application -->
<script>
$(document).ready(app.init());
</script>

<?php Database::closeConnection(); ?>
</body>

</html>