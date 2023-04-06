<?php

class Engineering extends Model
{

    public function getSiasatanTapak($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
    {

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = "CAST(v.smk_akaun AS TEXT) iLIKE '%" . $searchValue . "' OR u.name iLIKE '%" . $searchValue . "'";
        }

        ## Total number of records without filtering
        $sql = "SELECT count(*) AS allcount FROM data.v_semak v ";
        $sel = $database->prepare($sql);
        $database->execute($sel);
        $records = $database->fetchAssociative();
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sql = "SELECT count(*) AS allcount FROM data.v_semak v ";
        $sql .= "LEFT JOIN public.users u ON v.smk_onama = u.workerid ";
        if ($searchValue != '') {
            $sql .= "WHERE v.smk_stsen = '0' AND (v.smk_lsbgn_tmbh != 0 OR v.smk_lsans_tmbh != 0) AND " . $searchQuery;
        } else {
            $sql .= "WHERE v.smk_stsen = '0' AND (v.smk_lsbgn_tmbh != 0 OR v.smk_lsans_tmbh != 0)";
        }
        $sel = $database->prepare($sql);
        $database->execute($sel);

        $records = $database->fetchAssociative();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $query = "SELECT v.smk_akaun as no_akaun, v.smk_lsbgn_tmbh as bgn_tmbh, v.smk_lsans_tmbh as anso_tmbh, u.name as entry, v.smk_stsen ";
        $query .= "FROM data.v_semak v ";
        $query .= "LEFT JOIN public.users u ON v.smk_onama = u.workerid ";
        if ($searchValue != '') {
            $query .= "WHERE v.smk_stsen = '0' AND (v.smk_lsbgn_tmbh != 0 OR v.smk_lsans_tmbh != 0) AND " . $searchQuery;
        } else {
            $query .= "WHERE v.smk_stsen = '0' AND (v.smk_lsbgn_tmbh != 0 OR v.smk_lsans_tmbh != 0)";
        }
        if ($columnName != '') {
            $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
        }
        $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
        $database->prepare($query);
        $database->execute();

        $row = $database->fetchAllAssociative();
        $output = array();
        $rowOutput = array();
        foreach ($row as $val) {
            $qry = "SELECT PEG_NOLOT, PEG_LSBGN, PEG_LSTNH, PEG_LSANS, ADPG1, ADPG2, ADPG3, ADPG4 ";
            $qry .= "FROM SPMC.V_HVNDUK WHERE PEG_AKAUN = " . $val["no_akaun"];
            $dbOracle->prepare($qry);
            $dbOracle->execute();
            $row = $dbOracle->fetchAssociative();

            $rowOutput['akaun'] = Encryption::encryptId($val['no_akaun']);
            $rowOutput['no_akaun'] = $val['no_akaun'];
            $rowOutput['peg_nolot'] = $row['peg_nolot'];
            $rowOutput['adpg1'] = $row['adpg1'];
            $rowOutput['adpg2'] = $row['adpg2'];
            $rowOutput['adpg3'] = $row['adpg3'];
            $rowOutput['adpg4'] = $row['adpg4'];
            $rowOutput['peg_lsbgn'] = $row['peg_lsbgn'];
            $rowOutput['peg_lstnh'] = $row['peg_lstnh'];
            $rowOutput['peg_lsans'] = $row['peg_lsans'];
            $rowOutput['bgn_tmbh'] = $val['bgn_tmbh'];
            $rowOutput['anso_tmbh'] = $val['anso_tmbh'];
            $rowOutput['entry'] = $val['entry'];
            $rowOutput['role'] = Session::getUserRole();
            array_push($output, $rowOutput);
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $output,
        );

        return $response;
    }

