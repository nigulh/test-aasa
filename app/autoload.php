<?php

spl_autoload_register(function ($className) {
    $file = str_replace('\\', DIRECTORY_SEPARATOR, $className);
    $path = dirname(__DIR__) . DIRECTORY_SEPARATOR . $file . ".php";
    require_once $path;
});