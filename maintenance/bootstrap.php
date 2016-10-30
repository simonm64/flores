<?php

// Define path to maintenance directory
defined('MAINTENANCE_PATH')
    || define('MAINTENANCE_PATH', realpath(dirname(__FILE__) . '/../maintenance'));

// Define maintenance environment

defined('MAINTENANCE_ENV')
    || define('MAINTENANCE_ENV', (getenv('MAINTENANCE_ENV') ? getenv('MAINTENANCE_ENV') : 'qa'));

// Ensure library/ is on include_path
//library is already included in php.ini
/*set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));*/
require_once 'Zend/Db/Adapter/Abstract.php';
require_once 'Zend/Config/Ini.php';
require_once MAINTENANCE_PATH.'/config/db.php';
//require_once 'Zend/Loader/Autoloader.php';
//Zend_Loader_Autoloader::getInstance();

//require_once 'Zend/Application.php';
