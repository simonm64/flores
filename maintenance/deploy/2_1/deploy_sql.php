<?php
include realpath(dirname(__FILE__) . '/../includes.php');
require realpath(dirname(__FILE__) . '/../../bootstrap.php');
require realpath(dirname(__FILE__) . '/../../classes/db_deploy.php');
$oDbDeploy = new db_deploy();


$oDbDeploy->createGroup("country");
$oDbDeploy->add('apply_ddl', "ALTER TABLE USERS ADD COLUMN JSON_DATA TEXT(1000) NULL AFTER VC_NAME");
$oDbDeploy->add('revert_ddl', "ALTER TABLE USERS DROP COLUMN JSON_DATA");

$oDbDeploy->execute($aOptions);
echo("...Script complete\n");