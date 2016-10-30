<?php
require realpath(dirname(__FILE__) . '/../../bootstrap.php');
require realpath(dirname(__FILE__) . '/../../classes/db_deploy.php');
$oDbDeploy = new db_deploy();
#var_dump($oDbDeploy);
#var_dump($oDbDeploy->execute("SELECT * FROM USERS LIMIT 1"));
$aOptions = getopt('',array('mode:','group:'));
if(!in_array('mode', array_keys($aOptions))){
	echo("Include the mode to execute --mode\n");
	die(1);
}
if(!in_array('group',array_keys($aOptions))){
	echo("Include the group to execute --group\n");
	die(1);
}

$oDbDeploy->createGroup('tests');
$oDbDeploy->add('apply_ddl', "CREATE TABLE TESTS (
  ID_TST int(5) NOT NULL AUTO_INCREMENT,
  VC_NME_TST varchar(45) NOT NULL,
  PRIMARY KEY (ID_TST, VC_NME_TST)
	) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;
");
$oDbDeploy->add('revert_ddl', 'DROP TABLE TESTS;');

$oDbDeploy->add('apply_dml', "INSERT INTO TESTS (VC_NME_TST) VALUES ('Cuestionario Básico');");
$oDbDeploy->add('apply_dml', "INSERT INTO TESTS (VC_NME_TST) VALUES ('Cuestionario Completo');");

//$oDbDeploy->add('apply_ddl', "ALTER SCHEMA FLOWERS_QA DEFAULT COLLATE utf8_spanish_ci;");


$oDbDeploy->execute($aOptions);
echo("...Script complete\n");