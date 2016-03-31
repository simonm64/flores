<?php

class Application_Model_User
{
  
  private $oDB;
  private $oTest;
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
  
  
  /*public function getUserById($iUserId){
    
    $sSql = "SELECT
                VC_USER_EMAIL
            FROM 
            WHERE VC_EMAIL = ?";
    $iResult = $this->oDB->fetchOne($sSql,array($sEmail));

    if(!$iResult)
      return 0;

    return (int)$iResult;
    
  }*/
  
  
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
  
  
  public function getResults($iUserId, $iTest){
    
    //sets resultds to the user
    $vAffected = self::setResults($iUserId,$iTest);
    
    if(!is_numeric($vAffected)){
      return $bSet; //exception thrown
    }
    //get the results of user
    $aResults = self::calcResults($iUserId,$iTest);
    
    return $aResults;
  }
  
  
  /*setResults
   *
   *Assigns the given user to all the user_results records
   *with the current session_id
   */
  public function setResults($iUserId, $iTest){
    
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
  
  public function calcResults($iUserId, $iTest){
    
    $iLimit = 12;
    if($iTest == 2)
      $iLimit = 40;

    //calculate results
    $sSql = "SELECT DISTINCT
                Q.ID_PRDCT,
                P.VC_PRDCT_TTL,
                P.TXT_PRDCT_DSCRPTN,
                UR.I_GRP,
                UR.I_VALUE
              FROM (SELECT 
                      USER_RESULTS.I_GRP, 
                      SUM(I_VALUE) AS I_VALUE 
                      FROM USER_RESULTS 
                      WHERE (ID_TST = ?) 
                      AND (ID_USR = ?) 
                      GROUP BY I_GRP 
                      ORDER BY I_VALUE DESC, I_GRP ASC LIMIT $iLimit) UR
              LEFT JOIN QUESTIONS Q
              ON Q.I_GRP = UR.I_GRP AND Q.ID_TST = ?
              JOIN PRODUCTS P
              ON Q.ID_PRDCT = P.ID_PRDCT";
    try{
      $oQuery = $this->oDB->query($sSql,array($iTest,$iUserId,$iTest));
    }catch(Zend_Exception $e){
      return $e->getMessage();
    }
    
    $aResults = $oQuery->fetchAll();
    
    return $aResults;
  }
  
  
  public function sendResultsEmail($aResults, $iTest, $sName, $sEmail){
    
    $this->oTest = new Application_Model_Test();
    $aTestInfo = $this->oTest->getTestInfo($iTest);
    
    
    Zend_debug::dump($aTestInfo);
    Zend_debug::dump($aResults);
    if(count($aResults)>0){
      
      $sBodyText = "Resultados del test '".$aTestInfo['title']."'<br>";
      
      $sProducts = '<p>';
      $i = 1;
      foreach($aResults as $r){
        $sProducts .= '<p>';
        $sProducts .= $i.'.- Flor Numero '.$r['ID_PRDCT'].':'. ' "'.$r['VC_PRDCT_TTL'].'". '.$r['TXT_PRDCT_DSCRPTN'];
        $sProducts .= '</p><br>';
        $sProducts .= '</p>';
        $i++;
      }
      
      $sProducts .= '</p>';
      echo($sBodyText);
      echo($sProducts);
      return true;
      
    }else{
      
      return 'No hay resultados que enviar';
    }
    
    
  }

}

