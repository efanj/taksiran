<?php if (empty($files)) { ?>
<div class='col-xs-12 col-md-12 tac no-data'>There is no files!</div>

<?php } else {foreach ($files as $file) { ?>
<div class="col-xs-12 col-md-3">
  <div class="panel panel-default plain panelMove">
    <div class="panel-heading">
      <h4 class="panel-title"><strong><?= $file["filename"] ?></strong><br>
        <small><?= $file["description"] ?></small>
      </h4>
      <div class="btn-group" role="group">
        <a href="#" class="btn btn-default btn-sm" data-toggle="modal" data-target="#edit-image">
          <i class="fa fa-print mr5"></i>Cetak
        </a>
        <a href="#" class="btn btn-default btn-sm delete-image"><i class="fa fa-trash-o mr5"></i>Padam</a>
      </div>
    </div>
    <div class="panel-body">
      <a href="<?= PUBLIC_ROOT ?>img/big-lightgallry/<?= $file["hashed_filename"] ?>" data-toggle="lightbox"
        data-gallery="gallerymode" data-title="<?= $file["filename"] ?>" data-parrent>
        <img class="img-responsive" src="<?= PUBLIC_ROOT ?>img/thumb-lightgallry/<?= $file["hashed_filename"] ?>"
          alt="<?= $file["filename"] ?>">
      </a>
    </div>
  </div>
</div>
<?php }} ?>
