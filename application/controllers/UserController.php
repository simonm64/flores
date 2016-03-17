<?php

class UserController extends Zend_Controller_Action
{
    
    
    private $oUserModel;

    public function init()
    {
        /* Initialize action controller here */
        $oUserModel = new Application_Model_User();
        
    }


    public function indexAction()
    {
        // action body
    }
    
    
    public function registerUser(){
        
        //ajax request
        
        
        //get the email from $_POST
        
        //get the name from $_POST
        
        //add the user to DB
        $iUserId = $oUserModel->addUser($sEmail, $sName);
        
        //sets the user Id available to the system
    }
    
    
    //will be called in the last question
    public function getTestResults(){
        
        //ajax request
        
        //identify the user
        
        //identify test
        
        //get the results
        $oTestModel = new Application_Model_Test();
        $aResults = $oTestModel->getResults($iIdUser, $iIdTest);
        
        
        //send email to admin
        
        //send signal to front end to show Thanks screen.
    }
    
    
    public function createUser
    
    
    
    


}

