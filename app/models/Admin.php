<?php

 /**
  * Admin Class
  * Admin Class inherits from User.
  *
  * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
  * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
  */

class Admin extends User{

    /**
     * get all users in the database
     *
     * @access public
     * @param  string  $name
     * @param  string  $email
     * @param  string  $role
     * @param  integer $pageNum
     * @return array
     *
     */

    public function getUsers(){


        $database   = Database::openConnection();
        $query   = "SELECT * FROM public.users ";

        $database->prepare($query);
        $database->execute();
        $users = $database->fetchAllAssociative();

        // return array("users" => $users, "pagination" => $pagination);
        return array("users" => $users);
    }

    public function getLogActivity(){

        $database   = Database::openConnection();
        $query   = "SELECT b.name, a.activity, a.date ";
        $query   .= "FROM public.activity a ";
        $query   .= "LEFT JOIN public.users b ON a.userid = b.id ";
        $query   .= "ORDER BY a.date DESC ";

        $database->prepare($query);
        $database->execute();
        $output = $database->fetchAllAssociative();
        return $output;

    }

    // public function getUsers($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
    // {

    //     $database = Database::openConnection();

    //     $searchQuery = '';
    //     if ($searchValue != '') {  
    //         $searchQuery = " name LIKE '%" . $searchValue . "%' OR role LIKE '%" . $searchValue . "%' OR email LIKE '%" . $searchValue . "%' OR nric LIKE '%" . $searchValue . "%' OR
    //         worker_id LIKE '%" . $searchValue . "%' OR workplace_name LIKE '%" . $searchValue . "%' OR contact_no LIKE '%" . $searchValue . "%'";
    //     }

    //     ## Total number of records without filtering
    //     $sql = "SELECT count(*) AS allcount FROM public.view_users";
    //     $sel = $database->prepare($sql);
    //     $database->execute($sel);
    //     $records = $database->fetchAssociative();
    //     $totalRecords = $records['allcount'];

    //     ## Total number of record with filtering
    //     $sql = "SELECT count(*) AS allcount FROM public.view_users";
    //     if ($searchValue != '') {
    //         $sql .= " WHERE " . $searchQuery;
    //     }
    //     $sel = $database->prepare($sql);
    //     $database->execute($sel);

    //     $records = $database->fetchAssociative();
    //     $totalRecordwithFilter = $records['allcount'];

    //     ## Fetch records
    //     $query = "SELECT * FROM public.view_users";
    //     if ($searchValue != '') {
    //         $query .= " WHERE " . $searchQuery;
    //     }
    //     if ($columnName != '') {
    //         $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    //     }
    //     $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    //     $database->prepare($query);
    //     $database->execute();

    //     $row = $database->fetchAllAssociative();
    //     $output = array();
    //     $rowOutput = array();
    //     foreach ($row as $val) {
    //         $rowOutput['id'] = $val['id'];
    //         $rowOutput['session_id'] = $val['session_id'];
    //         $rowOutput['cookie_token'] = $val['cookie_token'];
    //         $rowOutput['name'] = $val['name'];
    //         $rowOutput['role'] = $val['role'];
    //         $rowOutput['hashed_password'] = $val['hashed_password'];
    //         $rowOutput['email'] = $val['email'];
    //         $rowOutput['is_email_activated'] = $val['is_email_activated'];
    //         $rowOutput['email_token'] = $val['email_token'];
    //         $rowOutput['email_last_verification'] = $val['email_last_verification'];
    //         $rowOutput['pending_email'] = $val['pending_email'];
    //         $rowOutput['pending_email_token'] = $val['pending_email_token'];
    //         $rowOutput['profile_picture'] = $val['profile_picture'];
    //         $rowOutput['nric'] = $val['nric'];
    //         $rowOutput['worker_id'] = $val['worker_id'];
    //         $rowOutput['workplace_name'] = $val['workplace_name'];
    //         $rowOutput['contact_no'] = $val['contact_no'];
    //         $rowOutput['role'] = Session::getUserRole();
    //         array_push($output, $rowOutput);
    //     }

