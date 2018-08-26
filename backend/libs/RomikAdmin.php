<?php

namespace backend\libs;

use libs\Romik;
use libs\Url;

/**
 * get different property of project
 */
class RomikAdmin {

    public static function goToAdmin($class = null) {
        $url = Url::getRootUrl();
        if ($class == null) {
            header('Location:' . $url . '/admin/');
        } else {
            header('Location :' . $url . '/admin/' . $class);
        }
    }

}

?>