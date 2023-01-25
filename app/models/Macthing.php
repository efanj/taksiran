<?php

class Macthing extends Model
{
  public function escapeJsonString($value)
  {
    # list from www.json.org: (\b backspace, \f formfeed)
    $escapers = ["\\", "'", "/", "\"", "\n", "\r", "\t", "\x08", "\x0c"];
    $replacements = ["\\\\", "\\", "\\/", "\\\"", "\\n", "\\r", "\\t", "\\f", "\\b"];
    $result = str_replace($escapers, $replacements, $value);
    return $result;
  }

  public function checkNull($data)
  {
    if ($data == null) {
      return "-";
    } else {
      return $data;
    }
  }

  public function macthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery =
        "CAST(peg_akaun AS TEXT) = '" .
        $searchValue .
        "%' OR pmk_nmbil LIKE '%" .
        $searchValue .
        "%' OR adpg1 LIKE '%" .
        $searchValue .
        "%' OR adpg2 LIKE '%" .
        $searchValue .
        "%' OR adpg3 LIKE '%" .
        $searchValue .
        "%' OR adpg4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt1 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt2 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt3 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt5 LIKE '%" .
        $searchValue .
        "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    } else {
      $sql .= " WHERE peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hvnduk h ";
    if ($searchValue != "") {
      $query .= " WHERE " . $searchQuery . " AND peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
    } else {
      $query .= " WHERE peg_codex is null AND peg_codey is null AND peg_statf != 'H'";
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
      $rowOutput["id"] = Encryption::encryptId($val["peg_akaun"]);
      $rowOutput["peg_akaun"] = $val["peg_akaun"];
      $rowOutput["peg_nompt"] = $val["peg_nompt"];
      $rowOutput["pmk_nmbil"] = $val["pmk_nmbil"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["jln_knama"] = $val["jln_knama"];
      $rowOutput["jpk_jnama"] = $val["jpk_jnama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];

      $rowOutput["adpg1"] = $val["adpg1"];
      $rowOutput["adpg2"] = $val["adpg2"];
      $rowOutput["adpg3"] = $val["adpg3"];
      $rowOutput["adpg4"] = $val["adpg4"];
      $rowOutput["pvd_almt1"] = $val["pvd_almt1"];
      $rowOutput["pvd_almt2"] = $val["pvd_almt2"];
      $rowOutput["pvd_almt3"] = $val["pvd_almt3"];
      $rowOutput["pvd_almt4"] = $val["pvd_almt4"];
      $rowOutput["pvd_almt5"] = $val["pvd_almt5"];
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
  }

  public function remacthingtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery =
        "CAST(peg_akaun AS TEXT) = '" .
        $searchValue .
        "%' OR pmk_nmbil LIKE '%" .
        $searchValue .
        "%' OR adpg1 LIKE '%" .
        $searchValue .
        "%' OR adpg2 LIKE '%" .
        $searchValue .
        "%' OR adpg3 LIKE '%" .
        $searchValue .
        "%' OR adpg4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt1 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt2 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt3 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt4 LIKE '%" .
        $searchValue .
        "%' OR pvd_almt5 LIKE '%" .
        $searchValue .
        "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.hvnduk h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is not null AND peg_codey is not null";
    } else {
      $sql .= " WHERE peg_codex is not null AND peg_codey is not null";
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT * FROM data.hvnduk h ";
    if ($searchValue != "") {
      $sql .= " WHERE " . $searchQuery . " AND peg_codex is not null AND peg_codey is not null";
    } else {
      $sql .= " WHERE peg_codex is not null AND peg_codey is not null";
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
      $rowOutput["id"] = Encryption::encryptId($val["peg_akaun"]);
      $rowOutput["peg_akaun"] = $val["peg_akaun"];
      $rowOutput["peg_nompt"] = $val["peg_nompt"];
      $rowOutput["pmk_nmbil"] = $val["pmk_nmbil"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["jln_knama"] = $val["jln_knama"];
      $rowOutput["jpk_jnama"] = $val["jpk_jnama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];

      $rowOutput["adpg1"] = $val["adpg1"];
      $rowOutput["adpg2"] = $val["adpg2"];
      $rowOutput["adpg3"] = $val["adpg3"];
      $rowOutput["adpg4"] = $val["adpg4"];
      $rowOutput["pvd_almt1"] = $val["pvd_almt1"];
      $rowOutput["pvd_almt2"] = $val["pvd_almt2"];
      $rowOutput["pvd_almt3"] = $val["pvd_almt3"];
      $rowOutput["pvd_almt4"] = $val["pvd_almt4"];
      $rowOutput["pvd_almt5"] = $val["pvd_almt5"];
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
  }

  public function getAccountInfo($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT s.*, h.tnh_tnama, b.bgn_bnama, st.stb_snama FROM data.hvnduk s ";
    $query .= "LEFT JOIN data.htanah h ON s.peg_thkod = h.tnh_thkod ";
    $query .= "LEFT JOIN data.hbangn b ON s.peg_bgkod = b.bgn_bgkod ";
    $query .= "LEFT JOIN data.hstbgn st ON s.peg_stkod = st.stb_stkod ";
    $query .= "WHERE s.peg_akaun = :akaun ";
    $database->prepare($query);
    $database->bindValue(":akaun", Encryption::decryptId($fileId));
    $database->execute();

    $info = $database->fetchAssociative();
    return $info;
  }
}

?>