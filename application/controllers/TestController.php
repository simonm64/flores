<?php

class TestController extends Zend_Controller_Action
{

    public $iTestId = null;

    public $oTestModel = null;

    public $aTestInfo = null;

    public $aQuestions = null;

    public $aAnswers = null;

    public function cdump($var)
    {
        Zend_Debug::dump($var);
    }

    public function init()
    {
        $this->oTestModel = new Application_Model_Test();
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
        $this->view->testid = 777;
        session_start();
        //var_dump(session_id());
    
        //get the Test info
        $aTestInfo = $this->oTestModel->getTestInfo(1);
        self::cdump($aTestInfo);
                
        $aQuestion = $this->oTestModel->getBuildNextQuestion(1);
        
        self::cdump($aQuestion);
        
        //prepate the view or (for angular js)

    }

    public function addAnswerAction()
    {
         //ajax request
        session_start();
        
        
        /*----GET params upon ajax request-------*/
        //identify test
        $iTest = 1;
        
        //identify the question & group
        $iQuestion = 1;
        $iGroup = 1;
        
        //identify the value of the answer
        $iValue = 0;
        /*-----------*/
        
        //add the answer to the system
        $vInserted = $this->oTestModel->UpsertAnswer($iTest,$iQuestion,$iGroup,$iValue);//session id is retrieved in model
        //var_dump($vInserted);
        //verify result of insert and continue
        if(is_numeric($vInserted)){ //everything went fine and we have an inserted id or number of updated rows
            $aQuestion = $this->oTestModel->getBuildNextQuestion($iTest);
            if(!$aQuestion){
                echo('No more questions, show the the User registration view');
                die(json_encode(array('sucess'=>true,'data'=>'0')));
            }
            self::cdump($aQuestion);//we have a next question and should be displayed
            die(json_encode(array('sucess'=>true,'data'=>$aQuestion)));//show the next question
        }elseif(!$vInserted){
            //there was a problem with the insert
            echo($vInserted);//exception cought in the model
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
                
        $aQuestion = $this->oTestModel->getBuildNextQuestion(2);
        
        self::cdump($aQuestion);
    }


}







