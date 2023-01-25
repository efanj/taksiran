<?php

class AccountController extends Controller
{
  public function beforeAction()
  {
    parent::beforeAction();

    Config::setJsConfig("curPage", "account");

    $action = $this->request->param("action");
    $actions = ["create", "delete"];
    $this->Security->requireAjax($actions);
    $this->Security->requirePost($actions);

    switch ($action) {
      case "newaccount":
        $this->Security->config("form", ["fields" => ["file"]]);
        break;
      case "getSumbangan":
        $this->Security->config("form", ["fields" => ["jpkod"]]);
        break;
      case "createAcct":
        $this->Security->config("form", [
          "fields" => [
            "mjcTkhpl",
            "mjcTkhtk",
            "mjcTkhoc",
            "mjcAkaun",
            "mjcDigit",
            "mjcHsiri",
            "mjcStcbk",
            "mjcOldac",
            "mjcNobil",
            "mjcNolot",
            "mjcBllot",
            "mjcJlkod",
            "kawKwkod",
            "mjcAdpg1",
            "mjcAdpg2",
            "mjcThkod",
            "mjcBgkod",
            "mjcHtkod",
            "mjcStkod",
            "mjcJpkod",
            "mjcCodex",
            "mjcCodey",
            "mjcDiskn",
            "mjcSmpah",
            "mjcNompt",
            "mjcRjfil",
            "mjcPelan",
            "mjcHkmlk",
            "mjcBilpk",
            "mjcRjmmk",
            "mjcLsbgn",
            "mjcLstnh",
            "mjcLsans",
            "mjcSbkod",
            "mjcMesej",
            "mjcNmbil",
            "mjcPlgid",
            "mjcAmtid",
          ],
        ]);
        break;
      case "createB":
        $this->Security->config("form", ["fields" => ["mjbTkhpl", "mjbTkhtk", "mjbAkaun", "mjbDigit", "mjbStcbk", "kawKwkod", "mjbThkod", "mjbBgkod", "mjbHtkod", "mjbStkod", "mjbJpkod", "mjbCodex", "mjbCodey", "mjbSbkod", "mjbMesej"]]);
        break;
      case "createPS":
        $this->Security->config("form", ["fields" => ["mjbTkhpl", "mjbTkhtk", "mjbAkaun", "mjbDigit", "mjbStcbk", "kawKwkod", "mjbThkod", "mjbBgkod", "mjbHtkod", "mjbStkod", "mjbJpkod", "mjbSbkod", "mjbMesej"]]);
        break;
      case "createA":
        $this->Security->config("form", ["fields" => ["mjaTkhpl", "mjaTkhtk", "mjaAkaun", "mjaDigit", "mjaStatf", "mjaStcbk", "mjaSbkod", "mjaMesej"]]);
        break;
    }
  }

