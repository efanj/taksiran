<div class="page-content sidebar-page right-sidebar-page clearfix">
  <!-- .page-content-wrapper -->
  <div class="page-content-wrapper">
    <div class="page-content-inner">
      <!-- Start .row -->
      <?php $docs = $this->controller->Informations->sitereviewinfo($fileId); ?>
      <div class="row">
        <div class="col-lg-8 col-sm-8 col-md-8">
          <div class="panel panel-primary">
            <div class="panel-heading">
              <h4>GALERI DOKUMEN</h4>
            </div>
            <div class="panel-body">
              <div class="row gallery sortable-layout">
                <?php
                $filesData = $this->controller->Informations->getAllDocs($fileId);
                echo $this->render(Config::get("VIEWS_PATH") . "amendment/docs.php", ["files" => $filesData]);
                ?>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-sm-4 col-md-4">
          <div class="panel panel-primary">
            <div class="panel-body"></div>
          </div>
        </div>
      </div>
    </div>
  </div>