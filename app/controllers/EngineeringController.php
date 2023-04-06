<?php

class EngineeringController extends Controller
{

    public function beforeAction()
    {

        parent::beforeAction();

        $action = $this->request->param('action');
        $actions = ['getSiasatanTapak', 'generatePermit', 'getPermit', 'getNotice', 'getRenovationNotice', 'getNoticeYearly', 'getTableNoticeYearly', 'generatePermitTahunan', 'generatePermitPengubahan'];
        $this->Security->requireAjax($actions);
        $this->Security->requirePost($actions);

        switch ($action) {
            case "getSiasatanTapak":
                $this->Security->config("validateForm", false);
                break;
            case "generatePermit":
                $this->Security->config("validateForm", false);
                break;
            case "getPermit":
                $this->Security->config("validateForm", false);
                break;
            case "getNotice":
                $this->Security->config("validateForm", false);
                break;
            case "getRenovationNotice":
                $this->Security->config("validateForm", false);
                break;
            case "getNoticeYearly":
                $this->Security->config("validateForm", false);
                break;
            case "getTableNoticeYearly":
                $this->Security->config("validateForm", false);
                break;
            case "generatePermitTahunan":
                $this->Security->config("validateForm", false);
                break;
            case "generatePermitPengubahan":
                $this->Security->config("validateForm", false);
                break;
        }
    }

