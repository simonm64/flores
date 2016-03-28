<?php

class Application_Model_User
{
  
  private $oDB;
  public function __construct(){
    
    //connect to db
    $this->oDB = FloresDB::conn();
    
  }
  
  public function getResultbySession($iTest, $iQuestion, $iGroup, $iValue){
    
    $sSql = "SELECT
                COUNT(ID_USR_RSLTS)
            FROM FLOWERS.USER_RESULTS
            WHERE ID_TST = ?
            AND I_QSTN = ?
            AND I_GRP = ?
            AND VC_SESSION_ID = ?";
    $iResult = $this->oDB->fetchOne($sSql,array($iTest, $iQuestion, $iGroup, session_id()));

    if(!$iResult)
      return 0;

    return $iResult;
  
  }
  
  public function updateResult($iTest, $iQuestion, $iGroup, $iValue){
    
    $data = array(
      'I_VALUE' => $iValue,
    );
     
    $where['ID_TST = ?'] = $iTest;
    $where['I_QSTN = ?'] = $iQuestion;
    $where['I_GRP = ?'] = $iGroup;
    $where['VC_SESSION_ID = ?'] = session_id();
    
    try{
      $iAffected = $this->oDB->update('USER_RESULTS', $data, $where);
    } catch(Zend_Exception $e){
      return $e->getMessage();
    }
    
    return $iAffected;
    
  }
  
  public function insertResult($iTest, $iQuestion, $iGroup, $iValue){
    
    $data = array('ID_TST'=>$iTest,
                  'I_QSTN'=>$iQuestion,
                  'I_GRP'=>$iGroup,
                  'I_VALUE'=>$iValue,
                  'VC_SESSION_ID'=>session_id()
                  );
    
      try{
        $this->oDB->insert('USER_RESULTS', $data);
      } catch(Zend_Exception $e){
        return $e->getMessage();
      }
      
      return ($this->oDB->lastInsertId());
      //var_dump($id);
      /*if(is_numeric($iInserted)){
        return $iInserted;
      }else{
        return false;
      }*/

  }
  
  public function upsertUser($sName, $sEmail){
    
    $iUserId = self::getUserByEmail($sEmail);
    
    //verify if is there an existen user with that email
    
    if($iUserId > 0){
      $vAffected = self::updateUser($sName,$sEmail,$iUserId);
      if(!is_numeric($vAffected)){
        return $vAffected;
      }
    }else{
      $iUserId = self::insertUser($sName, $sEmail);
    }
    //if is it, update
    
    //else, insert the user
    
    //return the user id
    return $iUserId;
  }
  
  
  public function getUserbyEmail($sEmail){
    
    $sSql = "SELECT
                ID_USR
            FROM USERS
            WHERE VC_EMAIL = ?";
    $iResult = $this->oDB->fetchOne($sSql,array($sEmail));

    if(!$iResult)
      return 0;

    return (int)$iResult;
    
  }
  
  
  public function updateUser($sName, $sEmail, $iUserId){

    $data = array(
      'VC_NAME' => $sName,
    );
     
    $where['ID_USR = ?'] = $iUserId;
    $where['VC_EMAIL = ?'] = $sEmail;
    
    try{
      $iAffected = $this->oDB->update('USERS', $data, $where);
    } catch(Zend_Exception $e){
      return $e->getMessage();
    }
    
    return $iAffected;
  }
  
  
  public function insertUser($sName, $sEmail){
    
    $data = array('VC_EMAIL'=>$sEmail,
                  'VC_NAME'=>$sName
                  );
    
    try{
      $this->oDB->insert('USERS', $data);
    } catch(Zend_Exception $e){
      return $e->getMessage();
    }
    
    return ($this->oDB->lastInsertId());
    
  }
  
  
  public function sendResultsEmail($iUserId,$iTest){
    
    //sets resultds to the user
    $vAffected = self::setResults($iUserId,$iTest);
    
    if(!is_numeric($vAffected)){
      return $bSet; //exception thrown
    }
    //get the results of user
    $aResults = self::getResults($iUserId,$iTest);
    
    //generate view of email
    
    
    //send email.
    return true;
  }
  
  
  /*setResults
   *
   *Assigns the given user to all the user_results records
   *with the current session_id
   */
  public function setResults($iUserId,$iTest){
    
    $data = array(
      'ID_USR' => $iUserId,
    );
    
    $where['ID_TST = ?'] = $iTest;
    $where['VC_SESSION_ID = ?'] = session_id();
    
    try{
      $iAffected = $this->oDB->update('USER_RESULTS', $data, $where);
    } catch(Zend_Exception $e){
      return $e->getMessage();
    }
    
    return $iAffected;
    
  }
  
  public function getResults($iUserId,$iTest){
    
    $iLimit = 12;
    if($iTest == 2)
      $iLimit = 40;
    //calculate results
            
    $oSelect = $this->oDB->select()
              ->from('USER_RESULTS', array('I_GRP','SUM(I_VALUE) AS I_VALUE'))
              ->where('ID_TST =  ?',$iTest)
              ->where('ID_USR = ?',$iUserId)
              ->group('I_GRP')
              ->order(array('I_VALUE DESC','I_GRP'))
              ->limit($iLimit,0);
    $sql = $oSelect->__toString();
    var_dump($sql);
    
    $oQuery = $this->oDB->query($oSelect);
    $aCalcResults = $oQuery->fetchAll();
    Zend_debug::dump($aCalcResults);
    
    //build test result with question text and values
  }

}

