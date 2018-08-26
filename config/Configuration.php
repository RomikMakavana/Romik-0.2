<?php

namespace config;

use config\DBConnection;
use config\Configuration as conf;
use libs\Url;

/**
 * configuration
 */
class Configuration {

//Default module
    const DEFAULT_CONTROLLER = "site";
    const DEFAULT_ACTION = "index";
//Server configurations
    const SERVER_NAME = "localhost";
    const DB_USERNAME = "root";
    const DB_PASSWORD = "";
    const DB_NAME = "romik";
    
    /*
     * name of admin side
     */
    const ADMIN_SIDE = 'admin';

    public static $cssFiles = [
        'bootstrap\bootstrap.min.css',
        'style.css',
        'fontawesome\css\all.css',
    ];
    public static $jsFiles = [
        'jquery.min.js',
        'bootstrap\bootstrap.min.js',
    ];

    /*
     * layout out config
     */
    const LAYOUT_DIR = 'pages/layout/';


    /*
     * css configuration
     */
    const IMG_URL = "/images/";
    const SITE_PATH = BASE_PATH . '\\';
    const SITE_SRC = conf::SITE_PATH . 'libs/';

    function __construct() {
        
    }

}
?>

