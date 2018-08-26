<?php

namespace config;

use config\Configuration as conf;
use libs\Error;

class DBConnection {

    protected $host = conf::SERVER_NAME;
    protected $username = conf::DB_USERNAME;
    protected $password = conf::DB_PASSWORD;
//    protected $password = '{&UxEF*^{7&6';
    protected $dbname = conf::DB_NAME;

    public function __construct() {
        error_reporting(0);
        try {
            $this->con = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbname . "", $this->username, $this->password);
            error_reporting(E_ALL);
            return $this->con;
        } catch (\PDOException $e) {
            Error::message($e->getMessage());
        }
    }

    /**
     * count all rows
     */
    function rowCount($sql) {
        try {
            $sth = $this->con->prepare($sql);
            $sth->execute();
            $result = $sth->rowCount();
            return $result;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function select($sql, $type = 'obj') {
        try {
            $sth = $this->con->prepare($sql);
            $sth->execute();
            $setType = ($type == 'obj') ? \PDO::FETCH_OBJ : \PDO::FETCH_ASSOC;
            $result = $sth->fetchAll($setType);
            return $result;
        } catch (\PDOException $e) {
            return $e->getMessage();
        }
    }

    public function row($sql) {
        try {
            $sth = $this->con->prepare($sql);
            $sth->execute();
            $result = $sth->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function insert($table, $values) {

        try {
            $this->tableName = trim($table);
            $this->value = $values;
            if (!is_array($this->value)) {
                return 0;
            }
            $count = 0;
            foreach ($this->value as $key => $val) {
                if ($count == 0) {
                    $this->field1 = ":" . $key . "";
                    $this->field2 = "`" . $key . "`";
                    $this->fieldsValues = '`' . $val . '`';
                } else {
                    $this->fieldsValues .= ", `" . $val . "` ";
                    $this->field1 .= ",:" . $key . "";
                    $this->field2 .= ",`" . $key . "`";
                }
                $count++;
            }


            $this->query = sprintf("insert into %s (%s) values (%s)", $this->tableName, $this->field2, $this->fieldsValues);
            $res = $this->con->query($this->query);
            return [
                'status' => true,
                'data' => $this->con->lastInsertId(),
            ];
        } catch (\PDOException $e) {
            return [
                'status' => false,
                'data' => $e->getMessage(),
            ];
        }
    }

    public function update($table, $values, $where = 1, $limit = 1) {
        try {
            $this->tableName = trim($table);
            $this->value = $values;
            $this->where = $where;
            $this->limit = $limit;

            if (!is_array($this->value)) {
                return 0;
            }
            $count = 0;
            $this->query = 'update ' . $this->tableName . ' set ';

            foreach ($this->value as $key => $val) {
                if ($count == 0) {
                    $this->query .= " `$key`= " . $val . " ";
                } else {
                    $this->query .= " , `$key`= " . $val . " ";
                }
                $count++;
            }

            $this->query .= "  WHERE $this->where  LIMIT $this->limit ";
            $res = $this->con->query($this->query);
            return $res;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($table, $where) {
        try {
            $this->table = trim($table);
            $this->where = $where;
            $this->query = "DELETE FROM " . $this->table . " WHERE " . $this->where;
            $res = $this->con->query($this->query);
            return $res;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function close() {
        try {
            $this->con = null;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function isUnique($value, $table, $field) {
        try {
            $result = $this->select("SELECT " . $field . " FROM " . $table . " WHERE " . $field . " = '" . $value . "'");
            return count($result);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function isExist($table, $fieldName, $fieldValue, $fieldNm, $fieldVal) {
        $dbh = new DBConnection();
        $get = "SELECT " . $fieldName . " FROM " . $table . " WHERE " . $fieldName . "=" . $dbh->sqlSafe($fieldValue) . " AND " . $fieldNm . " != " . $dbh->sqlSafe($fieldVal);
        $res = $dbh->select($get);
        return (count($res) == 0) ? FALSE : TRUE;
    }

    public function sqlSafe($value, $quote = "'") {
        try {
            $value = str_replace(array("\'", "'"), "&#39;", $value);
            if (get_magic_quotes_gpc()) {
                $value = stripslashes($value);
            }
            $value = $quote . $value . $quote;
            return $value;
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function migrateAdmin() {
        try {
            $tbls = $this->con->query("show tables");
            while ($tbl = $tbls->fetch(\PDO::FETCH_NUM)) {
                if ($tbl[0] == 'user')
                    return TRUE;
            }
            return false;
        } catch (\PDOException $ex) {
            Error::message($ex->getMessage());
        }
    }

}

?> 