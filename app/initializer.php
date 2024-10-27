<?php

//Llamando config
require_once 'config/config.php';

//Llamando URL
require_once 'helpers/url_helper.php';

//Llamando a LIBS
spl_autoload_register(function($files){
    require_once 'libs/' . $files . '.php';
});