<?php
$aOptions = getopt('',array('env:', 'mode:', 'group:'));
if(!in_array('mode', array_keys($aOptions))){
	echo("Include the mode to execute --mode\n");
	die(1);
}
if(!in_array('group', array_keys($aOptions))){
	echo("Include the group to execute --group\n");
	die(1);
}
if(!in_array('env', array_keys($aOptions))){
	echo("Indicate the environment --env\n");
	die(1);
}

if(!in_array($aOptions['env'], array('dev', 'qa', 'uat', 'prod'))){
	echo("nvalid environment. Chose dev, qa, uat, prod\n");
	die(1);
}
if(!in_array($aOptions['mode'], array('apply_ddl', 'revert_ddl', 'apply_dml', 'revert_dml'))){
	echo("Invalid mode. Chose apply_ddl, revert_ddl, apply_dml, revert_dml\n");
	die(1);
}
define('MAINTENANCE_ENV', $aOptions['env']);