    public function getPermit($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
    {

        $database = Database::openConnection();

        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = "CAST(prmt_akaun AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_nolot AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_lsbgn_asal AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_lstnh AS TEXT) LIKE '%" . $searchValue . "%' OR
            CAST(prmt_lsbgn_tmbh AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_lsstbck AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_lsyearly AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_amt AS TEXT) LIKE '%" . $searchValue . "%' OR
            CAST(prmt_amt_thnan AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(prmt_tahun AS TEXT) LIKE '%" . $searchValue . "%'";
        }

        ## Total number of records without filtering
        $sql = "SELECT count(*) AS allcount FROM data.permit";
        $sel = $database->prepare($sql);
        $database->execute($sel);
        $records = $database->fetchAssociative();
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sql = "SELECT count(*) AS allcount FROM data.permit ";
        if ($searchValue != '') {
            $sql .= "WHERE " . $searchQuery;
        }
        $sel = $database->prepare($sql);
        $database->execute($sel);

        $records = $database->fetchAssociative();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $query = "with permit as(select p.*, n.prmt_id as notis, n2.prmt_id as year
                    FROM data.permit p
                    LEFT JOIN data.notis n on p.id = n.prmt_id
                    LEFT JOIN data.notisthn n2 on p.id = n2.prmt_id) select p1.*, u.workerid, u.name  from permit p1 ";
        $query .= "LEFT JOIN public.users u ON p1.prmt_onama = u.workerid ";
        if ($searchValue != '') {
            $query .= "WHERE " . $searchQuery;
        }
        if ($columnName != '') {
            $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
        }
        $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
        $database->prepare($query);
        $database->execute();

        $row = $database->fetchAllAssociative();
        $output = array();
        $rowOutput = array();
        foreach ($row as $val) {
            $rowOutput['id'] = Encryption::encryptId($val['id']);
            $rowOutput['no_akaun'] = Encryption::encryptId($val['prmt_akaun']);
            $rowOutput['prmt_permit'] = $val['prmt_permit'];
            $rowOutput['prmt_akaun'] = $val['prmt_akaun'];
            $rowOutput['prmt_nolot'] = $val['prmt_nolot'];
            $rowOutput['prmt_nmpmk'] = $val['prmt_nmpmk'];
            $rowOutput['prmt_adpg1'] = $val['prmt_adpg1'];
            $rowOutput['prmt_adpg2'] = $val['prmt_adpg2'];
            $rowOutput['prmt_adpg3'] = $val['prmt_adpg3'];
            $rowOutput['prmt_adpg4'] = $val['prmt_adpg4'];
            $rowOutput['prmt_lsbgn_asal'] = $val['prmt_lsbgn_asal'];
            $rowOutput['prmt_lstnh'] = $val['prmt_lstnh'];
            $rowOutput['prmt_lsbgn_tmbh'] = $val['prmt_lsbgn_tmbh'];
            $rowOutput['prmt_lsbgnallow'] = $val['prmt_lsbgnallow'];
            $rowOutput['prmt_lsstbck'] = $val['prmt_lsstbck'];
            $rowOutput['prmt_thnan'] = $val['prmt_thnan'];
            $rowOutput['prmt_amt'] = $val['prmt_amt'];
            $rowOutput['prmt_amt_thnan'] = $val['prmt_amt_thnan'];
            $rowOutput['prmt_tahun'] = $val['prmt_tahun'];
            $rowOutput['prmt_sts_byr'] = $val['prmt_sts_byr'];
            $rowOutput['prmt_onama'] = $val['prmt_onama'];
            $rowOutput['prmt_date'] = $val['prmt_date'];
            $rowOutput['notis'] = $val['notis'];
            $rowOutput['year'] = $val['year'];
            $rowOutput['workerid'] = $val['workerid'];
            $rowOutput['name'] = $val['name'];
            $rowOutput['role'] = Session::getUserRole();
            array_push($output, $rowOutput);
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $output,
        );

        return $response;
    }

