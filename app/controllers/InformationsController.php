<?php

class InformationsController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "informations");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "sitereviewtable":
        $this->Security->config("validateForm", false);
        break;
      case "handleinfotable":
        $this->Security->config("validateForm", false);
        break;
      case "handleinfopstable":
        $this->Security->config("validateForm", false);
        break;
      case "ownerinfotable":
        $this->Security->config("validateForm", false);
        break;
      case "vendorinfotable":
        $this->Security->config("validateForm", false);
        break;
      case "getDetailsHandle":
        $this->Security->config("validateForm", false);
        break;
      case "getCalculationInfo":
        $this->Security->config("validateForm", false);
        break;
      case "comparison":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function sitereview()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/informations/sitereview/", Config::get("VIEWS_PATH") . "informations/sitereview.php");
  }

  public function handleinfo()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/informations/handleinfo/", Config::get("VIEWS_PATH") . "informations/handleinfo.php");
  }

  public function handleinfops()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/informations/handleinfops/", Config::get("VIEWS_PATH") . "informations/handleinfo_ps.php");
  }

  public function ownerinfo()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/informations/ownerinfo/", Config::get("VIEWS_PATH") . "informations/ownerinfo.php");
  }

  public function vendorinfo()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/informations/vendorinfo/", Config::get("VIEWS_PATH") . "informations/vendorinfo.php");
  }

  public function investigation($fileId)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/informations/investigation/", Config::get("VIEWS_PATH") . "informations/investigation.php", ["fileId" => $fileId]);
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
    $search = $this->request->data("search");
    $searchValue = strtoupper($search["value"]);
    $area = $this->request->data("area");
    $street = $this->request->data("street");
    $result = $this->informations->sitereviewtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $area, $street);
    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function handleinfotable()
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
    $area = $this->request->data("area");
    $street = $this->request->data("street");
    $result = $this->informations->handleinfotable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue, $area, $street);
    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function ownerinfotable()
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
    $result = $this->informations->ownerinfotable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function vendorinfotable()
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
    $result = $this->informations->vendorinfotable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function getDetailsHandle()
  {
    $noAkaun = Encryption::decryptId($this->request->data("noAkaun"));

    $result = $this->informations->getDetailsHandle($noAkaun);
    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function getCalculationInfo()
  {
    $siriNo = $this->request->data("siri");

    $result = $this->informations->getCalculationInfo($siriNo);

    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function comparison()
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
    $type = $this->request->data("type");
    $kwkod = $this->request->data("kwkod");
    $htkod = $this->request->data("htkod");
    $result = $this->informations->comparison($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue, $type, $kwkod, $htkod);
    if (!$result) {
      $this->view->renderErrors($this->informations->errors());
    } else {
      $this->view->renderJson($result);
    }
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

    //only for vendor
    Permission::allow("vendor", $resource, ["handleinfops", "handleinfotable", 'comparisontable', 'investigation']);

    return Permission::check($role, $resource, $action);
  }
}