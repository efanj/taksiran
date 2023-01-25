<?php

/**
 * The admin controller
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
 *
 */

class AdminController extends Controller {

    /**
     * A method that will be triggered before calling action method.
     * Any changes here will reflect then on Controller::triggerComponents() method
     *
     */
    public function beforeAction(){

        parent::beforeAction();

        $action = $this->request->param('action');
        $actions = ['getUsers', 'updateUserInfo', 'deleteUser'];

        // define the action methods that needs to be triggered only through POST & Ajax request.
        $this->Security->requireAjax($actions);
        $this->Security->requirePost($actions);

        // You need to explicitly define the form fields that you expect to be returned in POST request,
        // if form field wasn't defined, this will detected as form tampering attempt.
        switch($action){
            case "getUsers":
                $this->Security->config("validateForm", false);
                break;
            case "updateUserInfo":
                $this->Security->config("form", [ 'fields' => ['user_id', 'name', 'department', 'position']]);
                break;
            case "updateUserPassword":
                $this->Security->config("form", [ 'fields' => ['user_id', 'password', 'confirm_password']]);
                break;
            case "updateUserAccount":
                $this->Security->config("form", [ 'fields' => ['user_id', 'role', 'group', 'activate']]);
                break;
            case "updateUserPublicInfo":
                $this->Security->config("form", [ 'fields' => ['user_id', 'activate']]);
                break;
            case "updateSystemElements":
                $this->Security->config("validateForm", false);
                break;
            case "insertDepartment":
                $this->Security->config("form", [ 'fields' => ['jabatan']]);
                break;
            case "insertPosition":
                $this->Security->config("form", [ 'fields' => ['jawatan']]);
                break;
            case "insertGroup":
                $this->Security->config("form", [ 'fields' => ['kumpulan']]);
                break;
            case "deleteDepartment":
                $this->Security->config("form", [ 'fields' => ['row_id']]);
                break;
            case "deletePosition":
                $this->Security->config("form", [ 'fields' => ['row_id']]);
                break;
            case "deleteGroup":
                $this->Security->config("form", [ 'fields' => ['row_id']]);
                break;
            case "deleteUser":
                $this->Security->config("form", [ 'fields' => ['user_id']]);
                break;
            case "updateBackup":
            case "clearLog":
                $this->Security->config("validateForm", false);
                break;
            case "restoreBackup":
                $this->Security->config("validateCsrfToken", true);
                break;
        }
    }

    /**
     * show all users
     *
     */
    public function users(){

        Config::setJsConfig('curPage', "users");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/admin/", Config::get('ADMIN_VIEWS_PATH') . 'users/index.php');
    }

    public function elements(){

        Config::setJsConfig('curPage', "admin");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/admin/", Config::get('ADMIN_VIEWS_PATH') . 'users/elements.php');
    }

    public function register(){

        Config::setJsConfig('curPage', "users");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/admin/", Config::get('ADMIN_VIEWS_PATH') . 'users/register.php');
    }

    public function activity(){
        Config::setJsConfig('curPage', "users");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/admin/", Config::get('ADMIN_VIEWS_PATH') . 'users/activity.php');
    }

    public function errorlog(){
        Config::setJsConfig('curPage', "users");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/admin/", Config::get('ADMIN_VIEWS_PATH') . 'users/error.php');
    }

    /**
     * get users by name, email & role
     *
     */

    // public function getUsers(){
    //     $draw               = $this->request->data("draw");
    //     $row                = $this->request->data("start");
    //     $rowperpage         = $this->request->data("length");
    //     $column             = $this->request->data("order");
    //     $columnIndex        = $column[0]["column"];
    //     $columns            = $this->request->data("columns");
    //     $columnName         = $columns[$columnIndex]["data"];
    //     $columnSortOrder    = $column[0]["dir"];
    //     $search             = $this->request->data("search");
    //     $searchValue        = $search["value"];
    //     $result             = $this->admin->getUsers($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue);
    //     if (!$result) {
    //         $this->view->renderErrors($this->admin->errors());
    //     }else {
    //         $this->view->renderJson($result);
    //     }
    // }

    // public function getUsers(){

    //     $usersData = $this->admin->getUsers($name, $email, $role, $pageNum);

    //     if(!$usersData){
    //         $this->view->renderErrors($this->admin->errors());
    //     } else{

    //         $usersHTML       = $this->view->render(Config::get('ADMIN_VIEWS_PATH') . 'users/users.php', array("users" => $usersData["users"]));
    //         // $paginationHTML  = $this->view->render(Config::get('VIEWS_PATH') . 'pagination/default.php', array("pagination" => $usersData["pagination"]));
    //         $this->view->renderJson(array("data" => ["users" => $usersHTML]));
    //     }
    // }

    /**
     * view a user
     *
     * @param integer|string $userId
     */
    public function viewUser($userId = 0){

        $userId = Encryption::decryptId($userId);

        if(!$this->user->exists($userId)){
            return $this->error(404);
        }

        Config::setJsConfig('curPage', "users");
        Config::setJsConfig('userId', Encryption::encryptId($userId));

        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ADMIN_VIEWS_PATH') . 'users/viewUser.php', array("userId" => $userId));
    }

