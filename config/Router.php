<?php

namespace config;

use config\Configuration as conf;
use libs\Error;

class Router {

    public static $controller;

    public function callAction($controller, $action, $parameter) {
        $controller = 'controller\\' . ucfirst(strtolower($controller)) . 'Controller';
        $action = 'task' . ucfirst(strtolower($action));
        if (class_exists($controller)) {
            $controller = new $controller();
        } else {
            Error::message($controller . ' class not found');
        }
        if (method_exists($controller, $action)) {
            $action = $controller->$action();
        } else {
            Error::message($action . ' method doesn\'t exists in ' . get_class($controller));
        }
        exit;
    }

    public function callAdmin($controller, $action, $parameter) {
        if ($controller == 'generate') {
            $controller = 'backend\libs\control\\' . ucfirst(strtolower($controller)) . 'Controller';
        } else {
            $controller = 'backend\controller\\' . ucfirst(strtolower($controller)) . 'Controller';
        }

        $action = 'task' . ucfirst(strtolower($action));
        if (class_exists($controller)) {
            $controller = new $controller();
        } else {
            Error::message($controller . ' class not found');
        }
        if (method_exists($controller, $action)) {
            $action = $controller->$action();
        } else {
            Error::message($action . ' method doesn\'t exists in ' . get_class($controller));
        }
        exit;
    }

    public function checkAdminLogin($controller, $action, $parameter) {
        $controller = 'backend\controller\\' . ucfirst(strtolower($controller)) . 'Controller';
        $action = 'task' . ucfirst(strtolower($action));
        if (class_exists($controller)) {
            $controller = new $controller();
        } else {
            Error::message($controller . ' class not found');
        }
        if (method_exists($controller, $action)) {
            $action = $controller->$action();
            return $action;
        } else {
            Error::message($action . ' method doesn\'t exists in ' . get_class($controller));
        }
        exit;
    }

    public function pageNotFound() {
        ob_end_clean();
        include conf::SITE_PATH . 'libs/error.php';
        exit;
    }

}

//$callaction = new callingAction();
//$title = $callaction->callAction($controller, $action, $parameter);
?>