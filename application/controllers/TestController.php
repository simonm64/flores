<?php

class TestController extends Zend_Controller_Action
{
    public $iTestId;
    public $oTestModel;
    public $aTestInfo;
    public $aQuestions;
    public $aAnswers;

    public function init()
    {
        $this->oTestModel = new Application_Model_Test();
    }

    public function indexAction()
    {
        // action body
    }

    public function basicoAction()
    {
        //set the TestId
        $this->iTestId = 1;
        $this->view->testid = 777;
        
        //verify if there is an active php session
      
        
        if(session_id() == ""){
            //session_start();
            $ssId = session_id();
            //if not, call $this->registerSession() to create a new results record
            $this->oTestModel->registerSession();
            
        }else{
            $ssId = session_id();
        }
        
        //var_dump($ssId);
        
        //if is there a session, go to the last question answered
    
        
        
        //get the Test info
        //$oTestModel->getTestInfo();
        
        
        //get the questions with answer options
        
        //$sBasicQuestions = $oTestModel->getQuestions(1);
        
        
        //prepare the test
        
        //prepate the view or (for angular js)

    }
    
    
    
    
    public function addAnswer(){
        
        //ajax request
        
        //identify the session
        
        //identify test
        
        //identify the question
        
        //identify the value of the answer
        
        
        //add the answer to the system
        $oTestModel->InsertAnswer($iIdTest,$iIdQuestion,$iValue);//session id is retrieved in model
        
        //verify is is the last question
        //last question can be identified with a hidden field in the question,
        //or making a count to the questions and compare.
        
        //if the question is not the last one
            //send signal to front end to display next question.
            
        //else
            //create the user registration form and pass it to front end
        
    }
    
    
    


}



