<?php

class TestController extends Zend_Controller_Action
{

    public $iTestId = null;

    public $oTestModel = null;

    public $aAnswers = null;

    private $oRequest = null;

    public $view = null;

    public function init()
    {
    $this->oTestModel = new Application_Model_Test();
    $this->oRequest = new Zend_Controller_Request_Http();
    //$this->view = new Zend_View();
      /*
      parent::init();
      $this->_helper->contextSwitch()
      ->addActionContext('addAnswer', 'json')
      ->initContext('json');*/
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
    $aTestInfo = $this->oTestModel->getTestInfo($this->iTestId);
    //var_dump($aTestInfo);
    //$sTestTitle = $aTestInfo["title"];
    $this->view->sTestTitle = $aTestInfo["title"];
    //$sUseTest =  "Iniciar Test";
    $this->view->sUseTest = "Iniciar";
    }

    public function addAnswerAction()
    {
    session_start();

    if($this->oRequest->isXmlHttpRequest()){
      if ($this->oRequest->isPost()){
        //$aQuery = $this->oRequest->getPost();

        $iTest = $this->oRequest->getPost('id_test');
        $iQuestion = $this->oRequest->getPost('i_question');
        $iGroup = $this->oRequest->getPost('i_group');
        $iValue = $this->oRequest->getPost('value');

      }else{
        $this->_helper->viewRenderer->setNoRender(true);
        $aData = array("success" => false, "msg" => "Bad Data");
        $this->_helper->json($aData);
        exit;
      }
    }
    //add the answer to the system
    $vInserted = $this->oTestModel->UpsertAnswer($iTest,$iQuestion,$iGroup,$iValue);

    if(is_numeric($vInserted)){ //everything went fine and we have an inserted id or number of updated rows
        $aQuestion = $this->oTestModel->getBuildNextQuestion($iTest);

        if(!$aQuestion){
            //echo('No more questions, show the the User registration view');
          $aData = array(0);
          $this->_helper->viewRenderer->setNoRender(true);
          $this->_helper->json($aData);
          exit;
        }
        $aData = $aQuestion;
    }
    else{
        //there was a problem with the insert
        $aData = $vInserted;
    }

    $this->_helper->viewRenderer->setNoRender(true);
    $this->_helper->json($aData);
    exit;
    }

    public function completoAction()
    {
    session_start();
    //var_dump(session_id());

    //get the Test info
    $aTestInfo = $this->oTestModel->getTestInfo(2);
    //self::cdump($aTestInfo);

    $this->view->sTestTitle = $aTestInfo["title"];
    //$sUseTest =  "Iniciar Test";
    $this->view->sUseTest = "Iniciar";

    }

    public function getQuestionAction()
    {
    session_start();
    if($this->oRequest->isXmlHttpRequest()){
      $aQuery = $this->oRequest->getQuery();
      if(is_numeric($aQuery["iTest"])){
        $this->iTestId = (int)$aQuery["iTest"];
        $aData = $this->oTestModel->getBuildNextQuestion($this->iTestId);
        if(!$aData){
          $aData = array(0);
        }
        //$this->_helper->layout()->disableLayout();
        }else{
            $aData= array("Bad Data");
        }
    }else{
      $aData= array("Bad Data");
    }

    $this->_helper->viewRenderer->setNoRender(true);
    $this->_helper->json($aData);
    exit;
    }

    public function terminadoAction()
    {
        // action body
    }


}











