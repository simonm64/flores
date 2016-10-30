<?php
/*
 * Class db_deploy
 * Helps in the process of changing, migrating and executing maintennce to db
 * 
 * @author Simon Martinez
 * @copyright Copyright (c) 2016, Metacortex Pictures
 * 
 */
class db_deploy {
	private $oDb;
	
	private $aStatements;
	private $sGroup;
	
	public function __construct(){
		$this->oDb = MaintenanceFloresDB::conn();
		#return $this->oDb;
	}
	
	public function add($sMode = null, $sStatement){
		if(is_null($sMode)){
			die(1);
		}
		$this->aStatements[$this->sGroup][$sMode][] = $sStatement;
	}
	
	public function createGroup($sGroup){
		$this->sGroup = $sGroup;
		$this->aStatements[$this->sGroup] = array(); 
	}
	
	public function execute($aOptions){
		if(!in_array($aOptions['group'], array_keys($this->aStatements))){
			echo("Group '{$aOptions['group']}' not found\n");
			die(1);	
		}
		
		foreach ($this->aStatements[$aOptions['group']][$aOptions['mode']] as $sSql){
			try{
				echo("EXECUTING: --".substr($sSql,0,70)." ...\n");
				$oQuery = $this->oDb->query($sSql);
			} catch(Zend_Exception $e){
					echo($e->getMessage()."\n");
					die(1);
			}
		}
	}
		
}
