<?php

namespace backend\libs\models;

use config\DBConnection;

/**
 * model of user control
 */
class GenerateModel {

    public function __construct() {
        $this->DBcon = new DBConnection();
    }

}
