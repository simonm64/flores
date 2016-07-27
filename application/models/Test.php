<?php
class Application_Model_Test
{

  private $oDB;
  private $oUser;
  public function __construct()
  {
    //connect to db
    $this->oDB = FloresDB::conn();
    $this->oUser = new Application_Model_User;
  }

  public function getTestInfo($iTestId)
  {
    //query the test table
    $sSql = "SELECT VC_NME_TST FROM TESTS WHERE ID_TST = ?";
    $aTestData = $this->oDB->fetchRow($sSql,$iTestId);
    $aTestInfo['title'] = $aTestData['VC_NME_TST'];
    return $aTestInfo;
  }

  public function getLastQuestionBySession($iTest)
  {    
    $sSql = "SELECT I_QSTN
            FROM USER_RESULTS
            WHERE ID_TST = ?
            AND VC_SESSION_ID = ?
            ORDER BY I_QSTN DESC";
    $iResult = $this->oDB->fetchOne($sSql,array($iTest,session_id()));
    if(!$iResult){
      return 0;
    }
    return $iResult;
  }

  public function getBuildNextQuestion($iTest)
  {
    $iQuestion = self::getLastQuestionBySession($iTest);
    //get question
    $sSql = "SELECT
              ID_QSTN,
              VC_CPY_QSTN,
              ID_TST,
              I_QSTN,
              ID_PRDCT,
              I_GRP
             FROM QUESTIONS
             WHERE ID_TST = ?
             AND I_QSTN = ?
             LIMIT 1";
    $aQ = $this->oDB->fetchRow($sSql, array($iTest,$iQuestion+1));

    if(!$aQ){
      //no more questions
     return $aQ;
    }

    //get options
    $aOptions = self::getOptionsAnswers($iTest);
    $aOpts= array();
    foreach($aOptions as $aOp){
      $aOpts[] = array('option'=>$aOp['VC_OPTN_TXT'], 'value'=>$aOp['I_VAL']);
    }

    $aResult['id'] = $aQ['ID_QSTN'];
    $aResult['vc_question'] = $aQ['VC_CPY_QSTN'];
    $aResult['id_test'] = $aQ['ID_TST'];
    $aResult['i_question'] = $aQ['I_QSTN'];
    $aResult['id_prod'] = $aQ['ID_PRDCT'];
    $aResult['i_group'] = $aQ['I_GRP'];
    $aResult['a_options'] = $aOpts;

    //return structure
    return $aResult;
  }
  
  public function getOptionsAnswers($iTestId)
  {
    //queries the options table
    $sSql = "SELECT
              VC_OPTN_TXT,
              I_VAL
            FROM OPTIONS
            WHERE ID_TST = ?";
    $aOptions = $this->oDB->fetchAll($sSql,$iTestId);
    return $aOptions;
  }
  
  public function UpsertAnswer($iTest,$iQuestion,$iGroup,$iValue)
  {
    //verify existance of record (to avoid duplicates)
    $iUsrRslt = $this->oUser->getResultbySession($iTest,$iQuestion,$iGroup,$iValue);
    if($iUsrRslt > 0){
      $vResult = $this->oUser->updateResult($iTest,$iQuestion,$iGroup,$iValue);
    }else{
      $vResult = $this->oUser->insertResult($iTest,$iQuestion,$iGroup,$iValue);
    }
    return $vResult;
  }

}