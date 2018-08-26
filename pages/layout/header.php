<?php

use config\Configuration as conf;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Romik</title>
        <?php
        foreach (conf::$cssFiles as $css) {
            echo "<link rel='stylesheet' type='text/css' href='" . libs\Url::getRootUrl() . "/css/" . $css . "'>";
        }
        ?>
        <?php
        foreach (conf::$jsFiles as $js) {
            echo "<script type='text/javascript' src = '" . libs\Url::getRootUrl() . "/js/" . $js . "'></script>";
        }
        ?>

        <link href="https://fonts.googleapis.com/css?family=Lato|Open+Sans|Raleway|Roboto" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
    </head>
    <body>
