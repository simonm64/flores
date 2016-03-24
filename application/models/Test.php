<?php

class Application_Model_Test
{
  private $oDB;
  
  public function __construct(){
    
    //connect to db
    $this->oDB = FloresDB::conn();
    
  }
  
  public function getTestInfo($iTestId){
    
    //query the test table
    $sSql = "SELECT VC_NME_TST FROM TESTS WHERE ID_TST = ?";
    $aTestData = $this->oDB->fetchRow($sSql,$iTestId);
    
    $aTestInfo['title'] = $aTestData['VC_NME_TST'];
    
    return $aTestInfo;
   
  }
  
  
  public function registerSession($iTest){
    
    
    
  }
  
  
  public function getQuestions($iTestId){

    //query the questions
    $sSql = "SELECT 
              ID_QSTN,
              VC_CPY_QSTN,
              ID_TST,
              ID_PRDCT,
              I_GRP
             FROM QUESTIONS
             WHERE ID_TST = ?";
    $aTestInfo = $this->oDB->fetchAll($sSql,$iTestId);
    
    return $aTestInfo;
  
  }
  
  public function getLastQuestionBySession($iTest){
    
    $sSql = "SELECT ID_QSTN
            FROM FLOWERS.USER_RESULTS
            WHERE ID_TST = ?
            AND VC_SESSION_ID = ?
            ORDER BY ID_QSTN DESC";
    $iResult = $this->oDB->fetchOne($sSql,array($iTest,session_id()));
    if(!$iResult)
      return 0;
    Zend_debug::dump($iResult);
    return $iResult;
  
  }
  
  
  public function getBuildQuestion($iTest){
    
    $iQuestion = self::getLastQuestionBySession($iTest);
    var_dump('shut_'.$iQuestion);
    //get question
    $sSql = "SELECT
              ID_QSTN,
              VC_CPY_QSTN,
              ID_TST,
              ID_PRDCT,
              I_GRP
             FROM QUESTIONS
             WHERE ID_TST = ?
             AND ID_QSTN = ?
             LIMIT 1";
    $aQ = $this->oDB->fetchRow($sSql, array($iTest,$iQuestion+1));
    //Zend_Debug::dump($aQ);
    //$oDBst = $this->oDB->query($sSql,array($iTest,$iQuestion));
    //$aQ = $oDBst->fetchOne();
    //Zend_debug::dump($aQuestion);
    
    if(!$aQ)//no more questions
     return 'No more questions';
    //get options
    $aOptions = self::getOptionsAnswers($iTest);
    $aOpts= array();
    foreach($aOptions as $aOp){
      $aOpts[] = array('option'=>$aOp['VC_OPTN_TXT'], 'value'=>$aOp['I_VAL']);
    }
    
    $aResult['id'] = $aQ['ID_QSTN'];
    $aResult['question'] = $aQ['VC_CPY_QSTN'];
    $aResult['id_prod'] = $aQ['ID_PRDCT'];
    $aResult['id_group'] = $aQ['I_GRP'];
    $aResult['options'] = $aOpts;

    //return structure
    return $aResult;
    
  }
  
  public function getOptionsAnswers($iTestId){
    
    //queries the options table
    $sSql = "SELECT
              VC_OPTN_TXT,
              I_VAL
            FROM OPTIONS
            WHERE ID_TST = ?";
    $aOptions = $this->oDB->fetchAll($sSql,$iTestId);
    return $aOptions;
    
  }
  
  
  public function buildTest($aInfo, $aQuestions, $aOptions){
    
    $aResult['title'] = $aInfo['VC_NME_TST'];
    $aOpts= array();
    foreach($aOptions as $aOp){
      
      $aOpts[] = array('option'=>$aOp['VC_OPTN_TXT'], 'value'=>$aOp['I_VAL']);
      
    }
    
  $iTotalQ = count($aQuestions);
  $i=1;
  foreach($aQuestions as $aQ){
      $aResult['questions'][$aQ['ID_QSTN']]['id'] = $aQ['ID_QSTN'];
      $aResult['questions'][$aQ['ID_QSTN']]['question'] = $aQ['VC_CPY_QSTN'];
      $aResult['questions'][$aQ['ID_QSTN']]['id_prod'] = $aQ['ID_PRDCT'];
      $aResult['questions'][$aQ['ID_QSTN']]['id_group'] = $aQ['I_GRP'];
      $aResult['questions'][$aQ['ID_QSTN']]['is_last'] = 0;
      $aResult['questions'][$aQ['ID_QSTN']]['options'] = $aOpts;
      
      if($iTotalQ == $i)
        $aResult['questions'][$aQ['ID_QSTN']]['is_last'] = 1;
      $i++;
    }
    Zend_Debug::dump($aResult);
    
  }
  
  
  
  public function InsertAnswer($iTest,$iQuestion,$iGroup,$iValue){
    
    //session_start();
    var_dump(session_id());
    $data = array('ID_TST'=>$iTest,
                  'ID_QSTN'=>$iQuestion,
                  'I_GRP'=>$iGroup,
                  'I_VALUE'=>$iValue,
                  'VC_SESSION_ID'=>session_id());
    
    $this->oDB->insert('USER_RESULTS', $data);
    
    $id = $this->oDB->lastInsertId();
    var_dump($id);
    if(is_numeric($id)){
      return true;
    }else{
      return false;
    }
    //if not, start session and create a record in user_results
    
  }
  
  
  public function getResults($iIdUser, $iIdTest){
    
    //make the awsome query joining all the tables
    
    //return assosiative array.
    
  }
  


}

