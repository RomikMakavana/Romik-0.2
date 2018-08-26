<?php

namespace backend\libs;

use config\Configuration as conf;
use config\Router;
use libs\Error;

class Controller {

    public function __construct() {
        
    }

    public function view($view = null, $var = [], $control = null) {
        if ($view != null) {
            if ($control != NULL)
                $path = conf::SITE_PATH . 'backend\pages\\' . $control . '\\' . $view . '.php';
            else
                $path = conf::SITE_PATH . 'backend\pages\\' . CONTROLLER . '\\' . $view . '.php';
            if (file_exists($path)) {
                if (!empty($var)) {
                    foreach ($var as $key => $v) {
                        $$key = $v;
                    }
                }
                include $path;
            } else {
                Error::message($path . '<br> page not found.');
            }
        } else {
            Error::message('View can\'t be blank.');
        }
    }

}

?>
