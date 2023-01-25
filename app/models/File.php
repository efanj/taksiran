<?php

/**
 * File Class
 *
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @author     Omar El Gabry <omar.elgabry.93@gmail.com>
 */

class File extends Model
{
  /**
   * get all files.
   *
   * @access public
   * @param  integer  $pageNum
   * @return array
   *
   */
  public function getAll($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT * FROM data.files ";
    $query .= "WHERE no_akaun = :no_akaun ";
    $query .= "ORDER BY files.date DESC ";

    $database->prepare($query);
    $database->bindValue(":no_akaun", Encryption::decryptId($fileId));
    $database->execute();
    $files = $database->fetchAllAssociative();

    return $files;
  }

  /**
   * get file by Id.
   *
   * @access public
   * @param  string  $fileId
   * @return array   Array holds the data of the file
   */
  public function getById($fileId)
  {
    $database = Database::openConnection();
    $query = "SELECT f.*, u.name ";
    $query .= "FROM data.files f ";
    $query .= "LEFT JOIN data.users u ON f.workerid = u.id ";
    $query .= "WHERE f.id = :id LIMIT 1 ";

    $database->prepare($query);
    $database->bindValue(":id", (int) $fileId);
    $database->execute();

    $file = $database->fetchAllAssociative();
    return $file;
  }

  /**
   * get file by hashed name.
   * files are unique by the hashed file name(= hash(original filename . extension)).
   *
   * @access public
   * @param  string  $hashedFileName
   * @return array   Array holds the data of the file
   */
  public function getByBenchHashedName($hashedFileName)
  {
    $database = Database::openConnection();

    $query = "SELECT bdocs.id AS id, bdocs.filename, bdocs.extension, bdocs.hashed_filename ";
    $query .= "FROM  data.bdocs ";
    $query .= "WHERE hashed_filename = :hashed_filename ";
    $query .= "LIMIT 1 ";

    $database->prepare($query);
    $database->bindValue(":hashed_filename", $hashedFileName);
    $database->execute();

    $file = $database->fetchAssociative();
    return $file;
  }

  public function getByHashedName($hashedFileName)
  {
    $database = Database::openConnection();

    $query = "SELECT fdocs.id AS id, fdocs.filename, fdocs.extension, fdocs.hashed_filename ";
    $query .= "FROM  data.fdocs ";
    $query .= "WHERE hashed_filename = :hashed_filename ";
    $query .= "LIMIT 1 ";

    $database->prepare($query);
    $database->bindValue(":hashed_filename", $hashedFileName);
    $database->execute();

    $file = $database->fetchAssociative();
    return $file;
  }

  /**
   * create file.
   *
   * @access public
   * @param  integer   $userId
   * @param  array     $fileData
   * @return array     Array holds the created file
   * @throws Exception If file couldn't be created
   */
  public function create($userId, $no_akaun, $filename, $file_type, $description, $fileData)
  {
    if ($file_type == "1") {
      $type = "image";
    } else {
      $type = "file";
    }
    // upload
    $file = Uploader::uploadFile($fileData, "", $type);

    if (!$file) {
      $this->errors = Uploader::errors();
      return false;
    }

    $database = Database::openConnection();

    $query = "INSERT INTO files (no_akaun, workerid, file_type, filename, hashed_filename, description) VALUES (:no_akaun, :workerid, :file_type, :filename, :hashed_filename, :description)";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $no_akaun);
    $database->bindValue(":workerid", $userId);
    $database->bindValue(":file_type", $file_type);
    $database->bindValue(":filename", $filename);
    $database->bindValue(":hashed_filename", $file["hashed_filename"]);
    $database->bindValue(":description", $description);
    $database->execute();

    // if insert failed, then delete the file
    if ($database->countRows() !== 1) {
      Uploader::deleteFile(IMAGES . "big-lightgallry/" . $file["basename"]);
      throw new Exception("Couldn't upload file");
    }

    $fileId = $database->lastInsertedId();
    $file = $this->getById($fileId);
    return $file;
  }

  public function upload($workerId, $no_akaun, $fileData)
  {
    // upload
    $file = Uploader::uploadFile($fileData, "");

    if (!$file) {
      $this->errors = Uploader::errors();
      return false;
    }

    $database = Database::openConnection();

    $query = "INSERT INTO files (no_akaun, workerid, filename, width, height, description, date) VALUES (:no_akaun, :worker_id, :filename, :hashed_filename, :extension)";

    $database->prepare($query);
    $database->bindValue(":no_akaun", $no_akaun);
    $database->bindValue(":worker_id", $workerId);
    $database->bindValue(":filename", $file["filename"]);
    $database->bindValue(":hashed_filename", $file["hashed_filename"]);
    $database->bindValue(":extension", strtolower($file["extension"]));
    $database->execute();

    // if insert failed, then delete the file
    if ($database->countRows() !== 1) {
      Uploader::deleteFile(APP . "uploads/" . $file["basename"]);
      throw new Exception("Couldn't upload file");
    }

    $fileId = $database->lastInsertedId();
    $file = $this->getById($fileId);
    return $file;
  }

  /**
   * deletes file.
   * This method overrides the deleteById() method in Model class.
   *
   * @access public
   * @param  array    $id
   * @throws Exception If failed to delete the file
   *
   */
  public function deleteById($id)
  {
    $database = Database::openConnection();

    $database->getById("files", $id);
    $file = $database->fetchAssociative();

    // start a transaction to guarantee the file will be deleted from both; database and filesystem
    $database->beginTransaction();
    $database->deleteById("files", $id);

    if ($database->countRows() !== 1) {
      $database->rollBack();
      throw new Exception("Couldn't delete file");
    }

    $basename = $file["hashed_filename"] . "." . $file["extension"];
    Uploader::deleteFile(APP . "uploads/" . $basename);

    $database->commit();
  }
}