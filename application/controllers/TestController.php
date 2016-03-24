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
        var_dump(session_id());
        //verify if there is an active php session
        /*if(session_id()=='' || !isset($_SESSION)){
            
            $success = $this->oTestModel->registerSession($this->iTestId);
            var_dump($success);
            
        }else{
            echo'ssid already exist';
        }*/

        //if is there a session, go to the last question answered
    
        //get the Test info
        
        $aTestInfo = $this->oTestModel->getTestInfo($this->iTestId);
        self::cdump($aTestInfo);
                
        //$aTestQuestions = $this->oTestModel->getQuestions($this->iTestId);
        $aQuestion = $this->oTestModel->getBuildQuestion($this->iTestId);
        
        self::cdump($aQuestion);
        
        //cdump($aQuestion);
        
        //$aTestOptions = $this->oTestModel->getOptionsAnswers($this->iTestId);
        //Zend_Debug::dump($aTestOptions);
        
        //prepare the test
        //$aCompleteTest = $this->oTestModel->buildTest($aTestInfo,$aTestQuestions,$aTestOptions);
        
        //prepate the view or (for angular js)

    }


    public function addAnswerAction()
    {
         //ajax request
        session_start();
        //identify the session
        //verify
        /*if(){
            //session_start();
            $success = $this->oTestModel->registerSession($this->iTestId);
            var_dump($success);
            
        }else{
            echo'ssid already exist';
        }*/
        
        
        //identify test
        $iTest = 1;
        $iQuestion = 2;
        $iGroup = 2;
        $iValue = 2;
        
        //identify the question
        
        //identify the value of the answer
        
        
        //add the answer to the system
        $data = $this->oTestModel->InsertAnswer($iTest,$iQuestion,$iGroup,$iValue);//session id is retrieved in model
        echo(json_encode(array('sucess'=>true,'data'=>$data)));
        //verify is is the last question
        //last question can be identified with a hidden field in the question,
        //or making a count to the questions and compare.
        
        //if the question is not the last one
            //query the next question and send it to front
            
        //else
            //create the user registration form and pass it to front end
    }


}





