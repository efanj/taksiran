<?php

class Filecode extends Model
{
  public function kodStatus($data)
  {
    if ($data == "Y") {
      return "Ya";
    } elseif ($data == "T") {
      return "Tidak";
    }
  }

  public function datetimeToDate($datetime)
  {
    if ($datetime == null) {
      $date = null;
    } else {
      $date = date("Y-m-d", strtotime($datetime));
    }
    return $date;
  }

  public function dateFormat($date)
  {
    if ($date == null) {
      $date = "-";
    } else {
      $date = date("d/m/Y", strtotime($date));
    }
    return $date;
  }

  public function convertMonth($data)
  {
    if ($data == "01") {
      return "Januari";
    } elseif ($data == "02") {
      return "Februari";
    } elseif ($data == "03") {
      return "Mac";
    } elseif ($data == "04") {
      return "April";
    } elseif ($data == "05") {
      return "May";
    } elseif ($data == "06") {
      return "Jun";
    } elseif ($data == "07") {
      return "Julai";
    } elseif ($data == "08") {
      return "Ogos";
    } elseif ($data == "09") {
      return "September";
    } elseif ($data == "10") {
      return "Oktober";
    } elseif ($data == "11") {
      return "November";
    } elseif ($data == "12") {
      return "Disember";
    }
  }

