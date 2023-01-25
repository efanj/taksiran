<!-- Page Content-->
<div class="page-body">
    <div class="container-fluid">
        <div class="row mt-3">
            <div class="col-sm-12 col-lg-12">
                <!-- Users Block -->
                <div class="card card-default content-scrollbar">
                    <div class="card-header bg-primary" style="padding:15px;">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Error log</h5>
                            </div>
                            <!--end col-->
                            <div class="col-auto">
                                <button class="btn btn-pill btn-light btn-air-light btn-xs" id="clearlog">Clear Log</button>
                            </div>
                            <!--end col-->
                        </div>
                    </div>
                    <div class="card-body">
                        <div style="font-size: 12px; font-weight: 500;">
                            <?php 
                        $file = fopen(APP."logs/log.txt", "r");
                        if ($file) {
                          while (($line = fgets($file)) !== false) {
                              echo $line."<br>";
                          }
                        
                          fclose($file);
                        }else{
                              echo "File does not exist!";}
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