<?php

class AmendmentController extends Controller
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
      case "getAmendTable":
        $this->Security->config("validateForm", false);
        break;
      case "getVerifyTable":
        $this->Security->config("validateForm", false);
        break;
      case "getReviewTable":
        $this->Security->config("validateForm", false);
        break;
    }
  }

  public function amendlists()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/amendtable/", Config::get("VIEWS_PATH") . "amendment/amend_lists.php");
  }

  public function viewamendAdetail($siriNo)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/amendAdetail/", Config::get("VIEWS_PATH") . "amendment/viewamendAdetail.php", ["siriNo" => $siriNo]);
  }

  public function viewamendBdetail($siriNo)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/amendBdetail/", Config::get("VIEWS_PATH") . "amendment/viewamendBdetail.php", ["siriNo" => $siriNo]);
  }

  public function viewamendCdetail($siriNo)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/amendCdetail/", Config::get("VIEWS_PATH") . "amendment/viewamendCdetail.php", ["siriNo" => $siriNo]);
  }

  public function viewamendPSdetail($siriNo)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/amendPSdetail/", Config::get("VIEWS_PATH") . "amendment/viewamendPSdetail.php", ["siriNo" => $siriNo]);
  }

  public function viewcalcland($siriNo)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/viewcalcland/", Config::get("VIEWS_PATH") . "amendment/viewcalcland.php", ["siriNo" => $siriNo]);
  }

  public function viewcalcbuilding($siriNo)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/viewcalcbuilding/", Config::get("VIEWS_PATH") . "amendment/viewcalcbuilding.php", ["siriNo" => $siriNo]);
  }

  public function verifylists()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/verifytable/", Config::get("VIEWS_PATH") . "amendment/verify_lists.php");
  }

  public function macthaccount($fileId)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/macthaccount/", Config::get("VIEWS_PATH") . "amendment/macth_account.php", ["fileId" => $fileId]);
  }

  public function remacthaccount($fileId)
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/remacthaccount/", Config::get("VIEWS_PATH") . "amendment/remacth_account.php", ["fileId" => $fileId]);
  }

  public function reviewlist()
  {
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/reviewlist/", Config::get("VIEWS_PATH") . "amendment/review_list.php");
  }

  public function viewimages($fileId)
  {
    Config::setJsConfig("curPage", "amendment");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/viewimages/", Config::get("VIEWS_PATH") . "amendment/viewimages.php", ["fileId" => $fileId]);
  }

  public function viewdocuments($fileId)
  {
    Config::setJsConfig("curPage", "amendment");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/amendment/viewdocuments/", Config::get("VIEWS_PATH") . "amendment/viewdocuments.php", ["fileId" => $fileId]);
  }

  public function getAmendTable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $area = $this->request->data("area");
    $street = $this->request->data("street");
    $result = $this->amendment->getAmendTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $area, $street);

    if (!$result) {
      $this->view->renderErrors($this->amendment->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function getVerifyTable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $area = $this->request->data("area");
    $street = $this->request->data("street");
    $result = $this->amendment->getVerifyTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $area, $street);

    if (!$result) {
      $this->view->renderErrors($this->amendment->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function getReviewTable()
  {
    $draw = $this->request->data("draw");
    $row = $this->request->data("start");
    $rowperpage = $this->request->data("length");
    $column = $this->request->data("order");
    $columnIndex = $column[0]["column"];
    $columns = $this->request->data("columns");
    $columnName = $columns[$columnIndex]["data"];
    $columnSortOrder = $column[0]["dir"];
    $area = $this->request->data("area");
    $street = $this->request->data("street");
    $result = $this->amendment->getReviewTable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $area, $street);

    if (!$result) {
      $this->view->renderErrors($this->amendment->errors());
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
