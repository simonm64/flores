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
      return $vAffected; //exception thrown
    }
    
    /*if($vAffected == 0){
      return "No records updated";
    }*/
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
    //var_dump($iUserId);
    $data = array(
      'ID_USR' => $iUserId,
    );
    
    /*$where['ID_TST = ?'] = $iTest;
    $where['VC_SESSION_ID = ?'] = session_id();*/
    
    $where[] = "ID_TST = $iTest";
    $where[] = "VC_SESSION_ID = '".session_id()."'";
    
    //var_dump($where);
    try{
      $iAffected = $this->oDB->update('USER_RESULTS', $data, $where);
    } catch(Zend_Exception $e){
      return $e->getMessage();
    }
    //var_dump($iAffected);
    return $iAffected;
  }
  
  public function calcResults($iUserId, $iTest){
    //var_dump($iUserId,$iTest);
    $iLimit = 18;
    /*if($iTest == 2)
      $iLimit = 40;*/

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
                      HAVING SUM(I_VALUE) > 1
                      ) UR
              LEFT JOIN QUESTIONS Q
              ON Q.I_GRP = UR.I_GRP AND Q.ID_TST = ?
              JOIN PRODUCTS P
              ON Q.ID_PRDCT = P.ID_PRDCT
              ORDER BY UR.I_VALUE DESC, UR.I_GRP ASC LIMIT $iLimit";
    try{
      $oQuery = $this->oDB->query($sSql,array($iTest,$iUserId,$iTest));
    } catch(Zend_Exception $e){
      return $e->getMessage();
    }
    //Zend_debug::dump($oQuery);
    $aResults = $oQuery->fetchAll();
    return $aResults;
  }
  
  
  public function sendResultsEmail($aResults, $iTest,$sName,$sEmail,$sTel){
    
    $this->oTest = new Application_Model_Test();
    $aTestInfo = $this->oTest->getTestInfo($iTest);
    
    if(count($aResults)>0){
      
      $sSubject = "Resultados del test ".utf8_decode($aTestInfo['title'])." de ".$sName;
      
      $sBodyText = "Resultados del test '".utf8_decode($aTestInfo['title'])."'<br>";
      $sBodyText .= "Nombre: ".utf8_decode($sName)."<br>";
      $sBodyText .= "Email: ".$sEmail."<br>";
      $sBodyText .= "Movil: ".$sTel."<br>"; 
      
      $sBodyText .= "<p>Hola, recibe un cordial saludo!! La siguiente lista muestra las flores m&aacute;s necesarias para ti en orden de mayor a menor prioridad</p>";
      
      $sProducts = '<p>';
      $i = 1;
      foreach($aResults as $r){
        $sProducts .= '<p>';
        $sProducts .= $i.'.- Flor N&uacute;mero '.$r['ID_PRDCT'].':'. ' "'.utf8_decode($r['VC_PRDCT_TTL']).'". '.utf8_decode($r['TXT_PRDCT_DSCRPTN']);
        $sProducts .= '</p>';
        $i++;
      }
      $sProducts .= '</p>';
      
      $sBodyText .= $sProducts;
      
      $sBodyText .= "<p>IMPORTANTE:";
      $sBodyText .= "-Para una mayor efectividad de la terapia floral, deben incluirse m&aacute;ximo 6 flores(esencias) por frasco<br>";
      $sBodyText .= "-Lo m&aacute;s recomendable para iniciar el tratamiento floral es tomar 6 de las primeras 10 flores de la lista.";
      $sBodyText .= " De esta forma se corregir&aacute;n los aspectos negativos m&aacute;s pronunciados de tu persona,";
      $sBodyText .= " y conforme dichos aspectos se vayan erradicando, podr&iacute;amos continuar con una segunda f&oacute;rmula de 6 flores en segundo lugar de importancia de la lista";
      $sBodyText .= "</p>";
      
      $sBodyText .= "<p>Modo de administraci&oacute;n: 4 gotas bajo la lengua, 4 veces al dia</p>";
      
      $sBodyText .= "<p>Duraci&oacute;n aproximada del frasco: 25 d&iacute;as</p>";
      
      $sBodyText .= "<p>Si decides la compra, estas son las formas de pago y entrega:</p>";
      
      $sBodyText .= "<p>";
      $sBodyText .= "Costo del frasco de 30ml: $150 pesos mexicanos<br>";
      $sBodyText .= "Forma de pago: <br>";
      $sBodyText .= "1.-por  Dep&oacute;sito en Banamex. Si eliges esta opci&oacute;n responde a este email solicitando el n&uacute;mero de cuenta<br>";
      $sBodyText .= "2.- En efectivo al entregar el producto (opci&oacute;n v&aacute;lida solo si este producto te fue ofrecido personalmente por un vendedor nuestro y ordenaste la compra)<br>";
      $sBodyText .= "</p>";
      
      $sBodyText .= "<p>";
      $sBodyText .= "Entrega del producto en Saltillo Coahuila:<br>";
      $sBodyText .= "A tu domicilio, lugar de trabajo, lugar donde te fue ofrecido el producto, o lugar acordado, seg&uacute;n tu elecci&oacute;n<br>";
      $sBodyText .= "</p>";
      
      $sBodyText .= "<p>Entregas al resto de la rep&uacute;blica mexicana: por Aero flash</p>";
      $sBodyText .= "<p>Saludos!!!!</p>";

      /*Send via smtp*/
      /*$config = array('auth' => 'login',
                'username' => 'myusername',
                'password' => 'password',
                'ssl' => 'tls',
                'port' => 25);
     
      $tr = new Zend_Mail_Transport_Smtp('mail.example.com',$config);
      Zend_Mail::setDefaultTransport($tr);
      */
      
      $mail = new Zend_mail();
      $mail->setBodyHtml($sBodyText);
      $mail->setFrom("admin@floresbach.com", "Administracion Flores");
      $mail->addTo("floresdebach33@yahoo.com");
      $mail->addCc("simonm64@gmail.com");
      $mail->setSubject($sSubject); 
      
      try{
        $sent = $mail->send();
      } catch(Zend_Mail_Transport_Exception $e){
        return $e->getMessage();
      }
      return true;
      
    }else{
      return 'No hay resultados que enviar';
    }
  }

}

