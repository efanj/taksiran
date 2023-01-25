<?php

class Elements extends Model
{
  public function dateFormat($date)
  {
    if($date == null){
      $date = "-";
    }else{
      $date = date("d/m/Y", strtotime($date));
    }
    return $date;
  }
  
  public function referencetable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "CAST(f.noakaun AS TEXT) = '" . $searchValue . "' OR h.adpg1 LIKE '%" . $searchValue . "%' OR h.adpg2 LIKE '%" . $searchValue . "%' OR h.adpg3 LIKE '%" . $searchValue . "%' OR h.adpg4 LIKE '%" . $searchValue . "%' OR h2.bgn_bnama = '" . $searchValue . "'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.reff f ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.reff f ";
    $sql .= "LEFT JOIN data.hvnduk h on f.noakaun = h.peg_akaun ";
    $sql .= "INNER JOIN data.hbangn h2 on h.peg_jpkod = h2.bgn_bgkod ";
    if ($searchValue != "") {
      $sql .= "WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT f.*, h.adpg1, h.adpg2, h.adpg3, h.adpg4, h2.bgn_bnama FROM data.reff f ";
    $query .= "LEFT JOIN data.hvnduk h on f.noakaun = h.peg_akaun ";
    $query .= "INNER JOIN data.hbangn h2 on h.peg_jpkod = h2.bgn_bgkod ";
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
      $rowOutput["id"] = $val["id"];
      $rowOutput["noakaun"] = $val["noakaun"];
      $rowOutput["nolot"] = $val["nolot"];
      $rowOutput["keluasan"] = $val["keluasan"];
      $rowOutput["hargasmp"] = $val["hargasmp"];
      $rowOutput["nilaitahunan"] = $val["nilaitahunan"];
      $rowOutput["adpg1"] = $val["adpg1"];
      $rowOutput["adpg2"] = $val["adpg2"];
      $rowOutput["adpg3"] = $val["adpg3"];
      $rowOutput["adpg4"] = $val["adpg4"];
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

  public function accounttable()
  {
    $database = Database::openConnection();

    $query = "SELECT peg_akaun, pmk_nmbil, peg_htkod, hrt_hnama, jln_jlkod, jln_kwkod, jln_knama, jln_jnama ";
    $query .= "FROM data.hvnduk ";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    return $info;
  }

  public function meetingtable()
  {
    $database = Database::openConnection();

    $query = "SELECT mcm_blngn, mcm_tkhpl, mcm_kkrja, mcm_statf, mcm_tkhtk, mcm_bulan, ";
    $query .= "CASE mcm_bulan ";
    $query .= "WHEN '01' THEN 'JANUARI' WHEN '02' THEN 'FEBRUARI' WHEN '03' THEN 'MAC' WHEN '04' THEN 'APRIL' WHEN '05' THEN 'MEI' WHEN '06' THEN 'JUN' ";
    $query .= "WHEN '07' THEN 'JULAI' WHEN '08' THEN 'OGOS' WHEN '09' THEN 'SEPTEMBER' WHEN '10' THEN 'OKTOBER' WHEN '11' THEN 'NOVEMBER' WHEN '12' THEN 'DECEMBER' ";
    $query .= "END eld3 ";
    $query .= "FROM data.hmmacm ";
    $query .= "ORDER by mcm_blngn DESC";
    // $query .= "WHERE date_part('year', mcm_tkhpl) = date_part('year', CURRENT_DATE)";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($info as $val) {
      $rowOutput["mcm_blngn"] = $val["mcm_blngn"];
      $rowOutput["mcm_tkhpl"] = $this->dateFormat((int)$val["mcm_tkhpl"]);
      $rowOutput["mcm_tkhtk"] = $this->dateFormat((int)$val["mcm_tkhtk"]);
      $rowOutput["mcm_kkrja"] = $val["mcm_kkrja"];
      $rowOutput["mcm_statf"] = $val["mcm_statf"];
      $rowOutput["mcm_bulan"] = $val["mcm_bulan"];
      $rowOutput["eld3"] = $val["eld3"];
      array_push($output, $rowOutput);
    }
    return $output;
  }

  public function streettable()
  {
    $database = Database::openConnection();

    $query = "SELECT jln_jlkod, kws_kwkod, kws_knama, jln_jnama, jln_poskd ";
    $query .= "FROM data.mkwjln ";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    return $info;
  }

  public function reasontable()
  {
    $database = Database::openConnection();

    $query = "SELECT * FROM data.hmjacm ";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    return $info;
  }

  // public function customertable()
  // {
  //   $database = Database::openConnection();
  //   // $dbOracle = new Oracle();
  //   $query = "SELECT distinct pid_plgid, pid_pnama, pid_jenpg, val_amtid, val_almt1, val_almt2, val_almt3, val_almt4, val_almt5, val_poskd FROM data.plngan ";
  //   $database->prepare($query);
  //   $database->execute();

