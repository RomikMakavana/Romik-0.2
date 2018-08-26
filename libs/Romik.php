<?php

namespace libs;

use libs\Romik;

/**
 * get different property of project
 */
class Romik {

    public static function hostUrl($concat = null) {
        $url = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];
        if (empty($concat))
            return $url;
        else
            return $url . $concat;
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