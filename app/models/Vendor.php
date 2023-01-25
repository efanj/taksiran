<?php

class Vendor extends Model
{
  public function rentbenchmarktable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "h.hrt_hnama LIKE '%" . $searchValue . "%' OR h2.bgn_bnama LIKE '%" . $searchValue . "%' OR f.nmbil LIKE '%" . $searchValue . "%' OR m.jln_jnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.benchmark f ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.benchmark f ";
    $sql .= "LEFT JOIN data.hharta h on f.htkod = h.hrt_htkod ";
    $sql .= "LEFT JOIN data.hbangn h2 on f.bgkod = h2.bgn_bgkod ";
    $sql .= "LEFT JOIN data.mkwjln m on f.jlkod = m.jln_jlkod ";
    if ($searchValue != "") {
      $sql .= "WHERE f.parent = 0 AND f.jenis = 1 AND " . $searchQuery;
    } else {
      $sql .= "WHERE f.parent = 0 AND f.jenis = 1";
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT f.*, m.jln_jnama, m.kws_knama, h.hrt_hnama, h2.bgn_bnama FROM data.benchmark f ";
    $query .= "LEFT JOIN data.hharta h on f.htkod = h.hrt_htkod ";
    $query .= "LEFT JOIN data.hbangn h2 on f.bgkod = h2.bgn_bgkod ";
    $query .= "LEFT JOIN data.mkwjln m on f.jlkod = m.jln_jlkod ";
    if ($searchValue != "") {
      $query .= "WHERE f.parent = 0 AND f.jenis = 1 AND " . $searchQuery;
    } else {
      $query .= "WHERE f.parent = 0 AND f.jenis = 1";
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
      $rowOutput["id"] = Encryption::encryptId($val["id"]);
      $rowOutput["akaun"] = $val["akaun"];
      $rowOutput["jenis"] = $val["jenis"];
      $rowOutput["jlkod"] = $val["jlkod"];
      $rowOutput["kwkod"] = $val["kwkod"];
      $rowOutput["htkod"] = $val["htkod"];
      $rowOutput["bgkod"] = $val["bgkod"];
      $rowOutput["nmbil"] = $val["nmbil"];
      $rowOutput["nota"] = $val["nota"];
      $rowOutput["nilai"] = $val["nilai"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["kws_knama"] = $val["kws_knama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      $rowOutput["bgn_bnama"] = $val["bgn_bnama"];
      if ($val["bgside"] == 1) {
        $rowOutput["bgside"] = "MFA";
      } elseif ($val["bgside"] == 2) {
        $rowOutput["bgside"] = "AFA";
      }
      $rowOutput["childs"] = $this->getChildsBenchMark($val["id"]);
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

  public function costbenchmarktable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $searchValue)
  {
    $database = Database::openConnection();

    $searchQuery = "";
    if ($searchValue != "") {
      $searchQuery = "h.hrt_hnama LIKE '%" . $searchValue . "%' OR h2.bgn_bnama LIKE '%" . $searchValue . "%' OR f.nmbil LIKE '%" . $searchValue . "%' OR m.jln_jnama LIKE '%" . $searchValue . "%'";
    }

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.benchmark f ";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.benchmark f ";
    $sql .= "LEFT JOIN data.hharta h on f.htkod = h.hrt_htkod ";
    $sql .= "LEFT JOIN data.hbangn h2 on f.bgkod = h2.bgn_bgkod ";
    $sql .= "LEFT JOIN data.mkwjln m on f.jlkod = m.jln_jlkod ";
    if ($searchValue != "") {
      $sql .= "WHERE f.parent = 0 AND f.jenis = 2 AND " . $searchQuery;
    } else {
      $sql .= "WHERE f.parent = 0 AND f.jenis = 2";
    }
    $sel = $database->prepare($sql);
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT f.*, m.jln_jnama, m.kws_knama, h.hrt_hnama, h2.bgn_bnama FROM data.benchmark f ";
    $query .= "LEFT JOIN data.hharta h on f.htkod = h.hrt_htkod ";
    $query .= "LEFT JOIN data.hbangn h2 on f.bgkod = h2.bgn_bgkod ";
    $query .= "LEFT JOIN data.mkwjln m on f.jlkod = m.jln_jlkod ";
    if ($searchValue != "") {
      $query .= "WHERE f.parent = 0 AND f.jenis = 2 AND " . $searchQuery;
    } else {
      $query .= "WHERE f.parent = 0 AND f.jenis = 2";
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
      $rowOutput["id"] = Encryption::encryptId($val["id"]);
      $rowOutput["akaun"] = $val["akaun"];
      $rowOutput["jenis"] = $val["jenis"];
      $rowOutput["jlkod"] = $val["jlkod"];
      $rowOutput["kwkod"] = $val["kwkod"];
      $rowOutput["htkod"] = $val["htkod"];
      $rowOutput["bgkod"] = $val["bgkod"];
      $rowOutput["nmbil"] = $val["nmbil"];
      $rowOutput["nota"] = $val["nota"];
      $rowOutput["nilai"] = $val["nilai"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["kws_knama"] = $val["kws_knama"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      $rowOutput["bgn_bnama"] = $val["bgn_bnama"];
      if ($val["bgside"] == 1) {
        $rowOutput["bgside"] = "MFA";
      } elseif ($val["bgside"] == 2) {
        $rowOutput["bgside"] = "AFA";
      }
      $rowOutput["childs"] = $this->getChildsBenchMark($val["id"]);
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

  public function sitereviewtable($draw, $row, $rowperpage, $columnIndex, $columnName, $columnSortOrder, $area = "", $street = "")
  {
    $database = Database::openConnection();

    ## Total number of records without filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_semak s";
    $sel = $database->prepare($sql);
    $database->execute($sel);
    $records = $database->fetchAssociative();
    $totalRecords = $records["allcount"];

    ## Total number of record with filtering
    $sql = "SELECT count(*) AS allcount FROM data.v_semak s ";
    $sql .= "LEFT JOIN public.users u ON s.smk_onama = u.workerid ";
    if ($area != "" && $street != "") {
      $sql .= "WHERE s.jln_kwkod = :kwkod AND s.jln_jlkod = :jlkod";
    }
    $sel = $database->prepare($sql);
    if ($area != "" && $street != "") {
      $database->bindValue(":kwkod", $area);
      $database->bindValue(":jlkod", $street);
    }
    $database->execute($sel);

    $records = $database->fetchAssociative();
    $totalRecordwithFilter = $records["allcount"];

    ## Fetch records
    $query = "SELECT s.*, u.workerid, u.name FROM data.v_semak s ";
    $query .= "LEFT JOIN public.users u ON s.smk_onama = u.workerid ";
    if ($area != "" && $street != "") {
      $query .= "WHERE s.jln_kwkod = :kwkod AND s.jln_jlkod = :jlkod";
    }
    if ($columnName != "") {
      $query .= " ORDER BY " . $columnName . " " . $columnSortOrder;
    }
    $query .= " LIMIT " . $rowperpage . " OFFSET " . $row;
    $database->prepare($query);
    if ($area != "" && $street != "") {
      $database->bindValue(":kwkod", $area);
      $database->bindValue(":jlkod", $street);
    }
    $database->execute();

    $row = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($row as $val) {
      $rowOutput["id"] = Encryption::encryptId($val["id"]);
      $rowOutput["akaun"] = Encryption::encryptId($val["smk_akaun"]);
      $rowOutput["smk_akaun"] = $val["smk_akaun"];
      $rowOutput["smk_nolot"] = $val["smk_nolot"];
      $rowOutput["smk_adpg1"] = $val["smk_adpg1"];
      $rowOutput["smk_adpg2"] = $val["smk_adpg2"];
      $rowOutput["smk_lsbgn"] = $val["smk_lsbgn"];
      $rowOutput["smk_lstnh"] = $val["smk_lstnh"];
      $rowOutput["smk_lsans"] = $val["smk_lsans"];
      $rowOutput["smk_lsbgn_tmbh"] = $val["smk_lsbgn_tmbh"];
      $rowOutput["smk_lsans_tmbh"] = $val["smk_lsans_tmbh"];
      $rowOutput["smk_codex"] = $val["smk_codex"];
      $rowOutput["smk_codey"] = $val["smk_codey"];
      $rowOutput["smk_type"] = $val["smk_type"];
      $rowOutput["hadapan"] = $val["hadapan"];
      $rowOutput["belakang"] = $val["belakang"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      $rowOutput["jln_jnama"] = $val["jln_jnama"];
      $rowOutput["smk_datevisit"] = date("d/m/Y H:i:s", strtotime($val["smk_datevisit"]));
      $rowOutput["workerid"] = $val["workerid"];
      $rowOutput["name"] = $val["name"];
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

  public function getAllImgs($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT * FROM data.files ";
    $query .= "WHERE no_akaun = :no_akaun ";
    $query .= "ORDER BY files.date DESC ";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $fileId);
    $database->execute();
    $files = $database->fetchAllAssociative();

    return $files;
  }

  public function getBenchMarkInfo($id)
  {
    $database = Database::openConnection();
    $query = "SELECT f.*, d.document as doc_name FROM data.bdocs f ";
    $query .= "LEFT JOIN data.doctype d ON f.file_type = d.id ";
    $query .= "WHERE f.benchid = :id";

    $database->prepare($query);
    $database->bindValue(":id", $id);
    $database->execute();
    $rows = $database->fetchAllAssociative();

    return $rows;
  }

  public function getAllDocs($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT f.*, d.document as doc_name FROM data.fdocs f ";
    $query .= "LEFT JOIN data.doctype d ON f.file_type = d.id ";
    $query .= "WHERE f.no_akaun = :no_akaun";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $fileId);
    $database->execute();
    $files = $database->fetchAllAssociative();

    return $files;
  }

  public function insertrentbenchmark($userId, $ratetype, $akaun, $jlkod, $kwkod, $owner, $htkod, $items_rent)
  {
    $ratetype = empty($ratetype) ? 0 : $ratetype;
    $jlkod = empty($jlkod) ? 0 : $jlkod;
    $kwkod = empty($kwkod) ? 0 : $kwkod;
    $htkod = empty($htkod) ? 0 : $htkod;
    $akaun = empty($akaun) ? null : $akaun;
    $owner = empty($owner) ? null : $owner;

    $database = Database::openConnection();

    $first_item = array_shift($items_rent);

    $first_item_rentnote = empty($first_item["rentnote"]) ? null : $first_item["rentnote"];

    $query = "INSERT INTO data.benchmark(parent, akaun, jenis, jlkod, kwkod, nmbil, htkod, bgkod, bgside, nilai, nota) ";
    $query .= "values (0," . $akaun  . "," . $ratetype . "," . $jlkod . "," . $kwkod . ",'" . $owner . "'," . $htkod . "," . $first_item["bgtype"] . ",'" . $first_item["bgside"] . "'," . $first_item["rentprice"] . ",'" . $first_item_rentnote . "')";
    $database->prepare($query);
    $database->execute();
    $id = $database->lastInsertedId();

    foreach ($items_rent as $val) {
      $item_rentnote = empty($val["rentnote"]) ? null : $val["rentnote"];
      $query = "INSERT INTO data.benchmark(parent, akaun, jenis, jlkod, kwkod, nmbil, htkod, bgkod, bgside, nilai, nota) ";
      $query .= "values (" . $id . "," . $akaun  . "," . $ratetype . "," . $jlkod . "," . $kwkod . ",'" . $owner . "'," . $htkod . "," . $val["bgtype"] . ",'" . $val["bgside"] . "'," . $val["rentprice"] . ",'" . $item_rentnote . "')";
      $database->prepare($query);
      $database->execute();
    }

    return ["success" => true];
  }

  public function insertcostbenchmark($userId, $ratetype, $akaun, $jlkod, $kwkod, $owner, $htkod, $items_cost)
  {
    $ratetype = empty($ratetype) ? 0 : $ratetype;
    $jlkod = empty($jlkod) ? 0 : $jlkod;
    $kwkod = empty($kwkod) ? 0 : $kwkod;
    $htkod = empty($htkod) ? 0 : $htkod;
    $akaun = empty($akaun) ? null : $akaun;
    $owner = empty($owner) ? null : $owner;

    $database = Database::openConnection();

    $first_item = array_shift($items_cost);
    $first_item_costnote = empty($first_item["costnote"]) ? null : $first_item["costnote"];

    $query = "INSERT INTO data.benchmark(parent, akaun, jenis, jlkod, kwkod, nmbil, htkod, bgkod, bgside, nilai, nota) ";
    $query .= "values (0," . $akaun  . "," . $ratetype . "," . $jlkod . "," . $kwkod . ",'" . $owner . "'," . $htkod . "," . $first_item["bgtype"] . ",'" . $first_item["bgside"] . "'," . $first_item["costprice"] . ",'" . $first_item_costnote . "')";
    $database->prepare($query);
    $database->execute();
    $id = $database->lastInsertedId();

    foreach ($items_cost as $val) {
      $item_costnote = empty($val["costnote"]) ? null : $val["costnote"];
      $query = "INSERT INTO data.benchmark(parent, akaun, jenis, jlkod, kwkod, nmbil, htkod, bgkod, bgside, nilai, nota) ";
      $query .= "values (" . $id . "," . $akaun  . "," . $ratetype . "," . $jlkod . "," . $kwkod . ",'" . $owner . "'," . $htkod . "," . $val["bgtype"] . ",'" . $val["bgside"] . "'," . $val["costprice"] . ",'" . $item_costnote . "')";
      $database->prepare($query);
      $database->execute();
    }

    return ["success" => true];
  }

  public function uploadbenchmarkdocs($userId, $id, $file_type, $filename, $description, $fileData)
  {
    // upload
    $file = Uploader::uploadFile($fileData);

    if (!$file) {
      $this->errors = Uploader::errors();
      return false;
    }

    $database = Database::openConnection();

    $query = 'INSERT INTO data.bdocs (workerid, benchid, file_type, filename, hashed_filename, description, extension) VALUES (:workerid, :benchid, :file_type, :filename, :hashed_filename, :description, :extension)';

    $database->prepare($query);
    $database->bindValue(":workerid", $userId);
    $database->bindValue(":benchid", $id);
    $database->bindValue(":file_type", $file_type);
    $database->bindValue(":filename", $filename);
    $database->bindValue(":hashed_filename", $file["hashed_filename"]);
    $database->bindValue(":extension", $file["extension"]);
    $database->bindValue(":description", $description);
    $database->execute();

    // if insert failed, then delete the file
    if ($database->countRows() !== 1) {
      Uploader::deleteFile(IMAGES . "documents/" . $file["hashed_filename"]);
      throw new Exception("Couldn't upload file");
    }

    $id = $database->lastInsertedId();
    $file = $this->getDocsById("data.bdocs", $id);
    return $file;
  }

  public function uploadimages($userId, $no_akaun, $filename, $description, $fileData)
  {
    // upload
    $file = ImageResizer::resizeImage($fileData);

    $database = Database::openConnection();

    $query = "INSERT INTO data.files (no_akaun, workerid, filename, hashed_filename, description) VALUES (:no_akaun, :workerid, :filename, :hashed_filename, :description)";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $no_akaun);
    $database->bindValue(":workerid", $userId);
    $database->bindValue(":filename", $filename);
    $database->bindValue(":hashed_filename", $file["hashed_filename"]);
    $database->bindValue(":description", $description);
    $database->execute();

    // if insert failed, then delete the file
    if ($database->countRows() !== 1) {
      Uploader::deleteFile(IMAGES . "big-lightgallry/" . $file["hashed_filename"]);
      throw new Exception("Couldn't upload file");
    }

    $fileId = $database->lastInsertedId();
    $file = $this->getImagesById($fileId);
    return $file;
  }

  public function uploaddocuments($userId, $no_akaun, $file_type, $filename, $description, $fileData)
  {
    // upload
    $file = Uploader::uploadFile($fileData);

    if (!$file) {
      $this->errors = Uploader::errors();
      return false;
    }

    $database = Database::openConnection();

    $query = "INSERT INTO data.fdocs (workerid, no_akaun, file_type, filename, hashed_filename, description, extension) VALUES (:workerid, :no_akaun, :file_type, :filename, :hashed_filename, :description, :extension)";

    $database->prepare($query);
    $database->bindValue(":workerid", $userId);
    $database->bindValue(":no_akaun", $no_akaun);
    $database->bindValue(":file_type", $file_type);
    $database->bindValue(":filename", $filename);
    $database->bindValue(":hashed_filename", $file["hashed_filename"]);
    $database->bindValue(":extension", $file["extension"]);
    $database->bindValue(":description", $description);
    $database->execute();

    // if insert failed, then delete the file
    if ($database->countRows() !== 1) {
      Uploader::deleteFile(IMAGES . "documents/" . $file["hashed_filename"]);
      throw new Exception("Couldn't upload file");
    }

    $fileId = $database->lastInsertedId();
    $file = $this->getDocsById("data.fdocs", $fileId);
    return $file;
  }

  public function getChildsBenchMark($id)
  {
    $database = Database::openConnection();
    $query = "SELECT b.bgside, b.nilai, b.nota, h2.hrt_hnama, h.bgn_bnama FROM data.benchmark b ";
    $query .= "LEFT JOIN data.hbangn h on b.bgkod = h.bgn_bgkod ";
    $query .= "LEFT JOIN data.hharta h2 on b.htkod = h2.hrt_htkod ";
    $query .= "WHERE b.parent = :id ";

    $database->prepare($query);
    $database->bindValue(":id", (int) $id);
    $database->execute();

    $childs = $database->fetchAllAssociative();
    $output = [];
    $rowOutput = [];
    foreach ($childs as $val) {
      $rowOutput["nota"] = $val["nota"];
      $rowOutput["nilai"] = $val["nilai"];
      $rowOutput["hrt_hnama"] = $val["hrt_hnama"];
      $rowOutput["bgn_bnama"] = $val["bgn_bnama"];
      if ($val["bgside"] == 1) {
        $rowOutput["bgside"] = "MFA";
      } elseif ($val["bgside"] == 2) {
        $rowOutput["bgside"] = "AFA";
      }
      array_push($output, $rowOutput);
    }
    return $output;
  }

  public function getImagesById($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT f.*, u.name ";
    $query .= "FROM data.files f ";
    $query .= "LEFT JOIN public.users u ON f.workerid = u.id ";
    $query .= "WHERE f.id = :id LIMIT 1 ";

    $database->prepare($query);
    $database->bindValue(":id", (int) $fileId);
    $database->execute();

    $file = $database->fetchAllAssociative();
    return $file;
  }

  public function getDocsById($table, $fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT a.*, u.name ";
    $query .= "FROM " . $table . " a ";
    $query .= "LEFT JOIN public.users u ON a.workerid = u.id ";
    $query .= "WHERE a.id = :id LIMIT 1 ";

    $database->prepare($query);
    $database->bindValue(":id", (int) $fileId);
    $database->execute();

    $file = $database->fetchAllAssociative();
    return $file;
  }

  public function deletesitereview($userId, $fileId)
  {

    $database = Database::openConnection();

    // $database->getById("data.smktpk", $fileId);
    // $file = $database->fetchAssociative();

    $database->deleteByIdCustom("data.pindaan_raw", "id_smk", $fileId);
    $database->deleteById("data.smktpk", $fileId);

    if ($database->countRows() !== 1) {
      throw new Exception("Couldn't delete sitereview");
    }
  }

  public function deletebenchdocument($userId, $docId)
  {
    $database = Database::openConnection();

    $database->getById("data.bdocs", $docId);
    $file = $database->fetchAssociative();

    // start a transaction to guarantee the file will be deleted from both; database and filesystem
    $database->beginTransaction();
    $database->deleteById("data.bdocs", $docId);

    if ($database->countRows() !== 1) {
      $database->rollBack();
      throw new Exception("Couldn't delete file");
    }

    $basename = $file["hashed_filename"] . "." . $file["extension"];
    Uploader::deleteFile(IMAGES . "documents/" . $basename);

    $database->commit();

    // $log = $this->logActivity($userId, "delete image");
  }

  public function deleteimage($userId, $imageId)
  {
    $database = Database::openConnection();

    $database->getById("data.files", $imageId);
    $file = $database->fetchAssociative();

    // start a transaction to guarantee the file will be deleted from both; database and filesystem
    $database->beginTransaction();
    $database->deleteById("data.files", $imageId);

    if ($database->countRows() !== 1) {
      $database->rollBack();
      throw new Exception("Couldn't delete file");
    }

    $basename = $file["hashed_filename"];
    Uploader::deleteFile(IMAGES . "big-lightgallry/" . $basename);
    Uploader::deleteFile(IMAGES . "thumb-lightgallry/" . $basename);

    $database->commit();

    // $log = $this->logActivity($userId, "delete image");
  }

  public function deletedocument($userId, $docId)
  {
    $database = Database::openConnection();

    $database->getById("data.fdocs", $docId);
    $file = $database->fetchAssociative();

    // start a transaction to guarantee the file will be deleted from both; database and filesystem
    $database->beginTransaction();
    $database->deleteById("data.fdocs", $docId);

    if ($database->countRows() !== 1) {
      $database->rollBack();
      throw new Exception("Couldn't delete file");
    }

    $basename = $file["hashed_filename"] . "." . $file["extension"];
    Uploader::deleteFile(IMAGES . "documents/" . $basename);

    $database->commit();

    // $log = $this->logActivity($userId, "delete image");
  }
}