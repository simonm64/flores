<?php

class IndexController extends Zend_Controller_Action
{

    public $oIndexModel = null;

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        //$this->headTitle('Zend Framework');
        //$this->headTitle('Inicio - Flores de Bach');
    }

    public function esenciasAction()
    {
        // action body
        //query the product_front table
        $oIndexModel = new Application_Model_Index();

        $aEscencias = $oIndexModel->getProductsFront();
        $this->view->aEscencias = $aEscencias;

        //$paginator = Zend_Paginator::factory($aEscencias);
        //Zend_Debug::dump($paginator);
    }

    public function dosisAction()
    {
        // action body
    }

    public function contactoAction()
    {
        // action body
    }

    public function testimoniosAction()
    {
        // action body
    }

    public function testAction()
    {
        // action body
    }


}













