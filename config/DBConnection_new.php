<?php

namespace config;

use config\Configuration as conf;
use config\DBConnection;
use libs\Error;

class DBConnection {

    public function __construct() {
        error_reporting(0);
        if ($con = mysqli_connect(conf::SERVER_NAME, conf::DB_USERNAME, conf::DB_PASSWORD, conf::DB_NAME)) {
            return $con;
        } else {
            Error::message(mysqli_connect_error($con));
        }
    }

    public function tableExists($tbl) {
        if (!empty($tbl)) {

            echo "<pre>";
            echo var_dump($this->query('select * from' . $tbl));
            exit;
        } else {
            $error = debug_backtrace();
            $err[0] = reset($error);
            $err[0]['msg'] = 'tableExists() requires 1 parameter must be string, name of table';
            Error::errorReport($err);
            exit;
        }
    }

    public function query($query) {
        return mysqli_query(mysqli_connect(conf::SERVER_NAME, conf::DB_USERNAME, conf::DB_PASSWORD, conf::DB_NAME), $query);
    }

}

?> 