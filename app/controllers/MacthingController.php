<?php

class MacthingController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "amendment");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "macthingtable":
        $this->Security->config("validateForm", false);
        break;
      case "remacthingtable":
        $this->Security->config("validateForm", false);
        break;
      case "ownerinfotable":
        $this->Security->config("validateForm", false);
        break;
      case "vendorinfotable":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function macthing()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/macth/macthing/", Config::get("VIEWS_PATH") . "macth/macthing.php");
  }

  public function remacthing()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/macth/remacthing/", Config::get("VIEWS_PATH") . "macth/remacthing.php");
  }

  public function macthaccount($fileId)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/macth/macthaccount/", Config::get("VIEWS_PATH") . "macth/macth_account.php", ["fileId" => $fileId]);
  }

  public function remacthaccount($fileId)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/macth/remacthaccount/", Config::get("VIEWS_PATH") . "macth/remacth_account.php", ["fileId" => $fileId]);
  }

  public function macthingtable()
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
    $result = $this->macthing->macthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->macthing->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function remacthingtable()
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
    $result = $this->macthing->remacthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->macthing->errors());
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

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "vendor";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for user
    Permission::allow("user", $resource, "*");

    return Permission::check($role, $resource, $action);
  }
}