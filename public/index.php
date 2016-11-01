<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

define('APPLICATION_ENV', (getenv('APPLICATION_ENV')));

/*Library loaded by php.ini*/

/** Zend_Application */
require_once 'Zend/Application.php';

// Create application, bootstrap, and run
$application = new Zend_Application(
    APPLICATION_ENV,
    APPLICATION_PATH . '/configs/application.ini'
);

require_once APPLICATION_PATH.'/configs/DB.php';

$application->bootstrap()
            ->run();