<?php
class Application_Model_Index
{
  
  private $oDB;
  private $oUser;
  public function __construct(){
    //connect to db
    $this->oDB = FloresDB::conn();
    $this->oUser = new Application_Model_User;
  }
  
  public function getProductsFront(){
    $sSql = "SELECT ID_PRDCT_FRONT,
              VC_PRDCT_TTL,
              TXT_PRDCT_DSCRPTN,
              VC_FL_IMG,
              I_CTGRY
              FROM
              PRODUCTS_FRONT;";
    $aP = $this->oDB->fetchAll($sSql, array());
    return $aP;
  }

}