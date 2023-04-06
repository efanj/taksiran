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
                  <h4 class="ml15">Error log</h4>
                </div>
                <!--end col-->
                <div class="col-auto">
                </div>
                <!--end col-->
              </div>
            </div>
            <div class="panel-body">

              <div style="font-size: 12px; font-weight: 500;">
                <?php
                                $file = fopen(APP . "logs/log.txt", "r");
                                if ($file) {
                                    while (($line = fgets($file)) !== false) {
                                        echo $line . "<br>";
                                    }

                                    fclose($file);
                                } else {
                                    echo "File does not exist!";
                                }
                                ?>
              </div>
            </div>
            <!-- /.panel-body -->
          </div>
        </div>
        <!-- END Newsfeed Block -->
      </div>

    </div>
  </div>