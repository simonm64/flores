<?php
class Application_Model_Store
{
  public function __construct()
  {
    //nothing for now
  }  

  public function sendShipmentEmail($aShipmentData)
  {
    $sSubject = "Datos de envio de". utf8_decode($aShipmentData['name']);    
    $sBodyText = "<p>";
    $sBodyText .= "Nombre: ".utf8_decode($aShipmentData['name'])."<br>";
    $sBodyText .= "Calle y Numero: ".utf8_decode($aShipmentData['street'])."<br>";
    $sBodyText .= "Colonia: ".utf8_decode($aShipmentData['area'])."<br>";
    $sBodyText .= "Codigo Postal: ".utf8_decode($aShipmentData['zip'])."<br>";
    $sBodyText .= "Pais: ".$aShipmentData['country']."<br>";
    $sBodyText .= "Email: ".$aShipmentData['email']."<br>";
    $sBodyText .= "Telefono: ".$aShipmentData['phone']."<br>";
    $sBodyText .= "</p>";
      
    $mail = new Zend_mail();
    $tr = new Zend_Mail_Transport_Smtp('localhost');
    $mail->setDefaultTransport($tr);
    $mail->setBodyHtml($sBodyText);
    $mail->setFrom("ubuntu@mail.floresdebach33.com", "Administracion Flores");
    #$mail->addTo("floresdebach33@yahoo.com");
    #$mail->addBcc("smartinez@svam.com");
    $mail->addTo("smartinez@svam.com");
    $mail->setSubject($sSubject); 

    try{
      $sent = $mail->send();
    } catch(Zend_Mail_Transport_Exception $e){      
      return false;
    }
    return true;    
  }


}