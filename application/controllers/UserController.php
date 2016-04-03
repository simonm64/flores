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
        var_dump(session_id());
        //catch the information from POST
        $iTest = 1;
        $sName = 'Simon Martinez Arriaga';
        $sEmail = 'simonm64@gmail.com';
        $sTel = '4343001';
        
        
        if(!$this->oEmailValidator->isValid($sEmail)){
            $messages = $this->oEmailValidator->getMessages();
            die(json_encode(array('sucess'=>false,'msg'=>$messages["emailAddressInvalidFormat"])));
        }
        
        if(!$this->oTelValidator->isValid($sTel)){
            $messages = $this->oTelValidator->getMessages();
            die(json_encode(array('sucess'=>false,'msg'=>$messages["regexNotMatch"])));
        }
        
        /*if($this->oEmailValidator->isValid($sEmail)) */

        $vUserId = $this->oUserModel->upsertUser($sName,$sEmail);
        var_dump($vUserId);
        if(is_numeric($vUserId)){
            
            //get results
            $aResults = $this->oUserModel->getResults($vUserId,$iTest);
            if(!is_array($aResults)){
                die(json_encode(array('success'=>false,'msg'=>$aResults)));
            }
            //send email to admin with results
            $vSent = $this->oUserModel->sendResultsEmail($aResults,$iTest,$sName,$sEmail,$sTel);
            if($vSent){
                die(json_encode(array('success'=>true,'msg'=>'Sus resultados fueron enviados al administrador. El se pondra en contacto')));
            }
            else{
                //die(json_encode(array('success'=>false,'msg'=>'Error al enviar resultados. Intente mas tarde')));
                die(json_encode(array('success'=>false,'msg'=>$vSent)));
            }
            
        }else{
            die(json_encode(array('sucess'=>false,'msg'=>'Error al gurdar usuario. Intente mas tarde')));
            //die(json_encode(array('sucess'=>false,'msg'=>$vUserId)));
        }
        
    }

}