    public function getNotice($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
    {

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " prmt_akaun LIKE '%" . $searchValue . "%' OR smk_adpg1 LIKE '%" . $searchValue . "%' OR smk_adpg2 LIKE '%" . $searchValue . "%' OR smk_lsbgn LIKE '%" . $searchValue . "%' OR
            smk_lstnh LIKE '%" . $searchValue . "%' OR smk_lsans LIKE '%" . $searchValue . "%' OR smk_lsbgn_tmbh LIKE '%" . $searchValue . "%' OR smk_lsans_tmbh LIKE '%" . $searchValue . "%' OR
            smk_prmt_thn LIKE '%" . $searchValue . "%'";
        }

        ## Total number of records without filtering
        $sql = "SELECT count(*) AS allcount FROM data.permit p ";
        $sql .= "LEFT JOIN data.notis n ON p.id = n.prmt_id ";
        $sql .= "WHERE n.id IS NOT NULL";
        $sel = $database->prepare($sql);
        $database->execute($sel);
        $records = $database->fetchAssociative();
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sql = "SELECT count(*) AS allcount FROM data.permit p ";
        $sql .= "LEFT JOIN data.notis n ON p.id = n.prmt_id ";
        if ($searchValue != '') {
            $sql .= "WHERE n.id IS NOT NULL AND " . $searchQuery;
        } else {
            $sql .= "WHERE n.id IS NOT NULL";
        }
        $sel = $database->prepare($sql);
        $database->execute($sel);

        $records = $database->fetchAssociative();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $query = "SELECT p.id, p.prmt_akaun, p.prmt_nolot, p.prmt_nmpmk, p.prmt_adpg1, p.prmt_adpg2, p.prmt_adpg3, p.prmt_adpg4, p.prmt_lsbgn_asal, p.prmt_lstnh, ";
        $query .= "p.prmt_lsbgn_tmbh, p.prmt_lsbgnallow, p.prmt_lsstbck, p.prmt_thnan, p.prmt_amt, p.prmt_amt_thnan, p.prmt_tahun, p.prmt_sts_byr, p.prmt_onama, ";
        $query .= "p.prmt_date, n.id as idpgbh, n.rujfil as rujpgbh, n.tknotis as tkpgbh, u.workerid, u.name ";
        $query .= "FROM data.permit p ";
        $query .= "LEFT JOIN data.notis n ON p.id = n.prmt_id ";
        $query .= "LEFT JOIN public.users u ON p.prmt_onama = u.workerid ";
        $query .= "WHERE n.id IS NOT NULL";
        if ($searchValue != '') {
            $query .= "WHERE " . $searchQuery;
        }
        if ($columnName != '') {
            $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
        }
        $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
        $database->prepare($query);
        $database->execute();

        $rows = $database->fetchAllAssociative();
        $output = array();
        $rowOutput = array();
        foreach ($rows as $val) {

            $qry = "SELECT pmk_nmbil, adpg1, adpg2, adpg3, adpg4 FROM SPMC.V_HVNDUK WHERE peg_akaun = '" . $val['prmt_akaun'] . "'";
            $dbOracle->prepare($qry);
            $dbOracle->execute();
            $row = $dbOracle->fetchAssociative();

            $rowOutput['id'] = Encryption::encryptId($val['id']);
            $rowOutput['no_akaun'] = Encryption::encryptId($val['prmt_akaun']);
            $rowOutput['idpgbh'] = Encryption::encryptId($val['idpgbh']);
            $rowOutput['pmk_nmbil'] = $row['pmk_nmbil'];
            $rowOutput['adpg1'] = $row['adpg1'];
            $rowOutput['adpg2'] = $row['adpg2'];
            $rowOutput['adpg3'] = $row['adpg3'];
            $rowOutput['adpg4'] = $row['adpg4'];

            $rowOutput['prmt_akaun'] = $val['prmt_akaun'];
            $rowOutput['prmt_nolot'] = $val['prmt_nolot'];
            $rowOutput['prmt_lsbgn_asal'] = $val['prmt_lsbgn_asal'];
            $rowOutput['prmt_lstnh'] = $val['prmt_lstnh'];
            $rowOutput['prmt_lsbgn_tmbh'] = $val['prmt_lsbgn_tmbh'];
            $rowOutput['prmt_lsbgnallow'] = $val['prmt_lsbgnallow'];
            $rowOutput['prmt_lsstbck'] = $val['prmt_lsstbck'];
            $rowOutput['prmt_thnan'] = $val['prmt_thnan'];
            $rowOutput['prmt_amt'] = $val['prmt_amt'];
            $rowOutput['prmt_amt_thnan'] = $val['prmt_amt_thnan'];
            $rowOutput['prmt_tahun'] = $val['prmt_tahun'];
            $rowOutput['rujpgbh'] = $val['rujpgbh'];
            $rowOutput['tkpgbh'] = $val['tkpgbh'];
            $rowOutput['prmt_sts_byr'] = $val['prmt_sts_byr'];
            $rowOutput['prmt_onama'] = $val['prmt_onama'];
            $rowOutput['prmt_date'] = $val['prmt_date'];
            $rowOutput['workerid'] = $val['workerid'];
            $rowOutput['name'] = $val['name'];
            $rowOutput['role'] = Session::getUserRole();
            array_push($output, $rowOutput);
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $output,
        );

        return $response;
        $dbOracle->closeOciConnection();
    }

