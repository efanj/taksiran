<?php

class ReportController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "report");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "sitereviewtable":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function sitereview()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/report/sitereview/", Config::get("VIEWS_PATH") . "report/sitereviews.php");
  }

  public function approved()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/report/approved/", Config::get("VIEWS_PATH") . "report/approved.php");
  }

  public function pending()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/report/pending/", Config::get("VIEWS_PATH") . "report/pending.php");
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
    $result = $this->report->sitereviewtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->report->errors());
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
    Permission::allow("vendor", $resource, ["sitereview", "approved", "pending", "sitereviewtable"]);

    return Permission::check($role, $resource, $action);
  }
}