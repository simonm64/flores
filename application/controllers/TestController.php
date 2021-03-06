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
    }

    public function indexAction()
    {
    // action body
    }

    public function basicoAction()
    {
			//set the TestId
			$this->iTestId = 1;
			session_start();
	
			//get the Test info
			$aTestInfo = $this->oTestModel->getTestInfo($this->iTestId);
			$this->view->sTestTitle = $aTestInfo["title"];
			$this->view->sUseTest = "Iniciar";
			$this->view->iTestId = 1;
    }

    public function addAnswerAction()
    {
			session_start();
			if($this->oRequest->isXmlHttpRequest()){
				if ($this->oRequest->isPost()){
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
			if(is_numeric($vInserted)){
				//everything went fine and we have an inserted id or number of updated rows
				$aQuestion = $this->oTestModel->getBuildNextQuestion($iTest);
				if(!$aQuestion){
					$aData = array(0);
					$this->_helper->viewRenderer->setNoRender(true);
					$this->_helper->json($aData);
					exit;
				}
				$aData = $aQuestion;
			}else{
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
			//get the Test info
			$aTestInfo = $this->oTestModel->getTestInfo(2);
			$this->view->sTestTitle = $aTestInfo["title"];
			$this->view->sUseTest = "Iniciar";
			$this->view->iTestId = 2;
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

    public function ninosAction()
    {
      //set the TestId
			$this->iTestId = 3;
			session_start();
	
			//get the Test info
			$aTestInfo = $this->oTestModel->getTestInfo($this->iTestId);
			$this->view->sTestTitle = $aTestInfo["title"];
			$this->view->sUseTest = "Iniciar";
			$this->view->iTestId = 3;
    }

		public function resultadosAction(){
			
			#new user model instance
			$this->oUserModel = new Application_Model_User();

			$userDetails = new Zend_Session_Namespace('control');
			
			if(isset($userDetails->id) && isset($userDetails->test)){
				$vResults = $this->oUserModel->getResultsHtml($userDetails->id, $userDetails->test);
			}else{
				$vResults = "<h2>No hay resultados para este cuestionario</h2>";
			}

			#Assign the text results to view
			$this->view->sResults = $vResults;

			#display the view.


		}

}