    public function generatePermit($userId, $workerId, $smk_id, $nsiri, $no_akaun, $no_lot, $permit, $luastanah, $luasbgnasal, $luasbgntamb, $luas_dibenarkan, $luas_stbck, $jumlah_denda, $denda_tahunan, $jumlah_tahunan)
    {

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $sql = "SELECT pmk_nmbil, adpg1, adpg2, adpg3, adpg4 FROM SPMC.V_HVNDUK WHERE peg_akaun = '" . $no_akaun . "'";
        $dbOracle->prepare($sql);
        $dbOracle->execute();
        $info = $dbOracle->fetchAssociative();

        $no_akaun = empty($no_akaun) ? "0" : $no_akaun;
        $no_lot = empty($no_lot) ? "0" : $no_lot;
        $nmpmk = empty($info['pmk_nmbil']) ? null : $info['pmk_nmbil'];
        $adpg1 = empty($info['adpg1']) ? null : $info['adpg1'];
        $adpg2 = empty($info['adpg2']) ? null : $info['adpg2'];
        $adpg3 = empty($info['adpg3']) ? null : $info['adpg3'];
        $adpg4 = empty($info['adpg4']) ? null : $info['adpg4'];
        $luastanah = empty($luastanah) ? "0" : $luastanah;
        $luasbgnasal = empty($luasbgnasal) ? "0" : $luasbgnasal;
        $luasbgntamb = empty($luasbgntamb) ? "0" : $luasbgntamb;
        $luas_dibenarkan = empty($luas_dibenarkan) ? "0" : $luas_dibenarkan;
        $luas_stbck = empty($luas_stbck) ? "0" : $luas_stbck;
        $jumlah_denda = empty($jumlah_denda) ? "0" : $jumlah_denda;
        $denda_tahunan = $denda_tahunan == false ? false : true;
        $luastahunan = empty($luastahunan) ? "0" : $luastahunan;
        $jumlah_tahunan = empty($jumlah_tahunan) ? "0" : $jumlah_tahunan;
        $sts_byr = "0";

        $query = "INSERT INTO data.permit ";
        $query .= "(prmt_permit, prmt_akaun, prmt_nolot, prmt_nmpmk, prmt_adpg1, prmt_adpg2, prmt_adpg3, prmt_adpg4, prmt_lsbgn_asal, prmt_lstnh, prmt_lsbgn_tmbh, prmt_lsbgnallow, prmt_lsstbck, prmt_thnan, prmt_amt, prmt_amt_thnan, prmt_tahun, prmt_sts_byr, prmt_onama, prmt_date) ";
        $query .= "VALUES(:permit, :akaun, :nolot, :nmpmk, :adpg1, :adpg2, :adpg3, :adpg4, :lsbgn_asal, :lstnh, :lsbgn_tmbh, :lsbgnallow, :lsstbck, :thnan, :amt, :amt_thnan, :tahun, :sts_byr, :workerid, CURRENT_TIMESTAMP)";

        $database->prepare($query);
        $database->bindValue(":permit", $permit);
        $database->bindValue(":akaun", $no_akaun);
        $database->bindValue(":nolot", $no_lot);
        $database->bindValue(":nmpmk", $nmpmk);
        $database->bindValue(":adpg1", $adpg1);
        $database->bindValue(":adpg2", $adpg2);
        $database->bindValue(":adpg3", $adpg3);
        $database->bindValue(":adpg4", $adpg4);
        $database->bindValue(":lsbgn_asal", $luasbgnasal);
        $database->bindValue(":lstnh", $luastanah);
        $database->bindValue(":lsbgn_tmbh", $luasbgntamb);
        $database->bindValue(":lsbgnallow", $luas_dibenarkan);
        $database->bindValue(":lsstbck", $luas_stbck);
        $database->bindValue(":thnan", $denda_tahunan);
        $database->bindValue(":amt", $jumlah_denda);
        $database->bindValue(":amt_thnan", $jumlah_tahunan);
        $database->bindValue(":tahun", date('Y'));
        $database->bindValue(":sts_byr", $sts_byr);
        $database->bindValue(":workerid", $workerId);
        $result = $database->execute();

        if ($result) {
            $activity = "Kemasukkan data permit - No Lot : " . $no_lot;
            $database->logActivity($userId, $activity);
            $database->updateStatusPermit($smk_id);
        }

        return true;
        $dbOracle->closeOciConnection();
    }

    public function getDetails($fileId)
    {
        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $fileId = Encryption::decryptId($fileId);

        $query = "SELECT v.id as smk_id, v.smk_akaun as no_akaun, v.smk_lsbgn_tmbh as bgn_tmbh, v.smk_lsans_tmbh as anso_tmbh, v.smk_codex, v.smk_codey, ";
        $query .= "u.name as entry, v.smk_stsen ";
        $query .= "FROM data.v_semak v ";
        $query .= "LEFT JOIN public.users u ON v.smk_onama = u.workerid ";
        $query .= "WHERE v.smk_akaun = " . $fileId;
        $database->prepare($query);
        $database->execute();
        $val = $database->fetchAssociative();

        $rowOutput = array();

        $sql = "SELECT PMK_NMBIL, PEG_NOLOT, PEG_LSBGN, PEG_LSTNH, PEG_LSANS, ADPG1, ADPG2, ADPG3, ADPG4 FROM SPMC.V_HVNDUK WHERE peg_akaun = " . $val['no_akaun'];
        $dbOracle->prepare($sql);
        $dbOracle->execute();
        $info = $dbOracle->fetchAssociative();

        $rowOutput['no_akaun'] = $val['no_akaun'];
        $rowOutput['smk_id'] = $val['smk_id'];
        $rowOutput['peg_nolot'] = $info['peg_nolot'];
        $rowOutput['peg_lsbgn'] = $info['peg_lsbgn'];
        $rowOutput['peg_lstnh'] = $info['peg_lstnh'];
        $rowOutput['peg_lsans'] = $info['peg_lsans'];
        $rowOutput['bgn_tmbh'] = $val['bgn_tmbh'];
        $rowOutput['anso_tmbh'] = $val['anso_tmbh'];
        $rowOutput['codex'] = $val['smk_codex'];
        $rowOutput['codey'] = $val['smk_codey'];

        $rowOutput['nmbil'] = $info['pmk_nmbil'];
        $rowOutput['adpg1'] = $info['adpg1'];
        $rowOutput['adpg2'] = $info['adpg2'];
        $rowOutput['adpg3'] = $info['adpg3'];
        $rowOutput['adpg4'] = $info['adpg4'];

        return $rowOutput;
        $dbOracle->closeOciConnection();
    }

