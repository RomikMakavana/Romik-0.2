<?php

namespace controller;

use models\SiteModel;
use libs\Controller;

class SiteController extends controller {

    public function __construct() {
        // echo SiteModel::name;
    }

    public function taskIndex(){
    	$site = new SiteModel();
        return Controller::view('index');
    }

}