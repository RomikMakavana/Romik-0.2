<?php

namespace libs;

use config\Configuration as conf;
use config\Router;
use libs\error;

class Controller {

    public function __construct() {
    }

    public function view($view = null){
    	if($view != null){
            $path = conf::SITE_PATH.'pages\\'.CONTROLLER.'\\'.$view.'.php';
            if(file_exists($path)){
                include $path;
            }else{
                Error::message($path.'<br> page not found.');
            }
        }else{
            Error::message('View can\'t be blank.');
        }
    }
    
}

?>
