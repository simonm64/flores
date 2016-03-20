
<?php

abstract class FloresDB extends Zend_Db_Adapter_Abstract{
  
  public function __construct(){
    
    parent::__construct();
    
  }
  
  public static function conn(){
    
    $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'staging');
    
    try {
      
      $oDBconn = Zend_Db::factory($config->database);
      $oDBconn -> getConnection();
      
    } catch (Zend_Db_Adapter_Exception $e) {
      
      echo('Error in login on DBMS engine');
      // perhaps a failed login credential, or perhaps the RDBMS is not running
    } catch (Zend_Exception $e) {
      
      echo('Error loading DB class');
      // perhaps factory() failed to load the specified Adapter class
    }
    
    return $oDBconn;
    
  }
  
  
}