    //     ## Response
    //     $response = array(
    //         "draw" => intval($draw),
    //         "iTotalRecords" => $totalRecords,
    //         "iTotalDisplayRecords" => $totalRecordwithFilter,
    //         "aaData" => $output
    //     );

    //     return $response;
    // }

    /**
     *  Update info of a passed user id
     *
     * @access public
     * @param  integer $userId
     * @param  integer $adminId
     * @param  string  $name
     * @param  string  $password
     * @param  string  $role
     * @return bool
     * @throws Exception If password couldn't be updated
     *
     */

    public function updateUserInfo($userId, $adminId, $name, $department, $position){

        $user = $this->getProfileInfo($userId);

        $name = (!empty($name) && $name !== $user["name"])? $name: null;
        $department = (!empty($department) && $department !== $user["department"])? $department: null;
        $position = (!empty($position) && $position !== $user["position"])? $position: null;

        if($name || $department || $position) {

            $database = Database::openConnection();

            $options = [
                $name           => "name = :name ",
                $department      => "department = :department ", 
                $position      => "position = :position "
            ];

            $query   = "UPDATE public.users SET ";
            $query  .= $this->applyOptions($options, ", ");
            $query  .= "WHERE id = :id ";
            $database->prepare($query);

            if($name){
                $database->bindValue(':name', $name);
            }
            if($department){
                $database->bindValue(':department', $department);
            }
            if($position){
                $database->bindValue(':position', $position);
            }

            $database->bindValue(':id', $userId);
            $result = $database->execute();

            if(!$result){
                throw new Exception("Couldn't update user profile");
            }

            if($result){
                $activity = "Update user info :".$name;
                $database->logActivity($adminId, $activity);
            }
        }

        return true;
    }

    public function updateUserPassword($userId, $adminId, $password, $confirm_password){

        $user = $this->getProfileInfo($userId);

        $validation = new Validation();
        if(!$validation->validate([
            'Password' => [$password, "required|equals(".$confirm_password.")|minLen(6)|password"],
            'Password Confirmation' => [$confirm_password, 'required']])){
            $this->errors = $validation->errors();
            return false;
        }

        if($password) {

            $database = Database::openConnection();
            $query   = "UPDATE users SET hashed_password = :hashed_password ";
            $query  .= "WHERE id = :id ";
            $database->prepare($query);
            $database->bindValue(':hashed_password', password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('HASH_COST_FACTOR'))));
            $database->bindValue(':id', $userId);
            $result = $database->execute();

            if(!$result){
                throw new Exception("Couldn't update user password");
            }