  public function newaccount()
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/account/newaccount/", Config::get("VIEWS_PATH") . "account/jadual-c.php");
  }

  public function amendaccount($fileId)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/account/amendaccount/", Config::get("VIEWS_PATH") . "account/jadual-b.php", ["fileId" => $fileId]);
  }

  public function eliminated($fileId)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/account/eliminated/", Config::get("VIEWS_PATH") . "account/jadual-a.php", ["fileId" => $fileId]);
  }

  public function evaluation($fileId)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/account/evaluation/", Config::get("VIEWS_PATH") . "account/evaluation.php", ["fileId" => $fileId]);
  }

  public function calcland($siriNo)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/account/calcland/", Config::get("VIEWS_PATH") . "account/calcland.php", ["siriNo" => $siriNo]);
  }

  public function calcbuilding($siriNo)
  {
    Config::setJsConfig("curPage", "account");
    $this->view->renderWithLayouts(Config::get("VIEWS_PATH") . "layout/account/calcbuilding/", Config::get("VIEWS_PATH") . "account/calcbuilding.php", ["siriNo" => $siriNo]);
  }

  public function getSumbangan()
  {
    $jpkod = $this->request->data("jpkod");
    $result = $this->account->getSumbangan($jpkod);
    if (!$result) {
      $this->view->renderErrors($this->account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function createAcct()
  {
    $mjcTkhpl = $this->request->data("mjcTkhpl");
    $mjcTkhtk = $this->request->data("mjcTkhtk");
    $mjcTkhoc = $this->request->data("mjcTkhoc");
    $mjcAkaun = $this->request->data("mjcAkaun");
    $mjcDigit = $this->request->data("mjcDigit");
    $mjcHsiri = $this->request->data("mjcHsiri");
    $mjcStcbk = $this->request->data("mjcStcbk");
    $mjcOldac = $this->request->data("mjcOldac");
    $mjcNobil = $this->request->data("mjcNobil");
    $mjcNolot = $this->request->data("mjcNolot");
    $mjcBllot = $this->request->data("mjcBllot");
    $mjcJlkod = $this->request->data("mjcJlkod");
    $kawKwkod = $this->request->data("kawKwkod");
    $mjcAdpg1 = $this->request->data("mjcAdpg1");
    $mjcAdpg2 = $this->request->data("mjcAdpg2");
    $mjcThkod = $this->request->data("mjcThkod");
    $mjcBgkod = $this->request->data("mjcBgkod");
    $mjcHtkod = $this->request->data("mjcHtkod");
    $mjcStkod = $this->request->data("mjcStkod");
    $mjcJpkod = $this->request->data("mjcJpkod");
    $mjcCodex = $this->request->data("mjcCodex");
    $mjcCodey = $this->request->data("mjcCodey");
    $mjcDiskn = $this->request->data("mjcDiskn");
    $mjcSmpah = $this->request->data("mjcSmpah");
    $mjcNompt = $this->request->data("mjcNompt");
    $mjcRjfil = $this->request->data("mjcRjfil");
    $mjcPelan = $this->request->data("mjcPelan");
    $mjcHkmlk = $this->request->data("mjcHkmlk");
    $mjcBilpk = $this->request->data("mjcBilpk");
    $mjcRjmmk = $this->request->data("mjcRjmmk");
    $mjcLsbgn = $this->request->data("mjcLsbgn");
    $mjcLstnh = $this->request->data("mjcLstnh");
    $mjcLsans = $this->request->data("mjcLsans");
    $mjcSbkod = $this->request->data("mjcSbkod");
    $mjcMesej = $this->request->data("mjcMesej");
    $mjcNmbil = $this->request->data("mjcNmbil");
    $mjcPlgid = $this->request->data("mjcPlgid");
    $mjcAmtid = $this->request->data("mjcAmtid");

    $result = $this->Account->createAcct(
      Session::getUserId(),
      Session::getUserWorkerId(),
      $mjcTkhpl,
      $mjcTkhtk,
      $mjcTkhoc,
      $mjcAkaun,
      $mjcDigit,
      $mjcHsiri,
      $mjcStcbk,
      $mjcOldac,
      $mjcNobil,
      $mjcNolot,
      $mjcBllot,
      $mjcJlkod,
      $kawKwkod,
      $mjcAdpg1,
      $mjcAdpg2,
      $mjcThkod,
      $mjcBgkod,
      $mjcHtkod,
      $mjcStkod,
      $mjcJpkod,
      $mjcCodex,
      $mjcCodey,
      $mjcDiskn,
      $mjcSmpah,
      $mjcNompt,
      $mjcRjfil,
      $mjcPelan,
      $mjcHkmlk,
      $mjcBilpk,
      $mjcRjmmk,
      $mjcLsbgn,
      $mjcLstnh,
      $mjcLsans,
      $mjcSbkod,
      $mjcMesej,
      $mjcNmbil,
      $mjcPlgid,
      $mjcAmtid
    );

    if (!$result) {
      $this->view->renderErrors($this->Account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function createB()
  {
    $mjbTkhpl = $this->request->data("mjbTkhpl");
    $mjbTkhtk = $this->request->data("mjbTkhtk");
    $mjbAkaun = $this->request->data("mjbAkaun");
    $mjbDigit = $this->request->data("mjbDigit");
    $mjbStcbk = $this->request->data("mjbStcbk");
    $kawKwkod = $this->request->data("kawKwkod");
    $mjbThkod = $this->request->data("mjbThkod");
    $mjbBgkod = $this->request->data("mjbBgkod");
    $mjbHtkod = $this->request->data("mjbHtkod");
    $mjbStkod = $this->request->data("mjbStkod");
    $mjbJpkod = $this->request->data("mjbJpkod");
    $mjbCodex = $this->request->data("mjbCodex");
    $mjbCodey = $this->request->data("mjbCodey");
    $mjbSbkod = $this->request->data("mjbSbkod");
    $mjbMesej = $this->request->data("mjbMesej");

    $result = $this->Account->createB(Session::getUserId(), Session::getUserWorkerId(), $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbCodex, $mjbCodey, $mjbSbkod, $mjbMesej);
    if (!$result) {
      $this->view->renderErrors($this->Account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function createPS()
  {
    $mjbTkhpl = $this->request->data("mjbTkhpl");
    $mjbTkhtk = $this->request->data("mjbTkhtk");
    $mjbAkaun = $this->request->data("mjbAkaun");
    $mjbDigit = $this->request->data("mjbDigit");
    $mjbStcbk = $this->request->data("mjbStcbk");
    $kawKwkod = $this->request->data("kawKwkod");
    $mjbThkod = $this->request->data("mjbThkod");
    $mjbBgkod = $this->request->data("mjbBgkod");
    $mjbHtkod = $this->request->data("mjbHtkod");
    $mjbStkod = $this->request->data("mjbStkod");
    $mjbJpkod = $this->request->data("mjbJpkod");
    $mjbSbkod = $this->request->data("mjbSbkod");
    $mjbMesej = $this->request->data("mjbMesej");

    $result = $this->Account->createPS(Session::getUserId(), Session::getUserWorkerId(), $mjbTkhpl, $mjbTkhtk, $mjbAkaun, $mjbDigit, $mjbStcbk, $kawKwkod, $mjbThkod, $mjbBgkod, $mjbHtkod, $mjbStkod, $mjbJpkod, $mjbSbkod, $mjbMesej);
    if (!$result) {
      $this->view->renderErrors($this->Account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function createA()
  {
    $mjaTkhpl = $this->request->data("mjaTkhpl");
    $mjaTkhtk = $this->request->data("mjaTkhtk");
    $mjaAkaun = $this->request->data("mjaAkaun");
    $mjaDigit = $this->request->data("mjaDigit");
    $mjaStatf = $this->request->data("mjaStatf");
    $mjaStcbk = $this->request->data("mjaStcbk");
    $mjaSbkod = $this->request->data("mjaSbkod");
    $mjaMesej = $this->request->data("mjaMesej");

    $result = $this->Account->createA(Session::getUserId(), Session::getUserWorkerId(), $mjaTkhpl, $mjaTkhtk, $mjaAkaun, $mjaDigit, $mjaStatf, $mjaStcbk, $mjaSbkod, $mjaMesej);
    if (!$result) {
      $this->view->renderErrors($this->Account->errors());
    } else {
      $this->view->renderJson($result);
    }
  }

  public function isAuthorized()
  {
    $action = $this->request->param("action");
    $role = Session::getUserRole();
    $resource = "account";

    //only for admin
    Permission::allow("administrator", $resource, "*");

    //only for normal users
    Permission::allow("user", $resource, ["newaccount", "getSumbangan"]);

    return Permission::check($role, $resource, $action);
  }
}