<?php

class Application_Model_Test
{
  private $oDB;
  
  public function __construct(){
    //connect to db
    
    $config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/application.ini', 'development');
    print_r($config);
    //var_dump($config);
    $this->oDB = Zend_Db::factory($config);
    
    //var_dump($this->oDB);
    
  }
  
  public function getTestInfo($iTestId){
    
    //query the test table
    
    //returns data
  }
  
  
  public function registerSession(){
    
    
    var_dump("sid=> ".session_id());
    
    //if not, start session and create a record in user_results
    
  }
  
  
  public function getQuestions($iTestId){
    
    
    //query the questions
    
    
    //query the answer options
    
    
    //prepares structure attaching the answer options to each question
    //in associative array
    
    //make sure to identify the last question (hidden field in every question)
    
  }
  
  
  public function getOptionsAnswers($iTestId){
    
    //queries the options table
    
    //return simple array
    
  }
  
  
  public function buildTest($iTestId){
    
    
  }
  
  
  public function InsertAnswer($idUser,$iIdTest,$iIdQuestion,$iValue){
    
    
    //get the current session id
    
    //make the insert in user results table
    
    
  }
  
  
  public function getResults($iIdUser, $iIdTest){
    
    //make the awsome query joining all the tables
    
    //return assosiative array.
    
  }
  


}