  //   $row = $database->fetchAllAssociative();
  //   $output = [];
  //   $rowOutput = [];
  //   foreach ($row as $val) {
  //     $rowOutput["pid_plgid"] = $val["pid_plgid"];
  //     $rowOutput["pid_pnama"] = $val["pid_pnama"];
  //     $rowOutput["pid_jenpg"] = $val["pid_jenpg"];
  //     $rowOutput["val_almt1"] = $val["val_almt1"];
  //     $rowOutput["val_almt2"] = $val["val_almt2"];
  //     $rowOutput["val_almt3"] = $val["val_almt3"];
  //     $rowOutput["val_almt4"] = $val["val_almt4"];
  //     $rowOutput["val_almt5"] = $val["val_almt5"];
  //     $rowOutput["role"] = Session::getUserRole();
  //     array_push($output, $rowOutput);
  //   }

  //   return $output;

  //   // $dbOracle->closeOciConnection();
  // }

  public function customertable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();
    // $dbOracle = new Oracle();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "pid_plgid LIKE '%" . $searchValue . "%' OR pid_pnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.plngan ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.plngan ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery;
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT distinct pid_plgid, pid_pnama, pid_jenpg, val_amtid, val_almt1, val_almt2, val_almt3, val_almt4, val_almt5, val_poskd FROM data.plngan ";
    if ($searchValue != "") {
      $query .= "WHERE " . $searchQuery;
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $rowOutput["pid_plgid"] = $val["pid_plgid"];
      $rowOutput["pid_pnama"] = $val["pid_pnama"];
      $rowOutput["pid_jenpg"] = $val["pid_jenpg"];
      $rowOutput["val_almt1"] = $val["val_almt1"];
      $rowOutput["val_almt2"] = $val["val_almt2"];
      $rowOutput["val_almt3"] = $val["val_almt3"];
      $rowOutput["val_almt4"] = $val["val_almt4"];
      $rowOutput["val_almt5"] = $val["val_almt5"];
      $rowOutput["role"] = Session::getUserRole();
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

    // $dbOracle->closeOciConnection();
  }

  public function customeraddtable($plgid)
  {
    $database = Database::openConnection();
    // $dbOracle = new Oracle();
    $query = "SELECT distinct pid_plgid, pid_pnama, pid_jenpg, val_amtid, val_almt1, val_almt2, val_almt3, val_almt4, val_almt5, val_poskd FROM data.plngan ";
    $query .= "WHERE pid_plgid = '" . $plgid . "'";
    $database->prepare($query);
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $rowOutput["pid_plgid"] = $val["pid_plgid"];
      $rowOutput["pid_pnama"] = $val["pid_pnama"];
      $rowOutput["pid_jenpg"] = $val["pid_jenpg"];
      $rowOutput["val_amtid"] = $val["val_amtid"];
      $rowOutput["val_almt1"] = $val["val_almt1"];
      $rowOutput["val_almt2"] = $val["val_almt2"];
      $rowOutput["val_almt3"] = $val["val_almt3"];
      $rowOutput["val_almt4"] = $val["val_almt4"];
      $rowOutput["val_almt5"] = $val["val_almt5"];
      $rowOutput["val_poskd"] = $val["val_poskd"];
      $rowOutput["role"] = Session::getUserRole();
      array_push($output, $rowOutput);
    }

    return ["data" => $output];

    // $dbOracle->closeOciConnection();
  }

  public function htanah()
  {
    $database = Database::openConnection();

    $query = "SELECT * FROM data.htanah";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    return $info;
  }

  public function hbangn()
  {
    $database = Database::openConnection();

    $query = "SELECT * FROM data.hbangn";

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
    return $output;
  }

  public function hharta()
  {
    $database = Database::openConnection();

    $query = "SELECT * FROM data.hharta ORDER BY hrt_htkod";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    return $info;
  }

  public function hstbgn()
  {
    $database = Database::openConnection();

    $query = "SELECT * FROM data.hstbgn";

    $database->prepare($query);
    $database->execute();

    $info = $database->fetchAllAssociative();
    return $info;
  }

  public function hjenpk()
  {
    $database = Database::openConnection();
    // $query = "SELECT * FROM data.hjenpk WHERE jpk_stcbk = 'T'";
    $query = "SELECT * FROM data.hjenpk";
    $database->prepare($query);
    $database->execute();
    $info = $database->fetchAllAssociative();
    return $info;
  }

  public function area()
  {
    $database = Database::openConnection();
    $query = "SELECT kws_kwkod, kws_knama FROM data.mkwjln ";
    $query .= "GROUP BY kws_kwkod, kws_knama ";
    $query .= "ORDER BY kws_kwkod ASC";
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();

    return $rows;
  }

  public function street($area)
  {
    $database = Database::openConnection();
    $query = "SELECT jln_jlkod, jln_jnama FROM data.mkwjln WHERE kws_kwkod ='" . $area . "'";
    $database->prepare($query);
    $database->execute();

    $rows = $database->fetchAllAssociative();

    return $rows;
  }
}

?>