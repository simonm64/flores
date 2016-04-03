<?php

class TestController extends Zend_Controller_Action
{

    public $iTestId = null;

    public $oTestModel = null;

    public $aAnswers = null;
    
    private $oRequest = null;

    public function cdump($var)
    {
        Zend_Debug::dump($var);
    }

    public function init()
    {
        $this->oTestModel = new Application_Model_Test();
        $this->oRequest = new Zend_Controller_Request_Http();
    }

    public function indexAction()
    {
        // action body
        //home page showin two tests
    }

    public function basicoAction()
    {
        //set the TestId
        $this->iTestId = 1;
        //$this->view->testid = 777;
        session_start();
        //var_dump(session_id());
    
        //get the Test info
        $aTestInfo = $this->oTestModel->getTestInfo(1);
        
        $this->view->testTitle = utf8_encode($aTestInfo["title"]);
        
    }

    public function addAnswerAction()
    {
        
        session_start();
        
        if($this->oRequest->isXmlHttpRequest()){
            if($this->oRequest->isGet()){
                $aQuery = $this->oRequest->getQuery();
                
                $iTest = $aQuery['id_test'];
                $iQuestion = $aQuery['i_question'];
                $iGroup = $aQuery['i_group'];
                $iValue = $aQuery['value'];
               
            }else{
                die("Bad Request");
            }
        }else{
            die("Bad Request");
        }
        
        //add the answer to the system
        $vInserted = $this->oTestModel->UpsertAnswer($iTest,$iQuestion,$iGroup,$iValue);//session id is retrieved in model
        
        if(is_numeric($vInserted)){ //everything went fine and we have an inserted id or number of updated rows
            $aQuestion = $this->oTestModel->getBuildNextQuestion($iTest);
           
            if(!$aQuestion){
                //echo('No more questions, show the the User registration view');
                die(json_encode(array('sucess'=>true,'data'=>'0')));
            }
            //everything went fine
            die(json_encode(array('sucess'=>true,'data'=>$aQuestion)));//show the next question
        }elseif(!$vInserted){
            //there was a problem with the insert
            //echo($vInserted);//exception cought in the model
            die(json_encode(array('sucess'=>true,'data'=>$vInserted)));
        }
    }

    public function completoAction()
    {
        session_start();
        //var_dump(session_id());
    
        //get the Test info
        $aTestInfo = $this->oTestModel->getTestInfo(2);
        self::cdump($aTestInfo);
                
        /*$aQuestion = $this->oTestModel->getBuildNextQuestion(2);
        
        self::cdump($aQuestion);*/
    }

    public function getQuestionAction()
    {
        if($this->oRequest->isXmlHttpRequest()){
            $aQuery = $this->oRequest->getQuery();
            if(is_numeric($aQuery["iTest"])){
                $this->iTestId = (int)$aQuery["iTest"];
                $aQuestion = $this->oTestModel->getBuildNextQuestion($this->iTestId);
                if(is_array($aQuestion)){
                    die(json_encode(array("success"=>true,"data"=>$aQuestion)));
                }else{
                    die(json_encode(array("success"=>true,"data"=>"No hay mas preguntas")));
                }
                
            }else{
                die(json_encode(array("success"=>false,"msg"=>"Bad Data")));
            }
        }
        die("Bad data");
        
    }


}









