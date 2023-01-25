<?php


class AcmrSn extends ModelOracle
{

    public function getAll($pageNum = 1)
    {
        $pagination = PaginationOracle::pagination("V_ACMRSN", "", [], $pageNum);
        $offset = $pagination->getOffset();
        $limit = $pagination->perPage;
        $database = OracleDB::openConnection();

        $userSql = "SELECT * FROM V_ACMRSN";

        $query = "WITH USER_SQL AS ($userSql),
    PAGINATION AS (SELECT USER_SQL.*, rownum as rowNumId FROM USER_SQL)
SELECT *
FROM PAGINATION
WHERE rownum <= $limit AND rownumid > $offset";


        $database->prepare($query);
        $database->execute();

        $data = $database->fetchAllAssociative();
        return array("data" => $data, "pagination" => $pagination, "offset" => $offset, "limit" => $limit );
    }


}

?>