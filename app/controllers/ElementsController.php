<?php

class ElementsController extends Controller
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
      case "referencetable":
        $this->Security->config("validateForm", false);
        break;
      case "customertable":
        $this->Security->config("validateForm", false);
        break;
      case "customeraddtable":
        $this->Security->config("validateForm", false);
        break;
      case "street":
        $this->Security->config("validateForm", false);
        break;
      case "hbangn":
        $this->Security->config("validateForm", false);
        break;
      case "delete":
        $this->Security->config("form", ["fields" => ["file_id"]]);
        break;
    }
  }

  public function reference()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/vendor/reference/", Config::get("VIEWS_PATH") . "vendor/reference.php");
  }

  public function referencetable()
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
    $result = $this->vendor->referencetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function customertable()
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
    $result = $this->elements->customertable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    if (!$result) {
      $this->view->renderErrors($this->account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function customeraddtable()
  {
    $plgid = $this->request->data("id_search");
    $result = $this->elements->customeraddtable($plgid);
    if (!$result) {
      $this->view->renderErrors($this->account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function street()
  {
    $area = $this->request->data("area");
    $result = $this->elements->street($area);
    if (!$result) {
      $this->view->renderErrors($this->account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function hbangn()
  {
    $result = $this->elements->hbangn();
    if (!$result) {
      $this->view->renderErrors($this->account->errors());
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

    //only for normal vendor
    Permission::allow("vendor", $resource, ["reference"]);

    return Permission::check($role, $resource, $action);
  }
}