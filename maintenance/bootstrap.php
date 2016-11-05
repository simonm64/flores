<?php

// Define path to maintenance directory
defined('MAINTENANCE_PATH')
    || define('MAINTENANCE_PATH', realpath(dirname(__FILE__) . '/../maintenance'));

#define('MAINTENANCE_ENV', getenv('MAINTENANCE_ENV'));
// Ensure library/ is on include_path
/*set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
)));*/

require_once 'Zend/Db/Adapter/Abstract.php';
require_once 'Zend/Config/Ini.php';
require_once MAINTENANCE_PATH.'/config/db.php';