            if($result){
                $activity = "Update user password :".$user['name'];
                $database->logActivity($adminId, $activity);
            }
        }

        return true;
    }

    public function updateUserAccount($userId, $adminId, $role, $group, $activate){

        $user = $this->getProfileInfo($userId);

        $role = (!empty($role) && $role !== $user["role"])? $role: null;
        $group = (!empty($group) && $group !== $user["group"])? $group: null;
        $activate = ($activate !== $user["is_email_activated"])? $activate: 0;

        if(!empty($role) && $adminId === $user["id"]){
            $this->errors[] = "You can't change your role";
            return false;
        }

        if($role || $group || $activate == "0" || $activate == "1") {

            $options = [
                $role          => 'role = :role ',
                $group          => '"group" = :group ',
                $activate      => 'is_email_activated = :activate '
            ];

            $database = Database::openConnection();
            $query   = "UPDATE users SET ";
            $query  .= $this->applyOptions($options, ", ");
            $query  .= "WHERE id = :id ";
            $database->prepare($query);

            if($role){
                $database->bindValue(':role', $role);
            }
            if($group){
                $database->bindValue(':group', $group);
            }
            if($activate == "0" || $activate == "1"){
                $database->bindValue(':activate', $activate);
            }

            $database->bindValue(':id', $userId);
            $result = $database->execute();

            if(!$result){
                throw new Exception("Couldn't activate user account");
            }

            if($result){
                $activity = "Update user account :".$user['name'];
                $database->logActivity($adminId, $activity);
            }
        }

        return true;
    }

    /**
     * Delete a user.
     *
     * @param  string  $adminId
     * @param  integer $userId
     * @throws Exception
     */
    public function deleteUser($adminId, $userId){

        // current admin can't delete himself
        $validation = new Validation();
        if(!$validation->validate([ 'User ID' => [$userId, "notEqual(".$adminId.")"]])) {
            $this->errors  = $validation->errors();
            return false;
        }

        $database = Database::openConnection();
        $database->deleteById("users", $userId);

        if ($database->countRows() !== 1) {
            throw new Exception ("Couldn't delete user");
        }

        if($database->countRows() == 1){
            $database->deleteByUserId("users_profile", $userId);

            $activity = "Padam akaun pengguna - ID pengguna : ". $userId;
            $database->logActivity($adminId, $activity);
        }
    }

     /**
      * Counting the number of users in the database.
      *
      * @access public
      * @static static  method
      * @return integer number of users
      *
      */
     public function countUsers(){
         return $this->countAll("users");
     }

     /**
      * Get the backup file from the backup directory in file system
      *
      * @access public
      * @return array
      */
     public function getBackups() {

         $files = scandir(APP . "backups/");
         $basename = $filename = $unixTimestamp = null;

         foreach ($files as $file) {
             if ($file != "." && $file != "..") {

                 $filename_array = explode('-', pathinfo($file, PATHINFO_FILENAME));
                 if(count($filename_array) !== 2){
                     continue;
                 }

                 // backup file has name with something like this: backup-1435788336
                 list($filename, $unixTimestamp) = $filename_array;
                 $basename = $file;
                 break;
             }
         }

         $data = array("basename" => $basename, "filename" => $filename, "date" => "On " . date("F j, Y", $unixTimestamp));
         return $data;
     }

    /**
     * Update the backup file from the backup directory in file system
     * The user of the database MUST be assigned privilege of ADMINISTRATION -> LOCK TABLES.
     *
     * @access public
     * @return bool
     */
    public function updateBackup(){

         $dir = APP . "backups/";
         $files = scandir($dir);

         // delete and clean all current files in backup directory
         foreach ($files as $file) {
             if ($file != "." && $file != "..") {
                 if (is_file("$dir/$file")) {
                     Uploader::deleteFile("$dir/$file");
                 }
             }
         }

         // you can use another username and password only for this function, while the main user has limited privileges
         $windows = true;
         if($windows){
             exec('C:\wamp\bin\mysql\mysql5.6.17\bin\mysqldump --user=' . escapeshellcmd(Config::get('DB_USER')) . ' --password=' . escapeshellcmd(Config::get('DB_PASS')) . ' ' . escapeshellcmd(Config::get('DB_NAME')) . ' > '. APP.'backups\backup-' . time() . '.sql');
         }else{
             exec('mysqldump --user=' . escapeshellcmd(Config::get('DB_USER')) . ' --password=' .escapeshellcmd(Config::get('DB_PASS')). ' '. escapeshellcmd(Config::get('DB_NAME')) .' > '. APP . 'backups/backup-' . time() . '.sql');
         }

         return true;
     }

    /**
     * Restore the backup file
     * The user of the database MUST assigned all privileges of SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, INDEX, DROP, LOCK TABLES, & TRIGGER.
     *
     * @access public
     * @return bool
     *
     */
    public function restoreBackup(){

         $basename = $this->getBackups()["basename"];

         $validation = new Validation();
         $validation->addRuleMessage("required", "Please update backups first!");

         if(!$validation->validate(["Backup" => [$basename, "required"]])) {
             $this->errors = $validation->errors();
             return false;
         }

         $windows = true;
         if($windows){
             exec('C:\wamp\bin\mysql\mysql5.6.17\bin\mysql --user=' . escapeshellcmd(Config::get('DB_USER')) . ' --password=' . escapeshellcmd(Config::get('DB_PASS')) . ' ' . escapeshellcmd(Config::get('DB_NAME')) . ' < '.APP.'\backups\\' . $basename);
         }else{
             exec('mysql --user='.escapeshellcmd(Config::get('DB_USER')).' --password='.escapeshellcmd(Config::get('DB_PASS')).' '.escapeshellcmd(Config::get('DB_NAME')).' < '. APP . 'backups/' . $basename);
         }

         return true;
     }

    /**
     * get users data.
     * Use this method to download users info in database as csv file.
     *
     * @access public
     * @return array
     */
    public function getUsersData(){

        $database = Database::openConnection();

        $database->prepare("SELECT name, role, email, is_email_activated FROM users");
        $database->execute();

        $users = $database->fetchAllAssociative();
        $cols  = array("User Name", "Role", "Email", "is Email Activated?");

        return ["rows" => $users, "cols" => $cols, "filename" => "users"];
    }

    public function getJabatan(){
        $database = Database::openConnection();

        $database->prepare("SELECT id,department_name FROM data.department");
        $database->execute();

        $data = $database->fetchAllAssociative();

        return $data;
    }

    public function getJawatan(){
        $database = Database::openConnection();

        $database->prepare("SELECT id,position_name FROM data.position");
        $database->execute();

        $data = $database->fetchAllAssociative();

        return $data;
    }

    public function getKumpulan(){
        $database = Database::openConnection();

        $database->prepare("SELECT id,group_name FROM data.group");
        $database->execute();

        $data = $database->fetchAllAssociative();

        return $data;
    }

    public function insertDepartment($userId, $jabatan){
        $database = Database::openConnection();

        $database->prepare("INSERT INTO data.department(department_name) VALUES('".$jabatan."')");
        $result = $database->execute();

        if ($result) {
            $activity = "Daftar Jabatan :" . $jabatan;
            $database->logActivity($userId, $activity);

            return true;
        } else {
            return false;
        }
    }

    public function insertPosition($userId, $jawatan){
        $database = Database::openConnection();

        $database->prepare("INSERT INTO data.position(position_name) VALUES('".$jawatan."')");
        $result = $database->execute();

       if ($result) {
            $activity = "Daftar Jawatan :" . $jawatan;
            $database->logActivity($userId, $activity);

            return true;
        } else {
            return false;
        }
    }

    public function insertGroup($userId, $kumpulan){
        $database = Database::openConnection();

        $database->prepare("INSERT INTO data.group(group_name) VALUES('".$kumpulan."')");
        $result = $database->execute();

        if ($result) {
            $activity = "Daftar Kumpulan :" . $kumpulan;
            $database->logActivity($userId, $activity);

            return true;
        } else {
            return false;
        }
    }

    public function deleteDepartment($userId, $rowId){

        $database = Database::openConnection();
        $database->deleteById("data.department", $rowId);

        if ($database->countRows() !== 1) {
            throw new Exception ("Couldn't delete department");
        }

        if($database->countRows() == 1){
            $activity = "Padam Jabatan : ". $rowId;
            $database->logActivity($userId, $activity);
        }
    }

    public function deletePosition($userId, $rowId){

        $database = Database::openConnection();
        $database->deleteById("data.position", $rowId);

        if ($database->countRows() !== 1) {
            throw new Exception ("Couldn't delete position");
        }

        if($database->countRows() == 1){
            $activity = "Padam Jawatan : ". $rowId;
            $database->logActivity($userId, $activity);
        }
    }

    public function deleteGroup($userId, $rowId){

        $database = Database::openConnection();
        $database->deleteById("data.group", $rowId);

        if ($database->countRows() !== 1) {
            throw new Exception ("Couldn't delete group");
        }

        if($database->countRows() == 1){
            $activity = "Padam Kumpulan : ". $rowId;
            $database->logActivity($userId, $activity);
        }
    }

 }
   