<?php

class VendorController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "vendor");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "rentbenchmarktable":
        $this->Security->config("validateForm", false);
        break;
      case "costbenchmarktable":
        $this->Security->config("validateForm", false);
        break;
      case "sitereviewtable":
        $this->Security->config("validateForm", false);
        break;
      case "insertrentbenchmark":
        $this->Security->config("validateForm", false);
        break;
      case "insertcostbenchmark":
        $this->Security->config("validateForm", false);
        break;
      case "uploadbenchmarkdocs":
        $this->Security->config("validateForm", false);
        break;
      case "uploadimages":
        $this->Security->config("validateForm", false);
        break;
      case "uploaddocuments":
        $this->Security->config("validateForm", false);
        break;
      case "deletesitereview":
        $this->Security->config("form", ["fields" => ["file_id"]]);
        break;
      case "deletebenchdocument":
        $this->Security->config("form", ["fields" => ["doc_id"]]);
        break;  
      case "deleteimage":
        $this->Security->config("form", ["fields" => ["image_id"]]);
        break;
      case "deletedocument":
        $this->Security->config("form", ["fields" => ["doc_id"]]);
        break;
    }
  }

  public function rentbenchmark()
  {
    Config::setJsConfig("curPage", "vendor");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/rentbenchmark/", Config::get("VIEWS_PATH") . "vendor/rent-benchmark.php");
  }

  public function costbenchmark()
  {
    Config::setJsConfig("curPage", "vendor");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/costbenchmark/", Config::get("VIEWS_PATH") . "vendor/cost-benchmark.php");
  }

  public function sitereview()
  {
    Config::setJsConfig("curPage", "vendor");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/sitereview/", Config::get("VIEWS_PATH") . "vendor/sitereviews.php");
  }

  public function submitted()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/submitted/", Config::get("VIEWS_PATH") . "vendor/submitted.php");
  }

  public function approved()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/approved/", Config::get("VIEWS_PATH") . "vendor/approved.php");
  }

  public function pending()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/pending/", Config::get("VIEWS_PATH") . "vendor/pending.php");
  }

  public function viewbenchmark($id)
  {
    Config::setJsConfig("curPage", "vendor");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/viewbenchmark/", Config::get("VIEWS_PATH") . "vendor/viewbenchmarkdocs.php", ["id" => $id]);
  }

  public function viewimages($reviewId)
  {
    Config::setJsConfig("curPage", "vendor");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/viewimages/", Config::get("VIEWS_PATH") . "vendor/viewimages.php", ["reviewId" => $reviewId]);
  }

  public function viewdocuments($reviewId)
  {
    Config::setJsConfig("curPage", "vendor");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/viewdocuments/", Config::get("VIEWS_PATH") . "vendor/viewdocuments.php", ["reviewId" => $reviewId]);
  }

  public function rentbenchmarktable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->vendor->rentbenchmarktable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function costbenchmarktable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $result = $this->vendor->costbenchmarktable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function sitereviewtable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    // $search = $this->request->data("search");
    // $searchValue = strtoupper($search["value"]);
    $area = $this->request->data("area");
    $street = $this->request->data("street");
    $result = $this->vendor->sitereviewtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $area, $street);
    if (!$result) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function insertrentbenchmark()
  {
    $ratetype = $this->request->data("ratetype");
    $akaun = $this->request->data("akaun");
    $jlkod = $this->request->data("jlkod");
    $kwkod = $this->request->data("kwkod");
    $owner = $this->request->data("pemilik");
    $htkod = $this->request->data("htkod");
    $items_rent = $this->request->data("items_rent");

    $result = $this->vendor->insertrentbenchmark(Session::getUserId(), $ratetype, $akaun, $jlkod, $kwkod, $owner, $htkod, $items_rent);

    if (!$result) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function insertcostbenchmark()
  {
    $ratetype = $this->request->data("ratetype");
    $akaun = $this->request->data("akaun");
    $jlkod = $this->request->data("jlkod");
    $kwkod = $this->request->data("kwkod");
    $owner = $this->request->data("pemilik");
    $htkod = $this->request->data("htkod");
    $items_cost = $this->request->data("items_cost");

    $result = $this->vendor->insertcostbenchmark(Session::getUserId(), $ratetype, $akaun, $jlkod, $kwkod, $owner, $htkod, $items_cost);

    if (!$result) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function uploadbenchmarkdocs()
  {
    $id = Encryption::decryptId($this->request->data("id"));
    $file_type = $this->request->data("file_type");
    $filename = $this->request->data("filename");
    $description = $this->request->data("description");
    $fileData = $this->request->data("file");

    $file = $this->vendor->uploadbenchmarkdocs(Session::getUserId(), $id, $file_type, $filename, $description, $fileData);

    if (!$file) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $fileHTML = $this->view->render(Config::get("VIEWS_PATH") . "vendor/benchmarkdocs.php", ["files" => $file]);
      $this->view->renderJson(["data" => $fileHTML]);
    }
  }

  public function uploadimages()
  {
    $no_akaun = $this->request->data("no_akaun");
    $filename = $this->request->data("filename");
    $description = $this->request->data("description");
    $fileData = $this->request->data("file");

    $file = $this->vendor->uploadimages(Session::getUserId(), $no_akaun, $filename, $description, $fileData);

    if (!$file) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $fileHTML = $this->view->render(Config::get("VIEWS_PATH") . "vendor/files.php", ["files" => $file]);
      $this->view->renderJson(["data" => $fileHTML]);
    }
  }

  public function uploaddocuments()
  {
    $no_akaun = $this->request->data("no_akaun");
    $file_type = $this->request->data("file_type");
    $filename = $this->request->data("filename");
    $description = $this->request->data("description");
    $fileData = $this->request->data("file");

    $file = $this->vendor->uploaddocuments(Session::getUserId(), $no_akaun, $file_type, $filename, $description, $fileData);

    if (!$file) {
      $this->view->renderErrors($this->vendor->errors());
    } else {
      $fileHTML = $this->view->render(Config::get("VIEWS_PATH") . "vendor/docs.php", ["files" => $file]);
      $this->view->renderJson(["data" => $fileHTML]);
    }
  }

  public function deletesitereview()
  {
    $fileId = Encryption::decryptId($this->request->data("file_id"));

    $this->vendor->deletesitereview(Session::getUserId(), $fileId);

    $this->view->renderJson(["success" => true]);
  }

  public function deletebenchdocument()
  {
    $docId = Encryption::decryptId($this->request->data("doc_id"));

    $this->vendor->deletebenchdocument(Session::getUserId(), $docId);

    $this->view->renderJson(["success" => true]);
  }

  public function deleteimage()
  {
    $imageId = Encryption::decryptId($this->request->data("image_id"));

    $this->vendor->deleteimage(Session::getUserId(), $imageId);

    $this->view->renderJson(["success" => true]);
  }

  public function deletedocument()
  {
    $docId = Encryption::decryptId($this->request->data("doc_id"));

    $this->vendor->deletedocument(Session::getUserId(), $docId);

    $this->view->renderJson(["success" => true]);
  }

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "vendor";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for user
    Permission::allow("user", $resource, "*");

    //only for normal vendor
    Permission::allow("vendor", $resource, ["reference", "sitereview", "submitted", "approved", "pending", "sitereviewtable"]);
    Permission::allow("vendor", $resource, ["uploadbenchmarkdocs", "insertcostbenchmark", "insertrentbenchmark", "viewbenchmark", "viewimages"]);
    Permission::allow("vendor", $resource, ["viewdocuments", "uploadimages", "uploaddocuments", "deletesitereview", "deleteimage", "deletedocument"]);

    return Permission::check($role, $resource, $action);
  }
}