<?php

/**
 * User Class
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
 */

class User extends Model
{

    /**
     * Table name for this & extending classes.
     *
     * @var string
     */
    public $table = "users";

    /**
     * returns an associative array holds the user info(image, name, id, ...etc.)
     *
     * @access public
     * @param  integer $userId
     * @return array Associative array of current user info/data.
     * @throws Exception if $userId is invalid.
     */
    public function getProfileInfo($userId)
    {

        $database = Database::openConnection();
        $query = "SELECT users.id, users.workerid, users.name, users.role, users.group, users.department, users.email, users.position, users.is_email_activated, users.profile_picture FROM users ";
        $query .= "WHERE users.id = :id ";
        $database->prepare($query);
        $database->bindValue(':id', $userId);
        $database->execute();

        $user = $database->fetchAssociative();

        $user["id"] = (int) $user["id"];
        $user["image"] = PUBLIC_ROOT . "img/profile_pictures/" . $user['profile_picture'];
        $user["name"] = empty($user['name']) ? null : $user['name'];
        $user["workerid"] = empty($user['workerid']) ? null : $user['workerid'];
        $user["role"] = empty($user['role']) ? null : $user['role'];
        $user["group"] = empty($user['group']) ? null : $user['group'];
        $user["department"] = empty($user['department']) ? null : $user['department'];
        $user["position"] = empty($user['position']) ? null : $user['position'];
        $user["is_email_activated"] = empty($user['is_email_activated']) ? 0 : $user['is_email_activated'];

        return $user;
    }

    /**
     * Update the current profile
     *
     * @access public
     * @param  integer $userId
     * @param  string  $name
     * @param  string  $password
     * @param  string  $email
     * @param  string  $confirmEmail
     * @return bool|array
     * @throws Exception If profile couldn't be updated
     *
     */
    public function updateProfileInfo($userId, $name, $password, $email, $confirmEmail)
    {

        $database = Database::openConnection();
        $curUser = $this->getProfileInfo($userId);

        $name = (!empty($name) && $name !== $curUser["name"]) ? $name : null;
        $email = (!empty($confirmEmail) || (!empty($email) && $email !== $curUser["email"])) ? $email : null;

        // if new email === old email, this shouldn't return any errors for email,
        // because they are not 'required', same for name.
        $validation = new Validation();
        if (!$validation->validate([
            "Name" => [$name, "alphaNumWithSpaces|minLen(4)|maxLen(30)"],
            "Password" => [$password, "minLen(6)|password"],
        ])) {
            $this->errors = $validation->errors();
            return false;
        }

        $profileUpdated = ($password || $name) ? true : false;
        if ($profileUpdated) {

            $options = [
                $name => "name = :name ",
                $password => "hashed_password = :hashed_password ",
                $email => "email = :email ",
            ];

            $database->beginTransaction();
            $query = "UPDATE users SET ";
            $query .= $this->applyOptions($options, ", ");
            $query .= "WHERE id = :id ";
            $database->prepare($query);

            if ($name) {
                $database->bindValue(':name', $name);
            }
            if ($password) {
                $database->bindValue(':hashed_password', password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('HASH_COST_FACTOR'))));
            }
            if ($email) {
                $database->bindValue(':email', $email);
            }

            $database->bindValue(':id', $userId);
            $result = $database->execute();

            if (!$result) {
                $database->rollBack();
                throw new Exception("Couldn't update profile");
            }

            // If email was updated, then send two emails,
            // one for the current one asking user optionally to revoke,
            // and another one for the new email asking user to confirm changes.
            // if($email){
            //     $name = ($name)? $name: $curUser["name"];
            //     Email::sendEmail(Config::get('EMAIL_REVOKE_EMAIL'), $curUser["email"], ["name" => $name, "id" => $curUser["id"]], ["email_token" => $emailToken]);
            //     Email::sendEmail(Config::get('EMAIL_UPDATE_EMAIL'), $email, ["name" => $name, "id" => $curUser["id"]], ["pending_email_token" => $pendingEmailToken]);
            // }