    public function getPermitDetails($fileId)
    {
        $database = Database::openConnection();

        $fileId = Encryption::decryptId($fileId);

        $query = "SELECT p.*, s.id as smk_id, s.smk_codex, s.smk_codey FROM data.permit p ";
        $query .= "INNER JOIN data.smktpk s ON p.id = s.id ";
        $query .= "WHERE p.id = " . $fileId;
        $database->prepare($query);
        $database->execute();
        $val = $database->fetchAssociative();

        // $rowOutput = array();

        // $rowOutput['id'] = Encryption::encryptId($val['id']);
        // $rowOutput['prmt_permit'] = $val['prmt_permit'];
        // $rowOutput['prmt_akaun'] = $val['prmt_akaun'];
        // $rowOutput['prmt_nolot'] = $val['prmt_nolot'];
        // $rowOutput['prmt_nmpmk'] = $val['prmt_nmpmk'];
        // $rowOutput['prmt_adpg1'] = $val['prmt_adpg1'];
        // $rowOutput['prmt_adpg2'] = $val['prmt_adpg2'];
        // $rowOutput['prmt_adpg3'] = $val['prmt_adpg3'];
        // $rowOutput['prmt_adpg4'] = $val['prmt_adpg4'];
        // $rowOutput['smk_codex'] = $val['smk_codex'];
        // $rowOutput['smk_codey'] = $val['smk_codey'];
        // $rowOutput['prmt_lsbgn_asal'] = $info['prmt_lsbgn_asal'];
        // $rowOutput['prmt_lstnh'] = $info['prmt_lstnh'];
        // $rowOutput['prmt_lsbgn_tmbh'] = $info['prmt_lsbgn_tmbh'];
        // $rowOutput['prmt_lsbgnallow'] = $info['prmt_lsbgnallow'];
        // $rowOutput['prmt_lsstbck'] = $info['prmt_lsstbck'];
        // $rowOutput['prmt_thnan'] = $val['prmt_thnan'];
        // $rowOutput['prmt_amt'] = $val['prmt_amt'];
        // $rowOutput['prmt_amt_thnan'] = $val['prmt_amt_thnan'];
        // $rowOutput['prmt_tahun'] = $val['prmt_tahun'];
        // $rowOutput['prmt_sts_byr'] = $val['prmt_sts_byr'];

        return $val;
    }

    public function getRenovationNotice($userId, $fileId)
    {
        $fileId = Encryption::decryptId($fileId);

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $query = "SELECT p.prmt_akaun, p.prmt_nolot, n.id, n.prmt_id, n.rujfil, n.tknotis ";
        $query .= "FROM data.notis n ";
        $query .= "LEFT JOIN data.permit p ON n.prmt_id = p.id ";
        $query .= "WHERE n.id = :fileId ";
        $database->prepare($query);
        $database->bindValue(":fileId", $fileId);
        $database->execute();
        $prmt = $database->fetchAssociative();

        $query = "SELECT pmk_nmbil, adpg1, adpg2, adpg3, adpg4 FROM SPMC.V_HVNDUK WHERE peg_akaun = '" . $prmt['prmt_akaun'] . "'";
        $dbOracle->prepare($query);
        $dbOracle->execute();
        $info = $dbOracle->fetchAssociative();

        $rowOutput['idthn'] = Encryption::encryptId($prmt['id']);
        $rowOutput['prmt_id'] = $prmt['prmt_id'];
        $rowOutput['rujfil'] = $prmt['rujfil'];
        $rowOutput['tknotis'] = date("d/m/Y", strtotime($prmt['tknotis']));
        $rowOutput['nmbil'] = $info['pmk_nmbil'];
        $rowOutput['adpg1'] = $info['adpg1'];
        $rowOutput['adpg2'] = $info['adpg2'];
        $rowOutput['adpg3'] = $info['adpg3'];
        $rowOutput['adpg4'] = $info['adpg4'];

        return $rowOutput;
        $dbOracle->closeOciConnection();
    }

