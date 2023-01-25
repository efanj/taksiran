<?php

class FilecodeController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "filecode");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "landusetable":
        $this->Security->config("validateForm", false);
        break;
      case "landpropertytable":
        $this->Security->config("validateForm", false);
        break;
      case "ownertypetable":
        $this->Security->config("validateForm", false);
        break;
      case "buildingtypestable":
        $this->Security->config("validateForm", false);
        break;
      case "buildingstructuretable":
        $this->Security->config("validateForm", false);
        break;
      case "messagetable":
        $this->Security->config("validateForm", false);
        break;
      case "meetingtable":
        $this->Security->config("validateForm", false);
        break;
      case "annualratetable":
        $this->Security->config("validateForm", false);
        break;
      case "locationtable":
        $this->Security->config("validateForm", false);
        break;
      case "reviewratetable":
        $this->Security->config("validateForm", false);
        break;
      case "reloadLandUse":
        $this->Security->config("validateForm", false);
        break;
      case "reloadLandProperty":
        $this->Security->config("validateForm", false);
        break;
      case "reloadOwnerType":
        $this->Security->config("validateForm", false);
        break;
      case "reloadBuildingType":
        $this->Security->config("validateForm", false);
        break;
      case "reloadBuildingStructure":
        $this->Security->config("validateForm", false);
        break;
      case "reloadMessageMJP":
        $this->Security->config("validateForm", false);
        break;
      case "reloadAnnualRate":
        $this->Security->config("validateForm", false);
        break;
      case "reloadMeetingMJP":
        $this->Security->config("validateForm", false);
        break;
      case "reloadLocation":
        $this->Security->config("validateForm", false);
        break;
      case "updateReviewRate":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function landuse()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/landuse/", Config::get("VIEWS_PATH") . "filecode/tanah.php");
  }

  public function landproperty()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/landproperty/", Config::get("VIEWS_PATH") . "filecode/hartatanah.php");
  }

  public function ownertype()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/ownertype/", Config::get("VIEWS_PATH") . "filecode/jenispemilik.php");
  }

  public function buildingtypes()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/buildingtypes/", Config::get("VIEWS_PATH") . "filecode/jenisbangunan.php");
  }

  public function buildingstructure()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/buildingstructure/", Config::get("VIEWS_PATH") . "filecode/strukturbangunan.php");
  }

  public function message()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/message/", Config::get("VIEWS_PATH") . "filecode/mesej.php");
  }

  public function meeting()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/meeting/", Config::get("VIEWS_PATH") . "filecode/mesyuarat.php");
  }

  public function annualrate()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/annualrate/", Config::get("VIEWS_PATH") . "filecode/kadar.php");
  }

  public function location()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/location/", Config::get("VIEWS_PATH") . "filecode/lokasi.php");
  }

  public function reviewrate()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/filecode/reviewrate/", Config::get("VIEWS_PATH") . "filecode/reviewrate.php");
  }

  public function landusetable()
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
    $result = $this->filecode->landusetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function landpropertytable()
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
    $result = $this->filecode->landpropertytable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function ownertypetable()
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
    $result = $this->filecode->ownertypetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function buildingtypestable()
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
    $result = $this->filecode->buildingtypestable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function buildingstructuretable()
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
    $result = $this->filecode->buildingstructuretable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function messagetable()
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
    $result = $this->filecode->messagetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function meetingtable()
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
    $result = $this->filecode->meetingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function annualratetable()
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
    $result = $this->filecode->annualratetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function locationtable()
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
    $result = $this->filecode->locationtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reviewratetable()
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
    $result = $this->filecode->reviewratetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadLandUse()
  {
    $result = $this->filecode->reloadLandUse();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadLandProperty()
  {
    $result = $this->filecode->reloadLandProperty();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadOwnerType()
  {
    $result = $this->filecode->reloadOwnerType();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadBuildingType()
  {
    $result = $this->filecode->reloadBuildingType();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadBuildingStructure()
  {
    $result = $this->filecode->reloadBuildingStructure();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadMessageMJP()
  {
    $result = $this->filecode->reloadMessageMJP();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadAnnualRate()
  {
    $result = $this->filecode->reloadAnnualRate();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadMeetingMJP()
  {
    $result = $this->filecode->reloadMeetingMJP();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function reloadLocation()
  {
    $result = $this->filecode->reloadLocation();
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function updateReviewRate()
  {
    $kwsKwkod = $this->request->data("kws_kwkod");
    $hrtHtkod = $this->request->data("hrt_htkod");
    $newRate = $this->request->data("new_rate");
    $result = $this->filecode->updateReviewRate($kwsKwkod, $hrtHtkod, $newRate);
    if (!$result) {
      $this->view->renderErrors($this->filecode->errors());
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
    Permission::allow("vendor", $resource, ["reviewrate", "reviewratetable"]);

    return Permission::check($role, $resource, $action);
  }
}