<?php

function controllersAutoload($controllerName) {
    require_once 'controllers/'.$controllerName.'.php';
}

spl_autoload_register('controllersAutoload');

?>