    public function getNoticeYearly($userId, $fileId)
    {
        $fileId = Encryption::decryptId($fileId);

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $query = "SELECT p.prmt_akaun, p.prmt_nolot, n.id as idthn, n.rujfil as rujfilthn, n.rujpeg as rujpegthn, n.perkara as perkarathn, n.nilded as nildedthn, n.tkmula as tkmulathn, ";
        $query .= "n.tksblom as tksblomthn, n.thpermit as thpermitthn, n.tknotis as tknotisthn FROM data.notisthn n ";
        $query .= "LEFT JOIN data.permit p ON n.prmt_id = p.id ";
        $query .= "WHERE n.id = :fileId ";
        $database->prepare($query);
        $database->bindValue(":fileId", $fileId);
        $result = $database->execute();
        $prmt = $database->fetchAssociative();

        $query = "SELECT pmk_nmbil, adpg1, adpg2, adpg3, adpg4 FROM SPMC.V_HVNDUK WHERE peg_akaun = '" . $prmt['prmt_akaun'] . "'";
        $dbOracle->prepare($query);
        $dbOracle->execute();
        $info = $dbOracle->fetchAssociative();

        $rowOutput = array();

        $rowOutput['idthn'] = Encryption::encryptId($prmt['idthn']);
        $rowOutput['prmt_akaun'] = $prmt['prmt_akaun'];
        $rowOutput['prmt_nolot'] = $prmt['prmt_nolot'];
        $rowOutput['rujfilthn'] = $prmt['rujfilthn'];
        $rowOutput['rujpegthn'] = $prmt['rujpegthn'];
        $rowOutput['tknotisthn'] = $prmt['tknotisthn'];
        $rowOutput['nildedthn'] = $prmt['nildedthn'];
        $rowOutput['tkmulathn'] = date("j F Y", strtotime($prmt['tkmulathn']));
        $rowOutput['tksblomthn'] = date("j F Y", strtotime($prmt['tksblomthn']));
        $rowOutput['perkarathn'] = $prmt['perkarathn'];
        $rowOutput['nmbil'] = $info['pmk_nmbil'];
        $rowOutput['adpg1'] = $info['adpg1'];
        $rowOutput['adpg2'] = $info['adpg2'];
        $rowOutput['adpg3'] = $info['adpg3'];
        $rowOutput['adpg4'] = $info['adpg4'];

        if ($result) {
            $activity = "Cetak Notis, No Akaun : " . $fileId;
            $database->logActivity($userId, $activity);
        }

        return $rowOutput;
        $dbOracle->closeOciConnection();
    }

    public function getTableNoticeYearly($fileId, $draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
    {

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $searchQuery = '';
        if ($searchValue != '') {
            $searchQuery = " prmt_akaun LIKE '%" . $searchValue . "%' OR prmt_adpg1 LIKE '%" . $searchValue . "%' OR prmt_adpg2 LIKE '%" . $searchValue . "%' OR prmt_lsbgn_asal LIKE '%" . $searchValue . "%' OR
            prmt_lstnh LIKE '%" . $searchValue . "%' OR prmt_lsbgn_tmbh LIKE '%" . $searchValue . "%' OR prmt_tahun LIKE '%" . $searchValue . "%' OR
            prmt_nmpmk LIKE '%" . $searchValue . "%'";
        }

        ## Total number of records without filtering
        $sql = "SELECT count(*) AS allcount FROM data.permit p ";
        $sql .= "LEFT JOIN data.notisthn nh ON p.id = nh.prmt_id ";
        $sql .= "WHERE p.id = $fileId AND nh.id IS NOT NULL";
        $sel = $database->prepare($sql);
        $database->execute($sel);
        $records = $database->fetchAssociative();
        $totalRecords = $records['allcount'];

        ## Total number of record with filtering
        $sql = "SELECT count(*) AS allcount FROM data.permit p ";
        $sql .= "LEFT JOIN data.notisthn nh ON p.id = nh.prmt_id ";
        if ($searchValue != '') {
            $sql .= "WHERE p.id = $fileId AND nh.id IS NOT NULL AND " . $searchQuery;
        } else {
            $sql .= "WHERE p.id = $fileId AND nh.id IS NOT NULL";
        }
        $sel = $database->prepare($sql);
        $database->execute($sel);

        $records = $database->fetchAssociative();
        $totalRecordwithFilter = $records['allcount'];

        ## Fetch records
        $query = "SELECT p.id, p.prmt_akaun, p.prmt_nolot, p.prmt_nmpmk, p.prmt_adpg1, p.prmt_adpg2, p.prmt_adpg3, p.prmt_adpg4, p.prmt_lsbgn_asal, p.prmt_lstnh, ";
        $query .= "p.prmt_lsbgn_tmbh, p.prmt_lsbgnallow, p.prmt_lsstbck, p.prmt_thnan, p.prmt_amt, p.prmt_amt_thnan, p.prmt_tahun, p.prmt_sts_byr, p.prmt_onama, ";
        $query .= "p.prmt_date, nh.id as idthn, nh.rujfil as rujfilthn, nh.rujpeg as rujpegthn, nh.perkara as perkarathn, nh.nilded as nildedthn, nh.tkmula as tkmulathn, ";
        $query .= "nh.tksblom as tksblomthn, nh.thpermit as thpermitthn, nh.tknotis as tknotisthn, u.workerid, u.name ";
        $query .= "FROM data.permit p ";
        $query .= "LEFT JOIN data.notisthn nh ON p.id = nh.prmt_id ";
        $query .= "LEFT JOIN public.users u ON p.prmt_onama = u.workerid ";
        $query .= "WHERE p.id = $fileId AND nh.id IS NOT NULL";
        if ($searchValue != '') {
            $query .= "WHERE " . $searchQuery;
        }
        if ($columnName != '') {
            $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
        }
        $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
        $database->prepare($query);
        $database->execute();

        $rows = $database->fetchAllAssociative();
        $output = array();
        $rowOutput = array();
        foreach ($rows as $row) {

            $qry = "SELECT pmk_nmbil, adpg1, adpg2, adpg3, adpg4 FROM SPMC.V_HVNDUK WHERE peg_akaun = '" . $row['prmt_akaun'] . "'";
            $dbOracle->prepare($qry);
            $dbOracle->execute();
            $info = $dbOracle->fetchAssociative();

            $rowOutput['id'] = Encryption::encryptId($row['id']);
            $rowOutput['no_akaun'] = Encryption::encryptId($row['prmt_akaun']);
            $rowOutput['idthn'] = Encryption::encryptId($row['idthn']);

            $rowOutput['prmt_akaun'] = $row['prmt_akaun'];
            $rowOutput['prmt_nolot'] = $row['prmt_nolot'];
            $rowOutput['prmt_lsbgn_asal'] = $row['prmt_lsbgn_asal'];
            $rowOutput['prmt_lstnh'] = $row['prmt_lstnh'];
            $rowOutput['prmt_lsbgn_tmbh'] = $row['prmt_lsbgn_tmbh'];
            $rowOutput['prmt_lsbgnallow'] = $row['prmt_lsbgnallow'];
            $rowOutput['prmt_lsstbck'] = $row['prmt_lsstbck'];
            $rowOutput['prmt_thnan'] = $row['prmt_thnan'];
            $rowOutput['prmt_amt'] = $row['prmt_amt'];
            $rowOutput['prmt_amt_thnan'] = $row['prmt_amt_thnan'];
            $rowOutput['prmt_tahun'] = $row['prmt_tahun'];
            $rowOutput['prmt_sts_byr'] = $row['prmt_sts_byr'];
            $rowOutput['rujfilthn'] = $row['rujfilthn'];
            $rowOutput['rujpegthn'] = $row['rujpegthn'];
            $rowOutput['tknotisthn'] = $row['tknotisthn'];
            $rowOutput['tkmulathn'] = date("j F Y", strtotime($row['tkmulathn']));
            $rowOutput['tksblomthn'] = date("j F Y", strtotime($row['tksblomthn']));
            $rowOutput['perkarathn'] = $row['perkarathn'];
            $rowOutput['prmt_onama'] = $row['prmt_onama'];
            $rowOutput['prmt_date'] = $row['prmt_date'];
            $rowOutput['workerid'] = $row['workerid'];
            $rowOutput['name'] = $row['name'];
            $rowOutput['nmbil'] = $info['pmk_nmbil'];
            $rowOutput['adpg1'] = $info['adpg1'];
            $rowOutput['adpg2'] = $info['adpg2'];
            $rowOutput['adpg3'] = $info['adpg3'];
            $rowOutput['adpg4'] = $info['adpg4'];
            array_push($output, $rowOutput);
        }

        ## Response
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordwithFilter,
            "aaData" => $output,
        );

        return $response;
        $dbOracle->closeOciConnection();
    }

