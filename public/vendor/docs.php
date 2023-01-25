<?php if (empty($files)) { ?>
<div class='col-xs-12 col-md-12 tac no-data'>There is no files!</div>

<?php } else {foreach ($files as $doc) { ?>
<div class="col-xs-12 col-md-3 docPanel">
  <div class="panel panel-default plain">
    <div class="panel-heading">
      <h4 class="panel-title"><strong><?= $doc["filename"] ?></strong><br>
        <small><?= $doc["description"] ?></small>
      </h4>
      <div class="btn-group" role="group">
        <div class="checkbox-custom">
          <input class="check" type="checkbox" value="<?= $doc["id"] ?>" id="checkbox8">
          <label for="checkbox8"></label>
        </div>
        <a href="<?= PUBLIC_ROOT . "downloads/download/" . urlencode($doc["hashed_filename"]) ?>"
          class="btn btn-default btn-sm">
          <i class="fa fa-download mr5"></i>Muat turun
        </a>
        <a href="#" class="btn btn-default btn-sm delete-doc" data-id="<?= Encryption::encryptId($doc["id"]) ?>"><i
            class="fa fa-trash-o mr5"></i>Padam</a>
      </div>
    </div>
    <div class="panel-body">
      <?php if ($doc["extension"] == "pdf") { ?>
      <embed src="<?= PUBLIC_ROOT ?>img/documents/<?= $doc["hashed_filename"] . "." . $doc["extension"] ?>"
        type="application/pdf" width='100%' height='250px'>
      <?php } elseif ($doc["extension"] == "doc" || $doc["extension"] == "docx" || $doc["extension"] == "ppt" || $doc["extension"] == "pptx") { ?>
      <iframe
        src='https://view.officeapps.live.com/op/embed.aspx?src=<?= PUBLIC_ROOT ?>img/documents/<?= $doc["hashed_filename"] . "." . $doc["extension"] ?>'
        frameborder='0' width='100%' height='250px'></iframe>
      <?php } ?>
    </div>
  </div>
</div>
<?php }} ?>