  public function reloadLandUse()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.htanah", "tnh_thkod");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_HTANAH");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["tnh_thkod" => $val["tnh_thkod"]], $posts, true)) {
        $query = "INSERT INTO data.htanah(tnh_thkod, tnh_tnama) ";
        $query .= "VALUES(:tnh_thkod, :tnh_tnama)";
        $database->prepare($query);
        $database->bindValue(":tnh_thkod", $val["tnh_thkod"]);
        $database->bindValue(":tnh_tnama", $val["tnh_tnama"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadLandProperty()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.hharta", "hrt_htkod");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_HHARTA");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["hrt_htkod" => $val["hrt_htkod"]], $posts, true)) {
        $query = "INSERT INTO data.hharta(hrt_htkod, hrt_hnama, hrt_turut) ";
        $query .= "VALUES(:hrt_htkod, :hrt_hnama, :hrt_turut)";
        $database->prepare($query);
        $database->bindValue(":hrt_htkod", $val["hrt_htkod"]);
        $database->bindValue(":hrt_hnama", $val["hrt_hnama"]);
        $database->bindValue(":hrt_turut", $val["hrt_turut"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadOwnerType()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.hjenpk", "jpk_jpkod");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_HJENPK");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["jpk_jpkod" => $val["jpk_jpkod"]], $posts, true)) {
        $query = "INSERT INTO data.hjenpk(jpk_jpkod, jpk_itkod, jpk_jnama, jpk_stcbk) ";
        $query .= "VALUES(:jpk_jpkod, :jpk_itkod, :jpk_jnama, :jpk_stcbk)";
        $database->prepare($query);
        $database->bindValue(":jpk_jpkod", $val["jpk_jpkod"]);
        $database->bindValue(":jpk_itkod", $val["jpk_itkod"]);
        $database->bindValue(":jpk_jnama", $val["jpk_jnama"]);
        $database->bindValue(":jpk_stcbk", $val["jpk_stcbk"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadBuildingType()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.hbangn", "bgn_bgkod");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_HBANGN");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["bgn_bgkod" => $val["bgn_bgkod"]], $posts, true)) {
        $query = "INSERT INTO data.hbangn(bgn_bgkod, bgn_bnama) ";
        $query .= "VALUES(:bgn_bgkod, :bgn_bnama)";
        $database->prepare($query);
        $database->bindValue(":bgn_bgkod", $val["bgn_bgkod"]);
        $database->bindValue(":bgn_bnama", $val["bgn_bnama"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadBuildingStructure()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.hstbgn", "stb_stkod");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_HSTBGN");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["stb_stkod" => $val["stb_stkod"]], $posts, true)) {
        $query = "INSERT INTO data.hstbgn(stb_stkod, stb_snama) ";
        $query .= "VALUES(:stb_stkod, :stb_snama)";
        $database->prepare($query);
        $database->bindValue(":stb_stkod", $val["stb_stkod"]);
        $database->bindValue(":stb_snama", $val["stb_snama"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadMessageMJP()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.hmjacm", "acm_sbkod");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_ACMRSN");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["acm_sbkod" => $val["acm_sbkod"]], $posts, true)) {
        $query = "INSERT INTO data.hmjacm(acm_sbkod, acm_sbktr) ";
        $query .= "VALUES(:acm_sbkod, :acm_sbktr)";
        $database->prepare($query);
        $database->bindValue(":acm_sbkod", $val["acm_sbkod"]);
        $database->bindValue(":acm_sbktr", $val["acm_sbktr"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadAnnualRate()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->prepare("SELECT kaw_kwkod, kaw_htkod FROM data.hkawkd ");
    $database->execute();
    $posts = $database->fetchAllAssociative();

    $dboracle->prepare("SELECT KWS_KWKOD, KWS_KNAMA, HRT_HTKOD, HRT_HNAMA, KAW_KADAR FROM SPMC.V_HKADAR");
    $dboracle->execute();
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["kaw_kwkod" => $val["kws_kwkod"], "kaw_htkod" => $val["hrt_htkod"]], $posts, true)) {
        $query = "INSERT INTO data.hkawkd (kaw_kwkod, kaw_htkod, kaw_kadar) ";
        $query .= "VALUES(:kaw_kwkod, :kaw_htkod, :kaw_kadar)";
        $database->prepare($query);
        $database->bindValue(":kaw_kwkod", $val["kws_kwkod"]);
        $database->bindValue(":kaw_htkod", $val["hrt_htkod"]);
        $database->bindValue(":kaw_kadar", $val["kaw_kadar"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadMeetingMJP()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $database->getDataByTableColumns("data.hmmacm", "mcm_blngn");
    $posts = $database->fetchAllAssociative();

    $dboracle->getDataByTable("SPMC.V_HMMACM");
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["mcm_blngn" => $val["mcm_blngn"]], $posts, true)) {
        $query = "INSERT INTO data.hmmacm(mcm_blngn, mcm_tkhpl, mcm_bulan, mcm_kkrja, mcm_statf, mcm_tkhtk) ";
        $query .= "VALUES(:mcm_blngn, :mcm_tkhpl, :mcm_bulan, :mcm_kkrja, :mcm_statf, :mcm_tkhtk)";
        $database->prepare($query);
        $database->bindValue(":mcm_blngn", $val["mcm_blngn"]);
        $database->bindValue(":mcm_tkhpl", $this->datetimeToDate($val["mcm_tkhpl"]));
        $database->bindValue(":mcm_bulan", $val["mcm_bulan"]);
        $database->bindValue(":mcm_kkrja", $val["mcm_kkrja"]);
        $database->bindValue(":mcm_statf", $val["mcm_statf"]);
        $database->bindValue(":mcm_tkhtk", $this->datetimeToDate($val["mcm_tkhtk"]));
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function reloadLocation()
  {
    $database = Database::openConnection();
    $dboracle = new Oracle();

    $sql = "SELECT mkm_mkkod, mkm_mnama, kws_kwkod, kws_knama, jln_jlkod, jln_jnama, jln_poskd, jln_negri, pos_pskod FROM data.mkwjln";
    $database->prepare($sql);
    $database->execute();
    $posts = $database->fetchAllAssociative();

    $query = "SELECT mkm_mkkod, mkm_mnama, kws_kwkod, kws_knama, jln_jlkod, jln_jnama, jln_poskd, jln_negri, pos_pskod FROM SPMC.V_MKWJLN";
    $dboracle->prepare($query);
    $dboracle->execute();
    $rows = $dboracle->fetchAllAssociative();

    foreach ($rows as $val) {
      if (!in_array(["mkm_mkkod" => $val["mkm_mkkod"], "kws_kwkod" => $val["kws_kwkod"], "jln_jlkod" => $val["jln_jlkod"], "jln_jnama" => $val["jln_jnama"], "jln_poskd" => $val["jln_poskd"]], $posts, true)) {
        $query = "INSERT INTO data.mkwjln(mkm_mkkod, mkm_mnama, kws_kwkod, kws_knama, jln_jlkod, jln_jnama, jln_poskd, jln_negri, pos_pskod) ";
        $query .= "VALUES(:mkm_mkkod, :mkm_mnama, :kws_kwkod, :kws_knama, :jln_jlkod, :jln_jnama, :jln_poskd, :jln_negri, :pos_pskod)";
        $database->prepare($query);
        $database->bindValue(":mkm_mkkod", $val["mkm_mkkod"]);
        $database->bindValue(":mkm_mnama", $val["mkm_mnama"]);
        $database->bindValue(":kws_kwkod", $val["kws_kwkod"]);
        $database->bindValue(":kws_knama", $val["kws_knama"]);
        $database->bindValue(":jln_jlkod", $val["jln_jlkod"]);
        $database->bindValue(":jln_jnama", $val["jln_jnama"]);
        $database->bindValue(":jln_poskd", $val["jln_poskd"]);
        $database->bindValue(":jln_negri", $val["jln_negri"]);
        $database->bindValue(":pos_pskod", $val["pos_pskod"]);
        $database->execute();
      } else {
        return false;
      }
    }

    return true;
  }

  public function landusetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(tnh_thkod AS TEXT) = '" . $searchValue . "' OR tnh_tnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.htanah h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.htanah ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.htanah ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["tnh_thkod"] = $val["tnh_thkod"];
      $rowOutput["tnh_tnama"] = $val["tnh_tnama"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function landpropertytable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(hrt_htkod AS TEXT) = '" . $searchValue . "' OR hrt_hnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hharta h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hharta ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hharta ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["hrt_htkod"] = $val["hrt_htkod"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function ownertypetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(jpk_jpkod AS TEXT) = '" . $searchValue . "' OR jpk_itkod = '" . $searchValue . "' OR jpk_jnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hjenpk h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hjenpk ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hjenpk ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["jpk_jpkod"] = $val["jpk_jpkod"];
      $rowOutput["jpk_itkod"] = $val["jpk_itkod"];
      $rowOutput["jpk_jnama"] = $val["jpk_jnama"];
      $rowOutput["jpk_stcbk"] = $val["jpk_stcbk"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function buildingtypestable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(bgn_bgkod AS TEXT) = '" . $searchValue . "' OR bgn_bnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hbangn h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hbangn ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hbangn ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["bgn_bgkod"] = $val["bgn_bgkod"];
      $rowOutput["bgn_bnama"] = $val["bgn_bnama"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function buildingstructuretable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(stb_stkod AS TEXT) = '" . $searchValue . "' OR stb_snama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hstbgn h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hstbgn ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hstbgn ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["stb_stkod"] = $val["stb_stkod"];
      $rowOutput["stb_snama"] = $val["stb_snama"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function messagetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(acm_sbkod AS TEXT) = '" . $searchValue . "' OR acm_sbktr LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hmjacm h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hmjacm ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hmjacm ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["acm_sbkod"] = $val["acm_sbkod"];
      $rowOutput["acm_sbktr"] = $val["acm_sbktr"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function meetingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(mcm_blngn AS TEXT) = '" . $searchValue . "%' OR CAST(mcm_tkhpl AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(mcm_tkhtk AS TEXT) LIKE '%" . $searchValue . "%' OR CAST(mcm_kkrja AS TEXT) LIKE '" . $searchValue . "%' OR CAST(mcm_statf AS TEXT)LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hmmacm h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hmmacm ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hmmacm ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["mcm_blngn"] = $val["mcm_blngn"];
      $rowOutput["mcm_tkhpl"] = $this->dateFormat((int)$val["mcm_tkhpl"]);
      $rowOutput["mcm_bulan"] = $this->convertMonth($val["mcm_bulan"]);
      $rowOutput["mcm_kkrja"] = $val["mcm_kkrja"];
      $rowOutput["mcm_statf"] = $this->kodStatus($val["mcm_statf"]);
      $rowOutput["mcm_tkhtk"] = $this->dateFormat((int)$val["mcm_tkhtk"]);
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function annualratetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "kws_knama LIKE '%" . $searchValue . "%' OR hrt_hnama LIKE '%" . $searchValue . "%' OR CAST(kaw_kadar AS TEXT) = '" . $searchValue . "'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hkadar h ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hkadar ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hkadar ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["kws_knama"] = $val["kws_knama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      $rowOutput["kaw_kadar"] = $val["kaw_kadar"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function locationtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery =
        "CAST(t.mkm_mkkod AS TEXT) = '" .
        $searchValue .
        "' OR CAST(t.kws_kwkod AS TEXT) = '" .
        $searchValue .
        "'  OR CAST(t.jln_jlkod AS TEXT) = '" .
        $searchValue .
        "' OR t.mkm_mnama LIKE '%" .
        $searchValue .
        "%' OR t.kws_knama LIKE '%" .
        $searchValue .
        "%' OR t.jln_jnama LIKE '%" .
        $searchValue .
        "%' OR CAST(t.jln_poskd AS TEXT) LIKE '%" .
        $searchValue .
        "%' OR t.jln_negri LIKE '%" .
        $searchValue .
        "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.mkwjln t ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.mkwjln t ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT distinct * FROM data.mkwjln t ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["mkm_mkkod"] = $val["mkm_mkkod"];
      $rowOutput["mkm_mnama"] = $val["mkm_mnama"];
      $rowOutput["kws_kwkod"] = $val["kws_kwkod"];
      $rowOutput["kws_knama"] = $val["kws_knama"];
      $rowOutput["jln_jlkod"] = $val["jln_jlkod"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["jln_poskd"] = $val["jln_poskd"];
      $rowOutput["jln_negri"] = $val["jln_negri"];
      $rowOutput["pos_pskod"] = $val["pos_pskod"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }

  public function reviewratetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "t.kws_knama LIKE '%" . $searchValue . "%' OR t.hrt_hnama LIKE '%" . $searchValue . "%' OR CAST(h.kaw_kadar AS TEXT) = '" . $searchValue . "'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.kadar_nilai t ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.kadar_nilai t ";
    $sql .= "LEFT JOIN data.hkadar h ON t.kws_kwkod = h.kws_kwkod AND t.hrt_htkod = h.hrt_htkod ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT t.kws_kwkod, t.kws_knama, t.hrt_htkod, t.hrt_hnama, t.kadar_nilai, h.kaw_kadar FROM data.kadar_nilai t ";
    $query .= "LEFT JOIN data.hkadar h ON t.kws_kwkod = h.kws_kwkod AND t.hrt_htkod = h.hrt_htkod ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($rows as $val) {
      $rowOutput["kws_kwkod"] = $val["kws_kwkod"];
      $rowOutput["kws_knama"] = $val["kws_knama"];
      $rowOutput["hrt_htkod"] = $val["hrt_htkod"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      $rowOutput["kadar_nilai"] = $val["kadar_nilai"];
      $rowOutput["kaw_kadar"] = $val["kaw_kadar"];
      array_push($output, $rowOutput);
    }

    ## Response
    $response = [
      "draw" => intval($draw),
      "iTotalRecords" => $totalRecords,
      "iTotalDisplayRecords" => $totalRecordwithFilter,
      "aaData" => $output,
    ];

    return $response;
  }
  public function updateReviewRate($kwsKwkod, $hrtHtkod, $newRate)
  {
    $database = Database::openConnection();

    $query = "UPDATE data.kadar_nilai SET kadar_nilai = :kadar_nilai WHERE kws_kwkod = :kws_kwkod AND hrt_htkod = :hrtHtkod";
    $database->prepare($query);
    $database->bindValue(":kadar_nilai", $newRate);
    $database->bindValue(":kws_kwkod", $kwsKwkod);
    $database->bindValue(":hrtHtkod", $hrtHtkod);
    $result = $database->execute();

    return true;
  }
}