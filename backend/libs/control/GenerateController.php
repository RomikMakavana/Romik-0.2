<?php

namespace backend\libs\control;

use backend\libs\control\Controller;
use backend\libs\models\GenerateModel;

/**
 * user controller to login
 */
class GenerateController extends Controller {

    public function __construct() {
        
    }

    public function taskIndex() {
        Controller::view('index');
    }

}
