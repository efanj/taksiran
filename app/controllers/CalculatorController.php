<?php

class CalculatorController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "calculator");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "buildingSubmit":
        $this->Security->config("validateForm", false);
        break;
      case "landSubmit":
        $this->Security->config("validateForm", false);
        break;
      case "delete":
        $this->Security->config("form", ["fields" => ["file_id"]]);
        break;
    }
  }

  public function viewcalcland($siriNo)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/viewcalcland/", Config::get("VIEWS_PATH") . "calculator/viewcalcland.php", ["siriNo" => $siriNo]);
  }

  public function viewcalcbuilding($siriNo)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/viewcalcbuilding/", Config::get("VIEWS_PATH") . "calculator/viewcalcbuilding.php", ["siriNo" => $siriNo]);
  }

  public function calcland($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/calcland/", Config::get("VIEWS_PATH") . "calculator/calcland.php", ["siriNo" => $siriNo]);
  }

  public function calcbuilding($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/calcbuilding/", Config::get("VIEWS_PATH") . "calculator/calcbuilding.php", ["siriNo" => $siriNo]);
  }

  public function landindustry($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/landindustry/", Config::get("VIEWS_PATH") . "calculator/calclandindustry.php", ["siriNo" => $siriNo]);
  }

  public function landresidence($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/landresidence/", Config::get("VIEWS_PATH") . "calculator/calclandresidence.php", ["siriNo" => $siriNo]);
  }

  public function oilstation($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/oilstation/", Config::get("VIEWS_PATH") . "calculator/calcoilstation.php", ["siriNo" => $siriNo]);
  }

  public function specialproperty($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/specialproperty/", Config::get("VIEWS_PATH") . "calculator/specialproperty.php", ["siriNo" => $siriNo]);
  }

  public function factory($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/factory/", Config::get("VIEWS_PATH") . "calculator/calcfactory.php", ["siriNo" => $siriNo]);
  }

  public function telcotower($siriNo)
  {
    Config::setJsConfig("curPage", "calculator");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/calculator/telcotower/", Config::get("VIEWS_PATH") . "calculator/telcotower.php", ["siriNo" => $siriNo]);
  }

  public function buildingSubmit()
  {
    $siriNo = $this->request->data("siri_no");
    $akaun = $this->request->data("akaun");
    $comparison = $this->request->data("comparison");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $section_one = $this->request->data("section_one");
    $section_two = $this->request->data("section_two");
    $discount = $this->request->data("discount");
    $rental = $this->request->data("rental");
    $even = $this->request->data("even");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->buildingSubmit(Session::getUserId(), Session::getUserWorkerId(), $siriNo, $akaun, $comparison, $breadth_land, $price_land, $section_one, $section_two, $discount, $rental, $even, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function landSubmit()
  {
    $siriNo = $this->request->data("siri_no");
    $acctNo = $this->request->data("akaun");
    $comparison = $this->request->data("comparison");
    $breadth_land = $this->request->data("breadth_land");
    $price_land = $this->request->data("price_land");
    $current = $this->request->data("current");
    $discount = $this->request->data("discount");
    $even = $this->request->data("even");
    $yearly = $this->request->data("yearly");
    $rate = $this->request->data("rate");
    $tax = $this->request->data("tax");

    $result = $this->calculator->landSubmit(Session::getUserId(), Session::getUserWorkerId(), $siriNo, $acctNo, $comparison, $breadth_land, $price_land, $current, $discount, $even, $yearly, $rate, $tax);

    if (!$result) {
      $this->view->renderErrors($this->calculator->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "calculator";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for normal users
    Permission::allow("user", $resource, "*");

    return Permission::check($role, $resource, $action);
  }
}