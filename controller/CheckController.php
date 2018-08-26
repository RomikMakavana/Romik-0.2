<?php

namespace controller;

use libs\Controller;

class CheckController extends controller {

    public function __construct() {
        // echo SiteModel::name;
    }

    public function taskIndex(){
        return Controller::view('index');
    }

}