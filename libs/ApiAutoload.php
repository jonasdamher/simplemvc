<?php

declare(strict_types=1);

function apiAutoload($controllerName)
{
    require_once 'api/' . $controllerName . '.php';
}

spl_autoload_register('apiAutoload');
