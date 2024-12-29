<?php

//config file
require_once 'config/config.php';

//autoloader
spl_autoload_register(function ($class_name) {
    require_once 'lib/' . $class_name . '.php';
});

?>