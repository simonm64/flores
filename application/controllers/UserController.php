<?php

class UserController extends Zend_Controller_Action
{

    private $oUserModel;
    private $oValidator;
    public function init()
    {
        /* Initialize action controller here */
        $this->oUserModel = new Application_Model_User();
        $this->oValidator = new Zend_Validate_EmailAddress();
        $this->oValidator->setMessage('El correo ingresado no es valido. Intente de nuevo');
        
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
        $iTest = 2;
        $sName = 'Simon Martinez Arriaga';
        $sEmail = 'simonm64@gmail.com';
        
        
        if ($this->oValidator->isValid($sEmail)){

            $vUserId = $this->oUserModel->upsertUser($sName,$sEmail);
            
            if(is_numeric($vUserId)){
                
                //send email to admin with results
                $aResults = $this->oUserModel->getResults($vUserId,$iTest);
                if(!is_array($aResults)){
                    die(json_encode(array('success'=>true)));
                }
                //Zend_debug::dump($aResults);
                $vSent = $this->oUserModel->sendResultsEmail($aResults,$iTest,$sName,$sEmail);
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
            
        } else{
            $messages = $this->oValidator->getMessages();
            die(json_encode(array('sucess'=>false,'msg'=>$messages["emailAddressInvalidFormat"])));
        }
        
    }

}