    /**
     * update user profile info(name, password, role)
     *
     */
    public function updateUserInfo(){

        $userId     = Encryption::decryptId($this->request->data("user_id"));
        $name       = $this->request->data("name");
        $department   = $this->request->data("department");
        $position   = $this->request->data("position");

        if(!$this->user->exists($userId)){
            return $this->error(404);
        }

        $result = $this->admin->updateUserInfo($userId, Session::getUserId(), $name, $department, $position);

        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderSuccess("Profile has been updated.");
        }
    }

    public function updateUserPassword(){

        $userId             = Encryption::decryptId($this->request->data("user_id"));
        $password           = $this->request->data("password");
        $confirm_password   = $this->request->data("confirm_password");

        if(!$this->user->exists($userId)){
            return $this->error(404);
        }

        $result = $this->admin->updateUserPassword($userId, Session::getUserId(), $password, $confirm_password);

        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderSuccess("User password has been updated.");
        }
    }

    public function updateUserAccount(){

        $userId     = Encryption::decryptId($this->request->data("user_id"));
        $role       = $this->request->data("role");
        $group   = $this->request->data("group");
        $activate   = $this->request->data("activate");

        if(!$this->user->exists($userId)){
            return $this->error(404);
        }

        $result = $this->admin->updateUserAccount($userId, Session::getUserId(), $role, $group, $activate);

        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderSuccess("User account has been updated.");
        }
    }

    public function updateUserPublicInfo(){

        $userId     = Encryption::decryptId($this->request->data("user_id"));
        $activate       = $this->request->data("activate");

        if(!$this->user->exists($userId)){
            return $this->error(404);
        }

        $result = $this->admin->activePublicUser($userId, Session::getUserId(), $activate);
        // $result = $this->admin->activePublicUser($userId, $activate);

        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderSuccess("Profile has been updated.");
        }
    }


    public function insertDepartment(){

        $jabatan       = $this->request->data("jabatan");

        $result = $this->admin->insertDepartment(Session::getUserId(), $jabatan);
        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderJson($result);
        }
    }

    public function insertPosition(){

        $jawatan       = $this->request->data("jawatan");

        $result = $this->admin->insertPosition(Session::getUserId(), $jawatan);
        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderJson($result);
        }
    }

    public function insertGroup(){

        $kumpulan       = $this->request->data("kumpulan");

        $result = $this->admin->insertGroup(Session::getUserId(), $kumpulan);
        if(!$result){
            $this->view->renderErrors($this->admin->errors());
        }else{
            $this->view->renderJson($result);
        }
    }

    public function deleteDepartment(){

        $rowId = Encryption::decryptId($this->request->data("row_id"));
        $this->admin->deleteDepartment(Session::getUserId(), $rowId);

        $this->view->renderJson(array("success" => true));
    }

    public function deletePosition(){

        $rowId = Encryption::decryptId($this->request->data("row_id"));
        $this->admin->deletePosition(Session::getUserId(), $rowId);

        $this->view->renderJson(array("success" => true));
    }

    public function deleteGroup(){

        $rowId = Encryption::decryptId($this->request->data("row_id"));
        $this->admin->deleteGroup(Session::getUserId(), $rowId);

        $this->view->renderJson(array("success" => true));
    }

    /**
     * delete a user
     *
     */
    public function deleteUser(){

        $userId = Encryption::decryptIdWithDash($this->request->data("user_id"));

        if(!$this->user->exists($userId)){
            return $this->error(404);
        }

        $this->admin->deleteUser(Session::getUserId(), $userId);
        $this->view->renderJson(array("success" => true));
    }

    /**
     * clear log
     *
     */
    public function clearLog(){
        $fp = fopen(APP."logs/log.txt", "r+");
        // clear content to 0 bits
        ftruncate($fp, 0);
        //close file
        fclose($fp);

        $this->view->renderJson(array("success" => true));
    }


    /**
     * view backups if exist
     *
     */
    public function backups(){

        Config::setJsConfig('curPage', "backups");
        $this->view->renderWithLayouts(Config::get('VIEWS_PATH') . "layout/default/", Config::get('ADMIN_VIEWS_PATH') . 'backups.php');
    }

    /**
     * update backup
     *
     */
    public function updateBackup(){

        $this->admin->updateBackup();

        Session::set('backup-success', "Backup has been updated");
        return $this->redirector->root("Admin/Backups");
    }

    /**
     * restore backup
     *
     */
    public function restoreBackup(){

        $result = $this->admin->restoreBackup();

        if(!$result){
            Session::set('backup-errors', $this->admin->errors());
            return $this->redirector->root("Admin/Backups");
        }else{
            Session::set('backup-success', "Backup has been restored successfully");
            return $this->redirector->root("Admin/Backups");
        }
    }

    /**
      * Is user authorized for admin controller & requested action method?
      *
      * @return bool
     */
    public function isAuthorized(){

        $role = Session::getUserRole();
        if(isset($role) && $role === "administrator"){
            return true;
        }
        return false;
    }

 }