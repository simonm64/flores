<?php

class UserController extends Zend_Controller_Action
{

    private $oUserModel;
    private $oEmailValidator;
    private $oTelValidator;
    public function init()
    {
        /* Initialize action controller here */
        $this->oUserModel = new Application_Model_User();
        $this->oRequest = new Zend_Controller_Request_Http();
        $this->oEmailValidator = new Zend_Validate_EmailAddress();
        $this->oEmailValidator->setMessage('El correo ingresado no es valido. Intente de nuevo, solo con numeros sin espacios.');
        $this->oTelValidator = new Zend_Validate_Regex(array('pattern' => '/^[0-9 ]+$/'));
        $this->oTelValidator->setMessage("El numero de telefono ingresado no es valido.");
    }

    public function indexAction()
    {
        // action body
    }

    public function getTestResults()
    {
        
        //ajax request
        
        //identify the user
        
        //identify test
        
        //get the results
        $oTestModel = new Application_Model_Test();
        $aResults = $oTestModel->getResults($iIdUser, $iIdTest);
        
        
        //send email to admin
        
        //send signal to front end to show Thanks screen.
    }

    public function registerUserAction()
    {
        session_start();
        //var_dump(session_id());
        //catch the information from POST
        //$iTest = 1;
        //$sName = 'Simon Martinez Arriaga';
        //$sEmail = 'simonm64@gmail.com';
        //$sTel = '4343001';

        if($this->oRequest->isXmlHttpRequest()){
            if ($this->oRequest->isPost()){
                //$aQuery = $this->oRequest->getPost();

                $iTest = $this->oRequest->getPost('iTest');
                $sName = $this->oRequest->getPost('firstName');
                $sName .= ' '.$this->oRequest->getPost('lastName');
                $sEmail = $this->oRequest->getPost('email');
                if($this->oRequest->getPost('phoneNumber')){
                    $sTel = $this->oRequest->getPost('phoneNumber');
                }
                else{
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
            //die(json_encode(array('sucess'=>false,'msg'=>$messages["regexNotMatch"])));
            $aData = array('success'=>false,'msg'=>$messages["regexNotMatch"]);
            $this->_helper->json($aData);
            exit;
        }

        $vUserId = $this->oUserModel->upsertUser($sName,$sEmail);
        //var_dump($vUserId);
        if(is_numeric($vUserId)){
            
            //get results
            $aResults = $this->oUserModel->getResults($vUserId,$iTest);
            if(!is_array($aResults)){
                //die(json_encode(array('success'=>false,'msg'=>$aResults)));
                $aData = array('success'=>false,'msg'=>$aResults);
                $this->_helper->json($aData);
                exit;
            }
            //send email to admin with results
            $vSent = $this->oUserModel->sendResultsEmail($aResults,$iTest,$sName,$sEmail,$sTel);
            if($vSent){
                self::kill_session_cookie();
                //die(json_encode(array('success'=>true,'msg'=>'Sus resultados fueron enviados al administrador. El se pondra en contacto')));
                $aData = array('success'=>true, 'msg'=>'Sus resultados fueron enviados al administrador. El se pondra en contacto');
            }else{
                //die(json_encode(array('success'=>false,'msg'=>'Error al enviar resultados. Intente mas tarde')));
                //die(json_encode(array('success'=>false,'msg'=>$vSent)));
                $aData = array('success'=>false,'msg'=>$vSent);
            }

            $this->_helper->json($aData);
            exit;

        }else{
            //die(json_encode(array('sucess'=>false,'msg'=>'Error al gurdar usuario. Intente mas tarde')));
            //die(json_encode(array('sucess'=>false,'msg'=>$vUserId)));
            $aData = array('sucess'=>false,'msg'=>'Error al gurdar usuario. Intente mas tarde');
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