    public function permit()
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/table/", Config::get('VIEWS_PATH') . 'engineering/permit.php');
    }

    public function createPermit($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/view/", Config::get('VIEWS_PATH') . 'engineering/generate_permit.php', ["fileId" => $fileId]);
    }

    public function permitView($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/view/", Config::get('VIEWS_PATH') . 'engineering/permit_view.php', ["fileId" => $fileId]);
    }

    public function createnotice($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/notice/", Config::get('VIEWS_PATH') . 'engineering/create_notice.php', ["fileId" => $fileId]);
    }

    public function createyearlynotice($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/noticeyr/", Config::get('VIEWS_PATH') . 'engineering/create_yearly_notis.php', ["fileId" => $fileId]);
    }

    public function notis()
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/table/", Config::get('VIEWS_PATH') . 'engineering/notisdenda.php');
    }

    public function notisView($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/notice/", Config::get('VIEWS_PATH') . 'engineering/notis_view.php', ["fileId" => $fileId]);
    }

    public function printNotis($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/notice/", Config::get('VIEWS_PATH') . 'engineering/notis_print.php', ["fileId" => $fileId]);
    }

    public function notisthnView($fileId)
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/noticeyr/", Config::get('VIEWS_PATH') . 'engineering/notisthn_view.php', ["fileId" => $fileId]);
    }

    public function semaktapak()
    {
        Config::setJsConfig('curPage', "engineering");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/engineering/siasat/", Config::get('VIEWS_PATH') . 'engineering/Semakan.php');
    }

    public function getSiasatanTapak()
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
        $searchValue = $search["value"];
        $result = $this->Engineering->getSiasatanTapak($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
        if (!$result) {
            $this->view->renderErrors($this->Engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getPermit()
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
        $searchValue = $search["value"];
        $result = $this->Engineering->getPermit($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
        if (!$result) {
            $this->view->renderErrors($this->Engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getNotice()
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
        $searchValue = $search["value"];
        $result = $this->Engineering->getNotice($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
        if (!$result) {
            $this->view->renderErrors($this->Engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getTableNoticeYearly()
    {
        $fileId = Encryption::decryptId($this->request->data("id"));
        $draw = $this->request->data("draw");
        $row = $this->request->data("start");
        $rowperpage = $this->request->data("length");
        $column = $this->request->data("order");
        $columnIndex = $column[0]["column"];
        $columns = $this->request->data("columns");
        $columnName = $columns[$columnIndex]["data"];
        $columnSortOrder = $column[0]["dir"];
        $search = $this->request->data("search");
        $searchValue = $search["value"];
        $result = $this->Engineering->getTableNoticeYearly($fileId, $draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
        if (!$result) {
            $this->view->renderErrors($this->Engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function semakAkaun()
    {

        $accountNo = $this->request->data("account_no");
        $year = $this->request->data("year");

        $result = $this->engineering->semakAkaun(Session::getUserId(), $accountNo, $year);

        if (!$result) {
            $this->view->renderErrors($this->engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getRenovationNotice()
    {

        $id = $this->request->data("id");

        $result = $this->engineering->getRenovationNotice(Session::getUserId(), $id);

        if (!$result) {
            $this->view->renderErrors($this->engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getNoticeYearly()
    {

        $id = $this->request->data("id");

        $result = $this->engineering->getNoticeYearly(Session::getUserId(), $id);

        if (!$result) {
            $this->view->renderErrors($this->engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function generatePermit()
    {

        $smkId = $this->request->data("smk_id");
        $nsiri = $this->request->data("nsiri");
        $no_akaun = $this->request->data("no_akaun");
        $no_lot = $this->request->data("no_lot");
        $permit = $this->request->data("permit");
        $luastanah = $this->request->data("luastanah");
        $luasbgnasal = $this->request->data("luasbgnasal");
        $luasbgntamb = $this->request->data("luasbgntamb");
        $luas_dibenarkan = $this->request->data("luas_dibenarkan");
        $denda_tahunan = $this->request->data("denda_tahunan");
        $luas_stbck = $this->request->data("luas_stbck");
        $jumlah_denda = $this->request->data("jumlah_denda");
        $jumlah_tahunan = $this->request->data("jumlah_tahunan");

        $result = $this->engineering->generatePermit(Session::getUserId(), Session::getUserWorkerId(), $smkId, $nsiri, $no_akaun, $no_lot, $permit, $luastanah, $luasbgnasal, $luasbgntamb, $luas_dibenarkan, $luas_stbck, $jumlah_denda, $denda_tahunan, $jumlah_tahunan);

        if (!$result) {
            $this->view->renderErrors($this->engineering->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function generatePermitPengubahan()
    {

        $file_id = Encryption::decryptId($this->request->data("file_id"));
        $ruj_pejabat = $this->request->data("ruj_pejabat");
        $tarikh_notis = $this->request->data("tarikh_notis");

        $data = $this->engineering->generatePermitPengubahan(Session::getUserId(), Session::getUserWorkerId(), $file_id, $ruj_pejabat, $tarikh_notis);

        if (!$data) {
            $this->view->renderErrors($this->engineering->errors());
        } else {
            $this->view->renderJson($data);
        }
    }

    public function generatePermitTahunan()
    {

        $file_id = Encryption::decryptId($this->request->data("file_id"));
        $ruj_pemilik = $this->request->data("ruj_pemilik");
        $ruj_pejabat = $this->request->data("ruj_pejabat");
        $tarikh_notis = $this->request->data("tarikh_notis");
        $tarikh_bermula = $this->request->data("tarikh_bermula");
        $tarikh_sebelum = $this->request->data("tarikh_sebelum");
        $perkara = $this->request->data("perkara");

        $data = $this->engineering->generatePermitTahunan(Session::getUserId(), Session::getUserWorkerId(), $file_id, $ruj_pemilik, $ruj_pejabat, $tarikh_notis, $tarikh_bermula, $tarikh_sebelum, $perkara);

        if (!$data) {
            $this->view->renderErrors($this->engineering->errors());
        } else {
            $this->view->renderJson($data);
        }
    }

    public function isAuthorized()
    {

        $action = $this->request->param('action');
        $role = Session::getUserRole();
        $resource = "cukai";

        // only for admins
        Permission::allow('administrator', $resource, ['*']);

        // only for jurutera
        Permission::allow('jurutera', $resource, ['*']);

        // only for normal users
        Permission::allow('user', $resource, ['index', 'create']);
        Permission::allow('user', $resource, ['delete'], 'owner');

        $config = [];

        return Permission::check($role, $resource, $action, $config);
    }
}
