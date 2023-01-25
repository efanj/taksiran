        <div class="container">
          <div class="footer">
            <p class="text-center"><?=Config::get('COPYRIGHT'). " " . date("Y")?></p>
          </div>
        </div>
        <!-- Javascripts -->
        <!-- Important javascript libs(put in all pages) -->
        <script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script>
window.jQuery || document.write('<script src="<?= PUBLIC_ROOT; ?>js/libs/jquery-2.1.1.min.js">\x3C/script>')
        </script>
        <script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
        <script>
window.jQuery || document.write('<script src="<?= PUBLIC_ROOT; ?>js/libs/jquery-ui-1.10.4.min.js">\x3C/script>')
        </script>
        <!-- Bootstrap plugins -->
        <script src="<?= PUBLIC_ROOT; ?>js/bootstrap/bootstrap.js"></script>
        <!-- Form plugins -->
        <script src="<?= PUBLIC_ROOT; ?>plugins/forms/validation/jquery.validate.js"></script>
        <script src="<?= PUBLIC_ROOT; ?>plugins/forms/validation/additional-methods.min.js"></script>
        <!-- Init plugins olny for this page -->
        <script src="<?= PUBLIC_ROOT; ?>js/libs/main.js"></script>
        <script src="<?= PUBLIC_ROOT; ?>js/pages/login.js"></script>
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