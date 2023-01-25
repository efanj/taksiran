<?php

/**
 * User controller
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
 */

class UserController extends Controller
{

    public function beforeAction()
    {

        parent::beforeAction();

        $action = $this->request->param('action');
        $actions = ['updateProfileInfo', 'updateProfilePicture', 'getVisitMarkerGeojson', 'reportBug'];
        $this->Security->requirePost($actions);

        switch ($action) {
            case "updateProfileInfo":
                $this->Security->config("form", ['fields' => ['name', 'password', 'email', 'confirm_email']]);
                break;
            case "updateProfilePicture":
                $this->Security->config("form", ['fields' => ['file']]);
                break;
            case "searchPolygon":
                $this->Security->config("validateForm", false);
                break;
        }
    }

    /**
     * show dashboard page
     *
     */
    public function index()
    {

        Config::setJsConfig('curPage', "dashboard");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/dashboard/", Config::get('VIEWS_PATH') . 'dashboard/index.php');
    }

    public function profile()
    {

        Config::setJsConfig('curPage', "profile");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'user/profile.php');
    }

    public function updateProfileInfo()
    {

        $name = $this->request->data("name");
        $password = $this->request->data("password");
        $email = $this->request->data("email");
        $confirmEmail = $this->request->data("confirm_email");

        $result = $this->user->updateProfileInfo(Session::getUserId(), $name, $password, $email, $confirmEmail);

        if (!$result) {

            Session::set('profile-info-errors', $this->user->errors());
        } else {

            $message = "Your Profile has been updated. ";
            $message .= $result["emailUpdated"] ? "Please check your new email to confirm the changes, or your current email to revoke the changes" : "";

            Session::set('profile-info-success', $message);
        }

        return $this->redirector->root("User/Profile");
    }

    public function updateProfilePicture()
    {

        $fileData = $this->request->data("file");
        $image = $this->user->updateProfilePicture(Session::getUserId(), $fileData);

        if (!$image) {
            Session::set('profile-picture-errors', $this->user->errors());
        }

        return $this->redirector->root("User/Profile");
    }

    /**
     * revoke email updates
     *
     * You must be logged in with your current email
     */
    public function revokeEmail()
    {

        $userId = $this->request->query("id");
        $userId = empty($userId) ? null : Encryption::decryptId($this->request->query("id"));
        $token = $this->request->query("token");

        $result = $this->user->revokeEmail($userId, $token);

        if (!$result) {
            return $this->error(404);
        } else {
            $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'user/profile.php', ["emailUpdates" => ["success" => "Your email updates has been revoked successfully."]]);
        }
    }

    /**
     * confirm on email updates
     *
     * You must be logged in with your current email
     */
    public function updateEmail()
    {

        $userId = $this->request->query("id");
        $userId = empty($userId) ? null : Encryption::decryptId($this->request->query("id"));
        $token = $this->request->query("token");

        $result = $this->user->updateEmail($userId, $token);
        $errors = $this->user->errors();

        if (!$result && empty($errors)) {
            return $this->error(404);
        } else if (!$result && !empty($errors)) {
            $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'user/profile.php', ["emailUpdates" => ["errors" => $this->user->errors()]]);
        } else {
            $this->view->renderWithLayouts(
                Config::get('VIEWS_PATH') . "layout/default/",
                Config::get('VIEWS_PATH') . 'user/profile.php',
                ["emailUpdates" => ["success" => "Your email updates has been updated successfully."]]
            );
        }
    }

    /**
     * users can report bugs, features, or enhancement
     * - Bug is an error you encountered
     * - Feature is a new functionality you suggest to add
     * - Enhancement is an existing feature, but you want to improve
     *
     */
    public function bugs()
    {
        Config::setJsConfig('curPage', "bugs");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('VIEWS_PATH') . 'bugs/index.php');
    }

    public function searchPolygon()
    {

        $nolot = $this->request->data("nolot");
        $coord = $this->request->data("coord");

        $result = $this->user->search_polygon($nolot, $coord);
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function searchFeature()
    {

        $noakaun = $this->request->data("noakaun");

        $result = $this->user->searchFeature($noakaun);
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function searchSiasat()
    {

        $noakaun = $this->request->data("noakaun");

        $result = $this->user->searchSiasat($noakaun);
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getVisitMarkerGeojson()
    {

        $result = $this->user->getVisitMarkerGeojson();
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getPenilaianMarkerGeojson()
    {

        $result = $this->user->getPenilaianMarkerGeojson();
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function getPermitMarkerGeojson()
    {

        $result = $this->user->getPermitMarkerGeojson();
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function Statistik()
    {

        $result = $this->user->Statistik();
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function StatistikPenilaian()
    {

        $result = $this->user->StatistikPenilaian();
        if (!$result) {
            $this->view->renderErrors($this->user->errors());
        } else {
            $this->view->renderJson($result);
        }
    }

    public function isAuthorized()
    {
        return true;
    }
}