    public function getImages($fileId)
    {

        $database = Database::openConnection();
        $fileId = Encryption::decryptId($fileId);

        $query = "SELECT * FROM data.files ";
        $query .= "WHERE no_akaun = :fileId ";

        $database->prepare($query);
        $database->bindValue(":fileId", $fileId);
        $database->execute();

        $imgs = $database->fetchAllAssociative();
        return $imgs;
    }

    public function getPermitAccount($fileId)
    {
        $database = Database::openConnection();
        $fileId = Encryption::decryptId($fileId);

        $query = "SELECT * FROM data.permit ";
        $query .= "WHERE id = :fileId ";
        $database->prepare($query);
        $database->bindValue(":fileId", $fileId);
        $database->execute();
        $prmt = $database->fetchAssociative();

        return $prmt;
    }

    public function getNoticeDetails($fileId)
    {
        $database = Database::openConnection();
        $fileId = Encryption::decryptId($fileId);

        $query = "SELECT n.id, n.rujfil, n.tknotis, p.prmt_nmpmk, p.prmt_adpg1, p.prmt_adpg2, p.prmt_adpg3, p.prmt_adpg4 FROM data.notis n ";
        $query .= "LEFT JOIN data.permit p ON n.prmt_id = p.id ";
        $query .= "WHERE n.id = :fileId ";
        $database->prepare($query);
        $database->bindValue(":fileId", $fileId);
        $database->execute();
        $row = $database->fetchAssociative();

        return $row;
    }