            $database->commit();
        }

        return ["emailUpdated" => (($email) ? true : false)];
    }

    public function updatePassword($userId, $password, $confirm_password)
    {

        $database = Database::openConnection();
        $curUser = $this->getProfileInfo($userId);

        $validation = new Validation();
        if (!$validation->validate([
            "Password" => [$password, "minLen(6)|password|equals(" . $confirm_password . ")"],
        ])) {
            $this->errors = $validation->errors();
            return false;
        }

        $passwordUpdated = ($password) ? true : false;
        if ($passwordUpdated) {

            $options = [
                $password => "hashed_password = :hashed_password ",
            ];

            $database->beginTransaction();
            $query = "UPDATE users SET ";
            $query .= $this->applyOptions($options, ", ");
            $query .= "WHERE id = :id ";
            $database->prepare($query);

            if ($password) {
                $database->bindValue(':hashed_password', password_hash($password, PASSWORD_DEFAULT, array('cost' => Config::get('HASH_COST_FACTOR'))));
            }

            $database->bindValue(':id', $userId);
            $result = $database->execute();

            if (!$result) {
                $database->rollBack();
                throw new Exception("Couldn't update password");
            }

            $database->commit();

            // $this->activity($userId, "Update password");
        }

        return true;
    }

    /**
     * Update Profile Picture.
     *
     * @access public
     * @param  integer $userId
     * @param  array   $fileData
     * @return mixed
     * @throws Exception If failed to update profile picture.
     */
    public function updateProfilePicture($userId, $fileData)
    {

        $image = Uploader::uploadPicture($fileData, $userId);

        if (!$image) {
            $this->errors = Uploader::errors();
            return false;
        }

        $database = Database::openConnection();
        $query = "UPDATE users SET profile_picture = :profile_picture WHERE id = :id";

        $database->prepare($query);
        $database->bindValue(':profile_picture', $image["basename"]);
        $database->bindValue(':id', $userId);
        $result = $database->execute();

        // if update failed, then delete the user picture
        if (!$result) {
            Uploader::deleteFile(IMAGES . "profile_pictures/" . $image["basename"]);
            throw new Exception("Profile Picture " . $image["basename"] . " couldn't be updated");
        }

        return $image;
    }

    /**
     * revoke Email updates
     *
     * @access public
     * @param  integer  $userId
     * @param  string   $emailToken
     * @return mixed
     * @throws Exception If failed to revoke email updates.
     */
    public function revokeEmail($userId, $emailToken)
    {

        if (empty($userId) || empty($emailToken)) {
            return false;
        }

        $database = Database::openConnection();
        $database->prepare("SELECT * FROM users WHERE id = :id AND email_token = :email_token AND is_email_activated = 1 LIMIT 1");
        $database->bindValue(':id', $userId);
        $database->bindValue(':email_token', $emailToken);
        $database->execute();
        $users = $database->countRows();

        $query = "UPDATE users SET email_token = NULL, pending_email = NULL, pending_email_token = NULL WHERE id = :id LIMIT 1";
        $database->prepare($query);
        $database->bindValue(':id', $userId);
        $result = $database->execute();

        if (!$result) {
            throw new Exception("Couldn't revoke email updates");
        }

        if ($users === 1) {
            return true;
        } else {
            Logger::log("REVOKE EMAIL", "User ID " . $userId . " is trying to revoke email using wrong token " . $emailToken, __FILE__, __LINE__);
            return false;
        }
    }

    /**
     * update Email
     *
     * @access public
     * @param  integer  $userId
     * @param  string   $emailToken
     * @return mixed
     * @throws Exception If failed to update current email.
     */
    public function updateEmail($userId, $emailToken)
    {

        if (empty($userId) || empty($emailToken)) {
            return false;
        }

        $database = Database::openConnection();
        $database->prepare("SELECT * FROM users WHERE id = :id AND pending_email_token = :pending_email_token AND is_email_activated = 1 LIMIT 1");
        $database->bindValue(':id', $userId);
        $database->bindValue(':pending_email_token', $emailToken);
        $database->execute();

        if ($database->countRows() === 1) {

            $user = $database->fetchAssociative();
            $validation = new Validation();
            $validation->addRuleMessage("emailUnique", "We can't change your email because it has been already taken!");

            if (!$validation->validate(["Email" => [$user["pending_email"], "emailUnique"]])) {

                $query = "UPDATE users SET email_token = NULL, pending_email = NULL, pending_email_token = NULL WHERE id = :id LIMIT 1";
                $database->prepare($query);
                $database->bindValue(':id', $userId);
                $database->execute();

                $this->errors = $validation->errors();

                return false;
            } else {

                $query = "UPDATE users SET email = :email, email_token = NULL, pending_email = NULL, pending_email_token = NULL WHERE id = :id LIMIT 1";
                $database->prepare($query);
                $database->bindValue(':id', $userId);
                $database->bindValue(':email', $user["pending_email"]);
                $result = $database->execute();

                if (!$result) {
                    throw new Exception("Couldn't update current email");
                }

                return true;
            }
        } else {

            $query = "UPDATE users SET email_token = NULL, pending_email = NULL, pending_email_token = NULL WHERE id = :id LIMIT 1";
            $database->prepare($query);
            $database->bindValue(':id', $userId);
            $database->execute();

            Logger::log("UPDATE EMAIL", "User ID " . $userId . " is trying to update email using wrong token " . $emailToken, __FILE__, __LINE__);
            return false;
        }
    }

    /**
     * Get Notifications for newsfeed, posts & files.
     *
     * @access public
     * @param  integer $userId
     * @return array
     */
    public function getNotifications($userId)
    {

        $database = Database::openConnection();
        $query = "SELECT target, count FROM notifications WHERE user_id = :user_id";

        $database->prepare($query);
        $database->bindValue(":user_id", $userId);
        $database->execute();

        $notifications = $database->fetchAllAssociative();
        return $notifications;
    }

    /**
     * Clear Notifications for a specific target
     *
     * @access public
     * @param  integer $userId
     * @param  string $table
     */
    public function clearNotifications($userId, $table)
    {

        $database = Database::openConnection();
        $query = "UPDATE notifications SET count = 0 WHERE user_id = :user_id AND target = :target";

        $database->prepare($query);
        $database->bindValue(":user_id", $userId);
        $database->bindValue(":target", $table);
        $result = $database->execute();

        if (!$result) {
            Logger::log("NOTIFICATIONS", "Couldn't clear notifications", __FILE__, __LINE__);
        }
    }

    /**
     * Returns an overview about the current system:
     * 1. counts of newsfeed, posts, files, users
     * 2. latest updates by using "UNION"
     *
     * @access public
     * @return array
     *
     */
    public function dashboard()
    {

        $database = Database::openConnection();

        // 1. count
        $tables = ["newsfeed", "posts", "files", "users"];
        $stats = [];

        foreach ($tables as $table) {
            $stats[$table] = $database->countAll($table);
        }

        // 2. latest updates
        // Using UNION to union the data fetched from different tables.
        // @see http://www.w3schools.com/sql/sql_union.asp
        // @see (mikeY) http://stackoverflow.com/questions/6849063/selecting-data-from-two-tables-and-ordering-by-date

        // Sub Query: In SELECT, The outer SELECT must have alias, like "updates" here.
        // NOTE: The outer SELECT is not needed; You don't need to wrap the union-ed select statements.
        // @see http://stackoverflow.com/questions/1888779/every-derived-table-must-have-its-own-alias

        $query = "SELECT * FROM (";
        $query .= "SELECT 'newsfeed' AS target, content AS title, date, users.name FROM newsfeed, users WHERE user_id = users.id UNION ";
        $query .= "SELECT 'posts' AS target, title, date, users.name FROM posts, users WHERE user_id = users.id UNION ";
        $query .= "SELECT 'files' AS target, filename AS title, date, users.name FROM files, users WHERE user_id = users.id ";
        $query .= ") AS updates ORDER BY date DESC LIMIT 10";
        $database->prepare($query);
        $database->execute();
        $updates = $database->fetchAllAssociative();

        $data = array("stats" => $stats, "updates" => $updates);
        return $data;
    }

    /**
     * Reporting Bug, Feature, or Enhancement.
     *
     * @access public
     * @param  integer $userId
     * @param  string  $subject
     * @param  string  $label
     * @param  string  $message
     * @return bool
     *
     */
    public function reportBug($userId, $subject, $label, $message)
    {

        $validation = new Validation();
        if (!$validation->validate([
            "Subject" => [$subject, "required|minLen(4)|maxLen(80)"],
            "Label" => [$label, "required|inArray(" . Utility::commas(["bug", "feature", "enhancement"]) . ")"],
            "Message" => [$message, "required|minLen(4)|maxLen(1800)"],
        ])) {

            $this->errors = $validation->errors();
            return false;
        }

        $curUser = $this->getProfileInfo($userId);
        $data = ["subject" => $subject, "label" => $label, "message" => $message];

        // email will be sent to the admin
        Email::sendEmail(Config::get('EMAIL_REPORT_BUG'), Config::get('ADMIN_EMAIL'), ["id" => $userId, "name" => $curUser["name"]], $data);

        return true;
    }

    public function search_polygon($nolot, $coord)
    {
        $database = Database::openConnection();
        $oracleDB = new Oracle();

        $output = array();
        $rowOutput = array();

        $sql = "SELECT * FROM data.coordinates ";
        $sql .= "WHERE ST_Contains(ST_GeomFromEWKT('SRID=4326; " . $coord . "'), geom)";
        $database->prepare($sql);
        $database->execute();
        $rows = $database->fetchAllAssociative();

        if ($database->countRows() > 0) {
            foreach ($rows as $key => $val) {
                $query = "SELECT h.*, b.BGN_BNAMA FROM SPMC.V_HVNDUK h ";
                $query .= "LEFT JOIN SPMC.V_HBANGN b ON h.PEG_BGKOD = b.BGN_BGKOD ";
                $query .= "WHERE h.peg_akaun = '" . $val['akaun'] . "'";
                $oracleDB->prepare($query);
                $oracleDB->execute();
                $data = $oracleDB->fetchAssociative();

                $rowOutput['STATUS'] = true;
                $rowOutput['AKAUN'] = $data['peg_akaun'];
                $rowOutput['PLGID'] = $data['pmk_plgid'];
                $rowOutput['NMBIL'] = $data['pmk_nmbil'];
                $rowOutput['LSTNH'] = $data['peg_lstnh'];
                $rowOutput['LSBGN'] = $data['peg_lsbgn'];
                $rowOutput['LSANS'] = $data['peg_lsans'];
                $rowOutput['KADAR'] = $data['kaw_kadar'];
                $rowOutput['NOLOT'] = $data['peg_nolot'];
                $rowOutput['NILTH'] = $data['peg_nilth'];
                $rowOutput['TKSIR'] = $data['peg_tksir'];
                $rowOutput['ADPG1'] = $data['adpg1'];
                $rowOutput['ADPG2'] = $data['adpg2'];
                $rowOutput['ADPG3'] = $data['adpg3'];
                $rowOutput['ADPG4'] = $data['adpg4'];
                $rowOutput['BNAMA'] = $data['bgn_bnama'];
                $rowOutput['CODEX'] = $data['peg_codex'];
                $rowOutput['CODEY'] = $data['peg_codey'];

                array_push($output, $rowOutput);
            }
            return $output;
            $oracleDB->closeOciConnection();
        } else {
            $rowOutput['STATUS'] = false;
            array_push($output, $rowOutput);
            return $output;
        }

        $oracleDB->closeOciConnection();
    }

    public function searchFeature($noakaun)
    {
        $database = Database::openConnection();
        $oracleDB = new Oracle();

        $output = array();
        $rowOutput = array();

        $query = "SELECT h.*, b.BGN_BNAMA FROM SPMC.V_HVNDUK h ";
        $query .= "LEFT JOIN SPMC.V_HBANGN b ON h.PEG_BGKOD = b.BGN_BGKOD ";
        $query .= "WHERE h.peg_akaun = '" . $noakaun . "'";
        $oracleDB->prepare($query);
        $oracleDB->execute();
        $data = $oracleDB->fetchAssociative();

        if (!empty($data)) {

            $rowOutput['STATUS'] = true;
            $rowOutput['AKAUN'] = $data['peg_akaun'];
            $rowOutput['PLGID'] = $data['pmk_plgid'];
            $rowOutput['NMBIL'] = $data['pmk_nmbil'];
            $rowOutput['LSTNH'] = $data['peg_lstnh'];
            $rowOutput['LSBGN'] = $data['peg_lsbgn'];
            $rowOutput['LSANS'] = $data['peg_lsans'];
            $rowOutput['KADAR'] = $data['kaw_kadar'];
            $rowOutput['NOLOT'] = $data['peg_nolot'];
            $rowOutput['NILTH'] = $data['peg_nilth'];
            $rowOutput['TKSIR'] = $data['peg_tksir'];
            $rowOutput['ADPG1'] = $data['adpg1'];
            $rowOutput['ADPG2'] = $data['adpg2'];
            $rowOutput['ADPG3'] = $data['adpg3'];
            $rowOutput['ADPG4'] = $data['adpg4'];
            $rowOutput['BNAMA'] = $data['bgn_bnama'];
            $rowOutput['CODEX'] = $data['peg_codex'];
            $rowOutput['CODEY'] = $data['peg_codey'];

            array_push($output, $rowOutput);

            return $output;
            $oracleDB->closeOciConnection();
        } else {
            $rowOutput['STATUS'] = false;
            array_push($output, $rowOutput);
            return $output;
        }

        $oracleDB->closeOciConnection();
    }

    public function searchSiasat($noakaun)
    {
        $database = Database::openConnection();

        $output = array();
        $rowOutput = array();

        $sql = "SELECT s.smk_akaun, s.smk_nolot, s.smk_nompt, s.smk_lsbgn, s.smk_lstnh, s.smk_lsans, s.smk_lsbgn_tmbh, s.smk_lsans_tmbh, ";
        $sql .= "h.peg_akaun, h.pmk_plgid, h.pmk_nmbil, h.peg_lstnh, h.peg_lsbgn, h.peg_lsans, h.kaw_kadar, h.peg_nolot, h.peg_nilth, h.peg_tksir, ";
        $sql .= "h.adpg1, h.adpg2, h.adpg3, h.adpg4, h.peg_codex, h.peg_codey ";
        $sql .= "FROM data.smktpk s ";
        $sql .= "LEFT JOIN data.hvnduk h ON s.smk_akaun = h.peg_akaun ";
        $sql .= "WHERE s.smk_akaun = '" . $noakaun . "'";
        $database->prepare($sql);
        $database->execute();
        $row = $database->fetchAssociative();

        if (!empty($row)) {
            $rowOutput['STATUS'] = true;
            $rowOutput['NOMPT'] = $row['smk_nompt'];
            $rowOutput['LSBGNTMB'] = $row['smk_lsbgn_tmbh'];
            $rowOutput['LSANSTMB'] = $row['smk_lsans_tmbh'];
            $rowOutput['AKAUN'] = $row['peg_akaun'];
            $rowOutput['PLGID'] = $row['pmk_plgid'];
            $rowOutput['NMBIL'] = $row['pmk_nmbil'];
            $rowOutput['LSTNH'] = $row['peg_lstnh'];
            $rowOutput['LSBGN'] = $row['peg_lsbgn'];
            $rowOutput['LSANS'] = $row['peg_lsans'];
            $rowOutput['KADAR'] = $row['kaw_kadar'];
            $rowOutput['NOLOT'] = $row['peg_nolot'];
            $rowOutput['NILTH'] = $row['peg_nilth'];
            $rowOutput['TKSIR'] = $row['peg_tksir'];
            $rowOutput['ADPG1'] = $row['adpg1'];
            $rowOutput['ADPG2'] = $row['adpg2'];
            $rowOutput['ADPG3'] = $row['adpg3'];
            $rowOutput['ADPG4'] = $row['adpg4'];
            $rowOutput['CODEX'] = $row['peg_codex'];
            $rowOutput['CODEY'] = $row['peg_codey'];

            array_push($output, $rowOutput);

            return $output;
        } else {
            $rowOutput['STATUS'] = false;
            array_push($output, $rowOutput);
            return $output;
        }
    }

    public function getVisitMarkerGeojson()
    {

        $database = Database::openConnection();

        $query = "SELECT id, smk_akaun, smk_nolot, smk_nompt, smk_adpg1, smk_adpg2, smk_adpg3, smk_adpg4, smk_jalan, smk_kodkws, smk_jstnh, smk_jsbgn, smk_kgtnh, smk_stbgn, smk_lsbgn, smk_lstnh, smk_lsans, smk_lsbgn_tmbh, smk_lsans_tmbh, smk_codex, smk_codey, smk_onama, smk_type, smk_stspn, smk_stsen, smk_datevisit, 
jln_jnama, hrt_hnama, concat_ws(',', smk_codex, smk_codey) as geojson, ";
        $query .= "case 
	when tnh_thkod = 1 then 'blue' 
	when tnh_thkod = 2 then 'green' 
	when tnh_thkod = 3 then 'orange' 
	when tnh_thkod = 4 then 'gray' 
	when tnh_thkod = 5 then 'purple' 
	when tnh_thkod = 6 then 'chocolate' 
	when tnh_thkod = 7 then 'navi' 
	when tnh_thkod = 8 then 'red' 
	when tnh_thkod = 9 then 'yellow' 
	when tnh_thkod = 99 then 'black' 
end as color, 
tnh_tnama ";
        $query .= "FROM data.v_semak WHERE smk_codex != '' AND smk_codey != ''";

        $database->prepare($query);
        $database->execute();

        $output = '';
        $rowOutput = '';
        while ($row = $database->fetchAssociative()) {
            $rowOutput = (strlen($rowOutput) > 0 ? ',' : '') . '{"type": "Feature", "geometry": {"type":"Point","coordinates":[' . $row['geojson'] . ']}, "properties": {';
            $props = '';
            $id = '';
            foreach ($row as $key => $val) {
                if ($key != "geojson") {
                    $props .= (strlen($props) > 0 ? ',' : '') . '"' . $key . '":"' . $this->escapeJsonString($val) . '"';
                }
                if ($key == "id") {
                    $id .= ',"id":"' . $this->escapeJsonString($val) . '"';
                }
            }

            $rowOutput .= $props . '}';
            $rowOutput .= $id;
            $rowOutput .= '}';
            $output .= $rowOutput;
        }
        $output = '{ "type": "FeatureCollection", "features": [ ' . $output . ' ]}';
        return $output;
    }

    public function getPenilaianMarkerGeojson()
    {

        $database = Database::openConnection();

        $query = "select ph.mjb_akaun, h.adpg1, h.adpg2, h.adpg3, h.adpg4, concat_ws(',', c.codex, c.codey) as geojson ";
        $query .= "from data.ps_hacmjb ph ";
        $query .= "left join data.coordinates c on ph.mjb_akaun = c.akaun ";
        $query .= "left join data.hvnduk h on ph.mjb_akaun = h.peg_akaun ";
        $query .= "where c.codex is not null and c.codey is not null";

        $database->prepare($query);
        $database->execute();

        $output = '';
        $rowOutput = '';
        while ($row = $database->fetchAssociative()) {
            $rowOutput = (strlen($rowOutput) > 0 ? ',' : '') . '{"type": "Feature", "geometry": {"type":"Point","coordinates":[' . $row['geojson'] . ']}, "properties": {';
            $props = '';
            $id = '';
            foreach ($row as $key => $val) {
                if ($key != "geojson") {
                    $props .= (strlen($props) > 0 ? ',' : '') . '"' . $key . '":"' . $this->escapeJsonString($val) . '"';
                }
                if ($key == "id") {
                    $id .= ',"id":"' . $this->escapeJsonString($val) . '"';
                }
            }

            $rowOutput .= $props . '}';
            $rowOutput .= $id;
            $rowOutput .= '}';
            $output .= $rowOutput;
        }
        $output = '{ "type": "FeatureCollection", "features": [ ' . $output . ' ]}';
        return $output;
    }

    public function getPermitMarkerGeojson()
    {

        $database = Database::openConnection();

        $query = "select p.prmt_akaun, p.prmt_nolot, h.adpg1, h.adpg2, h.adpg3, h.adpg4, concat_ws(',', c.codex, c.codey) as geojson ";
        $query .= "from data.permit p ";
        $query .= "left join data.coordinates c on p.prmt_akaun = c.akaun ";
        $query .= "left join data.hvnduk h on p.prmt_akaun = h.peg_akaun ";

        $database->prepare($query);
        $database->execute();

        $output = '';
        $rowOutput = '';
        while ($row = $database->fetchAssociative()) {
            $rowOutput = (strlen($rowOutput) > 0 ? ',' : '') . '{"type": "Feature", "geometry": {"type":"Point","coordinates":[' . $row['geojson'] . ']}, "properties": {';
            $props = '';
            $id = '';
            foreach ($row as $key => $val) {
                if ($key != "geojson") {
                    $props .= (strlen($props) > 0 ? ',' : '') . '"' . $key . '":"' . $this->escapeJsonString($val) . '"';
                }
                if ($key == "id") {
                    $id .= ',"id":"' . $this->escapeJsonString($val) . '"';
                }
            }

            $rowOutput .= $props . '}';
            $rowOutput .= $id;
            $rowOutput .= '}';
            $output .= $rowOutput;
        }
        $output = '{ "type": "FeatureCollection", "features": [ ' . $output . ' ]}';
        return $output;
    }

    public function Statistik()
    {
        $oracleDB = Oracle::openOriConnection();

        $query = "select decode(signs,-1,'LEBIHAN',1,'TUNGGAKAN','SELESAI') as status,count(*) as count from spmc.v_takaun group by signs";

        $oracleDB->prepare($query);
        $oracleDB->execute();
        $rows = $oracleDB->fetchAllAssociative();

        $output = array();
        $rowOutput = array();
        foreach ($rows as $row) {
            $rowOutput['count'] = $row['count'];
            $rowOutput['status'] = $row['status'];
            array_push($output, $rowOutput);
        }
        $this->UpdateTablePayment();

        return $output;
    }

    public function UpdateTablePayment()
    {
        $database = Database::openConnection();
        $oracleDB = Oracle::openOriConnection();

        $database->getDataByTableColumns("data.v_takaun", "htang");
        $posts = $database->fetchAllAssociative();

        $oracleDB->getDataByTable("SPMC.V_TAKAUN");
        $rows = $oracleDB->fetchAllAssociative();

        foreach ($rows as $val) {
            if (!in_array(["htang" => $val["htang"]], $posts, true)) {
                $query = "UPDATE data.v_takaun ";
                $query .= "SET signs=:signs, htang=:htang WHERE akaun=:akaun";
                $database->prepare($query);
                $database->bindValue(":signs", $val["signs"]);
                $database->bindValue(":htang", $val["htang"]);
                $database->bindValue(":akaun", $val["akaun"]);
                $database->execute();
            } else {
                return false;
            }
        }
    }

    public function StatistikPenilaian()
    {
        $database = Database::openConnection();

        $qry = "select f.kws_knama ,ds.count ";
        $qry .= "from data.flkwsn f ";
        $qry .= "left join (select h.kaw_kwkod, count(*) as count ";
        $qry .= "from data.hvnduk h ";
        $qry .= "where h.peg_akaun not in (select smk_akaun as peg_akaun from data.smktpk) ";
        $qry .= "group by h.kaw_kwkod) ds on f.kws_kwkod = ds.kaw_kwkod order by f.kws_knama ASC";
        $database->prepare($qry);
        $database->execute();
        $rows = $database->fetchAllAssociative();

        $output_b = array();
        $rowOutput_b = array();
        foreach ($rows as $row) {
            $rowOutput_b['count'] = $row['count'];
            $rowOutput_b['kws_knama'] = $row['kws_knama'];
            array_push($output_b, $rowOutput_b);
        }

        $query = "select f.kws_knama ,case when ds.count is NULL then 0 else ds.count end as count ";
        $query .= "from data.flkwsn f ";
        $query .= "left join (select h.kaw_kwkod, count(*) as count ";
        $query .= "from data.smktpk s ";
        $query .= "left join data.hvnduk h on s.smk_akaun = h.peg_akaun ";
        $query .= "group by h.kaw_kwkod) ds on f.kws_kwkod = ds.kaw_kwkod order by f.kws_knama ASC";
        $database->prepare($query);
        $database->execute();
        $values = $database->fetchAllAssociative();

        $output_t = array();
        $rowOutput_t = array();
        foreach ($values as $val) {
            $rowOutput_t['count'] = $val['count'];
            $rowOutput_t['kws_knama'] = $val['kws_knama'];
            array_push($output_t, $rowOutput_t);
        }

        return array("belom" => $output_b, "telah" => $output_t);
    }

    public function escapeJsonString($value)
    { # list from www.json.org: (\b backspace, \f formfeed)
        $escapers = array("\\", "'", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c");
        $replacements = array("\\\\", "\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b");
        $result = str_replace($escapers, $replacements, $value);
        return $result;
    }
}