<?php

class UserController extends Zend_Controller_Action
{

  private $oUserModel;
  private $oEmailValidator;
  private $oTelValidator;
  public $oUserSesion;
  public function init()
  {
    /* Initialize action controller here */
    $this->oUserModel = new Application_Model_User();
    $this->oRequest = new Zend_Controller_Request_Http();
    $this->oEmailValidator = new Zend_Validate_EmailAddress();
    $this->oEmailValidator->setMessage('El correo ingresado no es valido. Intente de nuevo, solo con numeros sin espacios.');
    $this->oTelValidator = new Zend_Validate_Regex(array('pattern' => '/^[0-9 ]+$/'));
    $this->oTelValidator->setMessage("El numero de telefono ingresado no es valido.");

    Zend_Session::start();
    $this->oUserSession = new Zend_Session_Namespace('control');
  }

  public function indexAction()
  {
    // action body
    $this->view->idTest = 0;
    $aQuery = $this->oRequest->getQuery();
    if(count($aQuery)>0 && is_numeric($aQuery["i"])){
      $this->view->idTest = $aQuery["i"];
    }
  }

  public function getTestResults()
  {
    //get the results
    $oTestModel = new Application_Model_Test();
    $aResults = $oTestModel->getResults($iIdUser, $iIdTest); 
  }

  public function registerUserAction()
  {
    #session_start();
    if($this->oRequest->isXmlHttpRequest()){
      if ($this->oRequest->isPost()){
        $iTest = $this->oRequest->getPost('iTest');
        $sName = $this->oRequest->getPost('firstName');
        $sName .= ' '.$this->oRequest->getPost('lastName');
        $sEmail = $this->oRequest->getPost('email');
        //Other information in json
        $aJson =array();
        $aJson["country"] = $this->oRequest->getPost('country');
        $sJson = json_encode($aJson);
        if($this->oRequest->getPost('phoneNumber')){
          $sTel = $this->oRequest->getPost('phoneNumber');
        }else{
          $sTel = "";
        }
      }else{
        $this->_helper->viewRenderer->setNoRender(true);
        $aData = array(success=>false,'msg'=>'Bad Data');
        $this->_helper->json($aData);
        exit;
      }
    }else{
      $this->_helper->viewRenderer->setNoRender(true);
      $aData = array("success" => false, "msg" => "Bad Data");
      $this->_helper->json($aData);
      exit;
    }

    if(!$this->oEmailValidator->isValid($sEmail)){
      $messages = $this->oEmailValidator->getMessages();
      //die(json_encode(array('sucess'=>false,'msg'=>$messages["emailAddressInvalidFormat"])));
      $aData = array('success'=>false,'msg'=>$messages["emailAddressInvalidFormat"]);
      $this->_helper->json($aData);
      exit;
    }

    if($sTel != "" && !$this->oTelValidator->isValid($sTel)){
      $messages = $this->oTelValidator->getMessages();
      $aData = array('success'=>false,'msg'=>$messages["regexNotMatch"]);
      $this->_helper->json($aData);
      exit;
    }

    $vUserId = $this->oUserModel->upsertUser($sName, $sEmail, $sJson);
    if(is_numeric($vUserId)){
      //get results
      $aResults = $this->oUserModel->getResults($vUserId,$iTest);
      if(!is_array($aResults)){
        $aData = array('success'=>false,'msg'=>'Ocurrio un error al guardar su informacion. Intentelo de nuevo mas tarde. No cierre su navegador.');
        $this->_helper->json($aData);
        exit;
      }
      //send email to admin with results
      #$vSent = $this->oUserModel->sendResultsEmail($aResults,$iTest,$sName,$sEmail,$sTel,$aJson["country"]);
      $vResults = $this->oUserModel->sendResultsEmail($aResults,$iTest,$sName,$sEmail,$sTel,$aJson["country"]);
      if($vResults){
        #Save in the database
        $iSaved = $this->oUserModel->saveTestResultsHtml($vUserId,$iTest,$vResults);

        $this->oUserSession->id = $vUserId;
        $this->oUserSession->test = (int)$iTest;
        
        $aData = array('success'=>true, 'msg'=>'Sus resultados fueron enviados al administrador. El se pondra en contacto');
        
      }else{
        $aData = array('success'=>false,'msg'=>'No se pudo enviar la notificacion al administrador. Favor de ponerse en contacto con el.');
      }
      $this->_helper->json($aData);
      exit;
    }else{
      $aData = array('sucess'=>false,'msg'=>'Error al guardar usuario. Intente mas tarde');
      $this->_helper->json($aData);
      exit;
    }
  }

  public function kill_session_cookie(){
    $params = session_get_cookie_params();
    setcookie(session_name(), '', 0, $params['path'], $params['domain'], $params['secure'], isset($params['httponly']));
    session_destroy();
    session_unset();
  }

}