    public function getNoticeYearDetails($fileId)
    {

        $fileId = Encryption::decryptId($fileId);

        $database = Database::openConnection();
        $dbOracle = new Oracle();

        $query = "SELECT p.prmt_akaun, p.prmt_nolot, nh.id as idthn, nh.rujfil as rujfilthn, nh.rujpeg as rujpegthn, nh.perkara as perkarathn, nh.nilded as nildedthn, nh.tkmula as tkmulathn, ";
        $query .= "nh.tksblom as tksblomthn, nh.thpermit as thpermitthn, nh.tknotis as tknotisthn FROM data.notisthn nh ";
        $query .= "LEFT JOIN data.permit p ON nh.prmt_id = p.id ";
        $query .= "WHERE nh.id = :fileId ";
        $database->prepare($query);
        $database->bindValue(":fileId", $fileId);
        $database->execute();
        $prmt = $database->fetchAssociative();

        $query = "SELECT pmk_nmbil, adpg1, adpg2, adpg3, adpg4 FROM SPMC.V_HVNDUK WHERE peg_akaun = '" . $prmt['prmt_akaun'] . "'";
        $dbOracle->prepare($query);
        $dbOracle->execute();
        $info = $dbOracle->fetchAssociative();

        $rowOutput = array();

        $rowOutput['idthn'] = Encryption::encryptId($prmt['idthn']);
        $rowOutput['prmt_akaun'] = $prmt['prmt_akaun'];
        $rowOutput['prmt_nolot'] = $prmt['prmt_nolot'];
        $rowOutput['rujfilthn'] = $prmt['rujfilthn'];
        $rowOutput['rujpegthn'] = $prmt['rujpegthn'];
        $rowOutput['tknotisthn'] = $prmt['tknotisthn'];
        $rowOutput['nildedthn'] = $prmt['nildedthn'];
        $rowOutput['tkmulathn'] = date("j F Y", strtotime($prmt['tkmulathn']));
        $rowOutput['tksblomthn'] = date("j F Y", strtotime($prmt['tksblomthn']));
        $rowOutput['perkarathn'] = $prmt['perkarathn'];
        $rowOutput['nmbil'] = $info['pmk_nmbil'];
        $rowOutput['adpg1'] = $info['adpg1'];
        $rowOutput['adpg2'] = $info['adpg2'];
        $rowOutput['adpg3'] = $info['adpg3'];
        $rowOutput['adpg4'] = $info['adpg4'];

        return $rowOutput;
        $dbOracle->closeOciConnection();
    }

    public function generatePermitPengubahan($userId, $workerId, $file_id, $ruj_pejabat, $tarikh_notis)
    {
        $database = Database::openConnection();

        $tarikhnotis = explode("/", $tarikh_notis);
        $tarikhnotis = $tarikhnotis[2] . "-" . $tarikhnotis[1] . "-" . $tarikhnotis[0];

        $query = "SELECT * FROM data.permit WHERE id = $file_id";
        $database->prepare($query);
        $database->execute();
        $prmt = $database->fetchAssociative();

        $qry = "INSERT INTO data.notis";
        $qry .= "(prmt_id, rujfil, tknotis, entrydate)";
        $qry .= "VALUES($file_id, '$ruj_pejabat', '$tarikhnotis', CURRENT_TIMESTAMP)";
        $database->prepare($qry);
        $result = $database->execute();

        if ($result) {
            $activity = "Cetak Notis, No Akaun : " . $prmt['prmt_akaun'];
            $database->logActivity($userId, $activity);
        }

        return true;
    }

    public function generatePermitTahunan($userId, $workerId, $file_id, $ruj_pemilik, $ruj_pejabat, $tarikh_notis, $tarikh_bermula, $tarikh_sebelum, $perkara)
    {
        $database = Database::openConnection();
        $dbOracle = new Oracle();

        if ($tarikh_notis != null) {
            $tarikhnotis = explode("/", $tarikh_notis);
            $tarikhnotis = $tarikhnotis[2] . "-" . $tarikhnotis[1] . "-" . $tarikhnotis[0];
        }
        if ($tarikh_bermula != null) {
            $tarikhbermula = explode("/", $tarikh_bermula);
            $tarikhbermula = $tarikhbermula[2] . "-" . $tarikhbermula[1] . "-" . $tarikhbermula[0];
        }
        if ($tarikh_sebelum != null) {
            $tarikhsebelum = explode("/", $tarikh_sebelum);
            $tarikhsebelum = $tarikhsebelum[2] . "-" . $tarikhsebelum[1] . "-" . $tarikhsebelum[0];
        }

        $query = "SELECT * FROM data.permit WHERE id = $file_id";
        $database->prepare($query);
        $database->execute();
        $prmt = $database->fetchAssociative();

        $qry = "INSERT INTO data.notisthn";
        $qry .= "(prmt_id, rujfil, rujpeg, perkara, nilded, tkmula, tksblom, thpermit, tknotis, entrydate)";
        $qry .= "VALUES($file_id, '$ruj_pejabat', '$ruj_pemilik', '$perkara', " . $prmt['prmt_amt_thnan'] . ", '$tarikhbermula', '$tarikhsebelum', '" . date("Y", strtotime($tarikhnotis)) . "', '$tarikhnotis', CURRENT_TIMESTAMP)";
        $database->prepare($qry);
        $result = $database->execute();

        if ($result) {
            $activity = "Daftar Notis Tahunan, No Lot : " . $prmt['prmt_nolot'];
            $database->logActivity($userId, $activity);
        }

        return true;
    }
}
