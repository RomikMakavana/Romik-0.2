<?php

class DbContext{
    private $servername = SERVER_NAME;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $dbName = DB_NAME;
    public $dbConnection;
    
    public function __construct() {
        $this->dbConnection = new mysqli(
                $this->servername,
                $this->username,
                $this->password,
                $this->dbName
        );
    }
    
}