<?php

class Oracle
{

    /**
     * @access public
     * @var PDO PDO Object
     */
    private $connect = null;

    /**
     * @access public
     * @var PDOStatement PDOStatement Object
     */
    private $statement = null;

    /**
     * @access public
     * @static static
     * @var Database Database Object used to implement the Singleton pattern
     */
    private static $oracle = null;

    /**
     * This is the constructor for Database Object.
     *
     * @access private
     */
    public function __construct()
    {
        if ($this->connect === null) {
            $this->connect = new PDO(Config::get('ORACLE_DB') . ";charset=utf8", Config::get('ORACLE_DB_USER'), Config::get('ORACLE_DB_PASS'));

            $this->connect->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->connect->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);
        }
    }

    /**
     * This method for instantiating oracledb object using the Singleton Design pattern.
     *
     * @access public
     * @static static method
     * @return Database Instantiate(if not already instantiated)
     *
     */
    public static function openOriConnection()
    {
        if (self::$oracle === null) {
            self::$oracle = new Oracle();
        }
        return self::$oracle;
    }

    /**
     * Prepares a SQL query for execution and assign a statement object to $this->statement
     *
     * @access public
     * @param  string  $query
     *
     */
    public function prepare($query)
    {
        $this->statement = $this->connect->prepare($query);
    }

    /**
     * Binds a value to a parameter.
     *
     * A better practice to explicitly define data types in parameter declarations,
     * So, instead of defining the data type parameter every time,
     * Just pass the value, and getPDOType() will take care of it's data type
     *
     * This is the same for bindParam()
     *
     * @access public
     * @param   string  $param
     * @param   mixed   $value
     *
     */
    public function bindValue($param, $value)
    {
        $type = self::getPDOType($value);
        $this->statement->bindValue($param, $value, $type);
    }

    /**
     * Binds variable by reference to a parameter.
     *
     * @access public
     * @param   string  $param
     * @param   mixed   $var
     *
     */
    public function bindParam($param, &$var)
    {
        $type = self::getPDOType($var);
        $this->statement->bindParam($param, $var, $type);
    }

    /**
     * Executes a prepared statement
     *
     * @access public
     * @param   array   Array of values to be bound in SQL query, All values are treated as PDO::PARAM_STR.
     * @return  boolean Returns TRUE on success or FALSE on failure.
     *
     */
    public function execute($arr = null)
    {
        if ($arr === null)  return $this->statement->execute();
        else               return $this->statement->execute($arr);
    }

    /**
     * To fetch only a single column in form of 0-indexed array.
     *
     * @access public
     * @return array
     */
    public function fetchColumn()
    {
        return $this->statement->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    /**
     * To fetch the result data in form of [0-indexed][key][value] array.
     *
     * @access public
     * @return array    empty array if no data returned
     */
    public function fetchAllAssociative()
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * To fetch Only the next row from the result data in form of [key][value] array.
     *
     * @access public
     * @return array|bool   false on if no data returned
     */
    public function fetchAssociative()
    {
        return $this->statement->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * To fetch All the data in form of [0-indexed][an anonymous object with property names that correspond to the column names] array.
     *
     * @access public
     * @return array
     */
    public function fetchAllObject()
    {
        return $this->statement->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * To fetch Only the next row from the result data in form of an anonymous object with property names that correspond to the column names.
     *
     * @access public
     * @return object
     */
    public function fetchObject()
    {
        return $this->statement->fetch(PDO::FETCH_OBJ);
    }

    /**
     * To fetch All data in form of an array indexed by both column name and 0-indexed column
     *
     * @access public
     * @return array
     */
    public function fetchAllBoth()
    {
        return $this->statement->fetchAll(PDO::FETCH_BOTH);
    }

    /**
     * To fetch Only the next row from the result data in form of an array indexed by both column name and 0-indexed column
     *
     * @access public
     * @return array
     */
    public function fetchBoth()
    {
        return $this->statement->fetch(PDO::FETCH_BOTH);
    }

    /**
     * Returns the ID of the last inserted row or sequence value
     * "This method may not return a meaningful or consistent result across different PDO drivers"
     *
     * @access public
     * @return integer  The ID of the last inserted row of Auto-incremented primary key.
     * @see http://php.net/manual/en/pdo.lastinsertid.php
     *
     */
    public function lastInsertedId()
    {
        return $this->connect->lastInsertId();
    }

    /**
     * Start a transaction
     *
     * @access public
     * @see http://php.net/manual/en/pdo.begintransaction.php
     * @see http://stackoverflow.com/questions/10155946/php-pdo-transactions
     */
    public function beginTransaction()
    {
        $this->connect->beginTransaction();
    }

    /**
     * Commit a transaction. This method will be called after beginTransaction()
     *
     * It will return the database connect to autocommit mode until the next call to PDO::beginTransaction() starts a new transaction.
     *
     * @access public
     * @see http://php.net/manual/en/pdo.commit.php
     */
    public function commit()
    {
        $this->connect->commit();
    }

    /**
     * Rollback a transaction. This method will be called after beginTransaction()
     * A PDOException will be thrown if no transaction is active.
     *
     * It will return the database connection to autocommit mode until the next call to PDO::beginTransaction() starts a new transaction.
     *
     * @access public
     * @see http://php.net/manual/en/pdo.rollback.php
     */
    public function rollBack()
    {
        $this->connect->rollBack();
    }

    /**
     * Returns the number of rows affected by the last SQL statement
     * "If the last SQL statement executed by the associated PDOStatement was a SELECT statement, some databases may return the number of rows returned by that statement"
     *
     * @access public
     * @see http://php.net/manual/en/pdostatement.rowcount.php
     */
    public function countRows()
    {
        return $this->statement->rowCount();
    }

    /**
     * Counts the number of rows in a specific table
     *
     * @access public
     * @param   string  $table
     * @return  integer
     *
     */
    public function countAll($table)
    {
        $this->statement = $this->connect->prepare('SELECT COUNT(*) AS count FROM ' . $table);
        $this->execute();
        return (int)$this->fetchAssociative()["count"];
    }

    /**
     * Select all rows from a table
     *
     * @access public
     * @param   string  $table
     *
     */
    public function getAll($table)
    {
        $this->statement = $this->connect->prepare('SELECT * FROM ' . $table);
        $this->execute();
    }

    /**
     * Select a row from a table provided by id(primary key)
     *
     * @access public
     * @param   string $table
     * @param   mixed  $id
     *
     */
    public function getById($table, $id)
    {
        $this->statement = $this->connect->prepare('SELECT * FROM ' . $table . ' WHERE id = :id LIMIT 1');
        $this->bindValue(':id', $id);
        $this->execute();
    }

    /**
     * Select all rows from a table provided
     *
     * @access public
     * @param   string  $table
     *
     */
    public function getDataByTable($table)
    {
        $this->statement = $this->connect->prepare('SELECT * FROM ' . $table);
        $this->execute();
    }
    public function getDataByTableColumns($table, $column)
    {
        $this->statement = $this->connect->prepare('SELECT ' . $column . ' FROM ' . $table . ' GROUP BY ' . $column);
        $this->execute();
    }

    /**
     * Delete all rows from a table
     *
     * @access public
     * @param   string  $table
     *
     */
    public function deleteAll($table)
    {
        $this->statement = $this->connect->prepare('DELETE FROM ' . $table);
        $this->execute();
    }

    /**
     * Delete all data from a table provided by id(primary key)
     *
     * @access public
     * @param  string  $table
     * @param  mixed   $id
     *
     */
    public function deleteById($table, $id)
    {
        $this->statement = $this->connect->prepare('DELETE FROM ' . $table . ' WHERE id = :id LIMIT 1');
        $this->bindValue(':id', $id);
        $this->execute();
    }

    /**
     * Determine the PDOType of a passed value.
     * This is done by determining the data type of the passed value.
     *
     * @access public
     * @param   mixed  $value
     * @return  integer PDO Constants
     *
     */
    private static function getPDOType($value)
    {
        switch ($value) {
            case is_int($value):
                return PDO::PARAM_INT;
            case is_bool($value):
                return PDO::PARAM_BOOL;
            case is_null($value):
                return PDO::PARAM_NULL;
            default:
                return PDO::PARAM_STR;
        }
    }

    /**
     * Closing the connection.
     *
     * It's not necessary to close the connection, however it's a good practice.
     * "If you don't do this explicitly, PHP will automatically close the connection when your script ends."
     *
     * This will be used at the end "footer.php"
     *
     * @static static method
     * @access public
     * @see http://php.net/manual/en/pdo.connections.php
     */
    public static function closeOciConnection()
    {
        if (isset(self::$oracle)) {
            self::$oracle->connect =  null;
            self::$oracle->connect = null;
            self::$oracle = null;
        }
    }
}