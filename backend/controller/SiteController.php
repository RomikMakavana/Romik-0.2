<?php

namespace backend\controller;

use backend\libs\Controller;

class SiteController extends Controller{

    function __construct() {
    }

    public function taskIndex() {
        Controller::view('index');
    }

}
