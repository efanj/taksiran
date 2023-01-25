<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright <script>
                    document.write(new Date().getFullYear())
                    </script> © e-Taksiran rights reserved.</p>
            </div>
            <div class="col-md-6">
                <p class="pull-right mb-0">by MDkampar</p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
<!-- latest jquery-->
<script src="<?= PUBLIC_ROOT; ?>js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?v=3&key=<?=Config::get('GOOGLE_KEY')?>&libraries=places"></script>
<!-- feather icon js-->
<script src="<?= PUBLIC_ROOT; ?>plugins/icons/feather-icon/feather.min.js"></script>
<script src="<?= PUBLIC_ROOT; ?>plugins/icons/feather-icon/feather-icon.js"></script>
<!-- Sidebar jquery-->
<script src="<?= PUBLIC_ROOT; ?>js/sidebar-menu.js"></script>
<script src="<?= PUBLIC_ROOT; ?>js/config.js"></script>
<!-- Bootstrap js-->
<script src="<?= PUBLIC_ROOT; ?>plugins/dragable/jquery-ui.min.js"></script>
<script src="<?= PUBLIC_ROOT; ?>plugins/bootstrap/popper.min.js"></script>
<script src="<?= PUBLIC_ROOT; ?>plugins/bootstrap/bootstrap.min.js"></script>
<!-- Plugins JS start-->
<script src="<?= PUBLIC_ROOT; ?>js/jquery.slimscroll.min.js"></script>
<script src="<?= PUBLIC_ROOT; ?>plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?= PUBLIC_ROOT; ?>plugins/datatable/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?= PUBLIC_ROOT; ?>js/tooltip-init.js"></script>
<!-- Plugins JS Ends-->
<!-- Theme js-->
<script src="<?= PUBLIC_ROOT; ?>js/script.js"></script>

<script src="<?= PUBLIC_ROOT; ?>js/main.js"></script>

<script src="<?= PUBLIC_ROOT; ?>pages/jquery.users.init.js"></script>

<!-- Assign CSRF Token to JS variable -->
<?php Config::setJsConfig('csrfToken', Session::generateCsrfToken()); ?>
<!-- Assign all configration variables -->
<script>
config = <?= json_encode(Config::getJsConfig()); ?>;
</script>
<!-- Run the application -->
<script>
$(document).ready(app.init());
</script>

<?php Database::closeConnection(); ?>
</body>

</html>