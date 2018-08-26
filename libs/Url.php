<?php

namespace libs;

use libs\Romik;

/**
 * get different property of project
 */
class Url {
    
    public static function hostUrl($concat = null) {
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        if (empty($concat))
            return $url;
        else
            return $url . $concat;
    }

    public static function getCurrentUrl() {
        $url = $_SERVER['REQUEST_URI'];
        $url = Romik::hostUrl() . $url;
        return $url;
    }

    public static function getRootUrl() {
        $remove = explode('/index.php', $_SERVER['SCRIPT_NAME']);
        $url = Url::hostUrl() . $remove[0];
        return $url;
    }

    public static function toAdminUrl($class = null) {
        $url = Url::getRootUrl();
        if ($url == null) {
            return $url . '/admin/';
        } else {
            return $url . '/admin/' . $class;
        }
    }

}

?>