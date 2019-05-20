<?php

class StoreController extends Zend_Controller_Action
{
	private $oRequest = null;
	public $view = null;

	public function init(){
		$this->oStoreModel = new Application_Model_Store();
		$this->oRequest = new Zend_Controller_Request_Http();
		$this->oEmailValidator = new Zend_Validate_EmailAddress();
		$this->oEmailValidator->setMessage('El correo ingresado no es valido. Intente de nuevo.');
		$this->oTelValidator = new Zend_Validate_Regex(array('pattern' => '/^[0-9 ]+$/'));
		$this->oTelValidator->setMessage("El numero de telefono ingresado no es valido.");
	}

	public function indexAction(){
	// action body
	}

	public function paymentAction(){
		
	}
	
	public function shipmentAction (){

	}

	public function sendAddressAction(){		
    	if($this->oRequest->isXmlHttpRequest()){
			if ($this->oRequest->isPost()){
				$sName = $this->oRequest->getPost('firstName');
				$aCustomerData['name'] = $sName .= ' '.$this->oRequest->getPost('lastName');
				$sEmail = $this->oRequest->getPost('email');
				$aCustomerData['street'] = $this->oRequest->getPost('street');
				$aCustomerData['area'] = $this->oRequest->getPost('area');
				$aCustomerData['city'] = $this->oRequest->getPost('city');
				$aCustomerData['state'] = $this->oRequest->getPost('state');
				$aCustomerData['zip'] = $this->oRequest->getPost('zip');
				$aCustomerData['country'] = $this->oRequest->getPost('country');
				$sTel = $this->oRequest->getPost('phoneNumber');
			}else{
				$this->_helper->viewRenderer->setNoRender(true);
				$aData = array("success" => false, "msg" => "Bad Data");
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
			$aData = array('success'=>false,'msg'=>$messages["emailAddressInvalidFormat"]);
			$this->_helper->json($aData);
			exit;
		}
		$aCustomerData['email'] = $sEmail;
	  
		if($sTel != "" && !$this->oTelValidator->isValid($sTel)){
			$messages = $this->oTelValidator->getMessages();
			$aData = array('success'=>false,'msg'=>$messages["regexNotMatch"]);
			$this->_helper->json($aData);
			exit;
		}
		$aCustomerData['phone'] = $sTel;
		
		$vSent = $this->oStoreModel->sendShipmentEmail($aCustomerData);
			
		if($vSent){			
			$aData = array('success'=>true, 'msg'=>'Sus datos fueron enviados al administrador. El se pondra en contacto para su envio');
		}else{
			$aData = array('success'=>false,'msg'=>'No se pudo enviar la notificacion al administrador. Favor de ponerse en contacto con el.');
		}		
		$this->_helper->json($aData);
		exit();

	}
}

